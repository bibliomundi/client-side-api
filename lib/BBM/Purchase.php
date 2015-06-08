<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 *
 * The MIT License (MIT)
 * Copyright (c) 2015 bibliomundi
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace BBM;

use BBM\Server\Connect;
use BBM\Server\Exception;

/**
 * Class Purchase
 * Used to execute and validate new purchases in the bibliomundi, this class support
 * multi purchases and single purchase.
 * @package BBM
 */
class Purchase extends Connect
{
    /**
     * The array data must be:
     * [“ebook_id”],
     * [“price”],
     * [“customerIdentificationNumber”],
     * [“customerFullname”],
     * [“customerEmail”],
     * [“customerGender”],
     * [“customerBirthday”],
     * [“customerZipcode”],
     * [“customerCountry”], <- non required
     * [“customerState”]
     *
     * @property array
     */
    private $data = array();

    /**
     * Validate the data and get the OAuth2 access_token for this request.
     * @param array $data
     *
     * @return bool
     * @throws Exception
     */
    public function validate(Array $data)
    {
        $this->data = $data;

        try
        {
            // VALIDATE THE DATA BEFORE SEND IT, ONLY TO AVOID UNNECESSARY REQUESTS.
            $this->validateData();

            // IF NO EXCEPTION IS THROWN BEFORE, THE REQUEST CAN BE SENT, SO
            // HERE WE GET THE ACCESS TOKEN FOR THIS DOWNLOAD REQUEST.
            $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . 'token.php');
            $request->authenticate(true, $this->clientId, $this->clientSecret);
            $request->create();
            $request->setPost(['grant_type' => Server\Config\SysConfig::$GRANT_TYPE]);
            $response = json_decode($request->execute());

            $request->reset();

            if($this->validateData())
            {
                // SET THE ACCESS TOKEN TO THE NEXT REQUEST DATA.
                $this->data['access_token'] = $response->access_token;
                $request->create();

                // SET THE DATA TO VALIDATE.
                $request->setPost($this->data);
                $response = json_decode($request->execute());

                return $response;
            }

        }
        catch(Exception $e)
        {
            throw $e;
        }

        return false;
    }

    private function validateData()
    {
        if(!isset(
            $this->data['bibliomundiEbookID'],
            $this->data['price'],
            $this->data['customerIdentificationNumber'],
            $this->data['customerFullname'],
            $this->data['customerEmail'],
            $this->data['customerGender'],
            $this->data['customerBirthday'],
            $this->data['customerZipcode'],
            $this->data['customerState']
        ))
            throw new Exception('Invalid Request, check the mandatory fields', 400);

        return true;
    }

    public function setPurchaseData($data)
    {
        $this->data = $data;
    }

    /**
     *
     */
    public function register(){}

}