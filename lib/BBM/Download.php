<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:03 PM
 */

namespace BBM;

use BBM\Server\Connect;
use BBM\Server\Exception;

/**
 * Class Download
 * @package BBM
 */
class Download extends Connect
{
    private $clientId;
    private $clientSecret;
    private $data;

    public function __construct($clientId, $clientSecret)
    {
        if(strlen($clientId) > 40 || strlen($clientSecret) > 40)
            throw new Exception('Invalid Credentials', 400);

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function validate(Array $data)
    {
        $this->data = $data;

        try
        {
            $this->validateData();

            $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . 'token.php');
            $request->authenticate(true, $this->clientId, $this->clientSecret);
            $request->create();
            $request->setPost(['grant_type' => Server\Config\SysConfig::$GRANT_TYPE]);
            $response = json_decode($request->execute());

            $this->data['access_token'] = $response->access_token;
        }
        catch(Exception $e)
        {
            throw $e;
        }

        return true;
    }

    private function validateData()
    {
        if(!isset($this->data['ebook_id'], $this->data['transaction_time'], $this->data['transaction_key']))
            throw new Exception('Data array invalid', 500);

        if(time() - $this->data['transaction_time'] > 3600)
            throw new Exception('Download expired', 403);

        if(!is_int($this->data['ebook_id']))
            throw new Exception('Ebook_id must be a number', 400);

        if(strlen($this->data['transaction_key']) > 200)
            throw new Exception('Invalid transaction_key', 400);

        $this->data['client_id'] = $this->clientId;
    }

    public function download()
    {
        $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . Server\Config\SysConfig::$BASE_DOWNLOAD . 'get.php');
        $request->authenticate(false);
        $request->create();
        $request->setPost($this->data);

        try
        {
            $request->execute();
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode());
        }

        header('Content-Type: application/epub+zip');
        header('Content-Disposition: attachment; filename="'.md5(time()).'.epub"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
        header("Content-Length: ".strlen($request));

        exit($request);
    }

}