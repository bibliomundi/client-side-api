<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 */

namespace BBM\Server;

/**
 * Class Connect
 * Nothing to do here for while.
 * @package BBM\Server
 */
class Connect
{
    /**
     * CLIENT ID, this string is sent to you by the Bibliomundi, and must be
     * the same in all areas of this API.
     * @property String
     */
    public $clientId;

    /**
     * CLIENT SECRET, this string is sent to you by the Bibliomundi, and must be
     * the same in all areas of this API.
     * @property String
     */
    public $clientSecret;


    /**
     * ClientID and ClientSecret is first validated here, if it do not fit, will be thrown
     * an exception.
     * @param $clientId
     * @param $clientSecret
     *
     * @throws Exception
     */
    public function __construct($clientId, $clientSecret)
    {
        // FIRST CHECK, WILL BE DOUBLE CHECKED IN SERVER-SIDE.
        if(strlen($clientId) > 40 || strlen($clientSecret) > 40)
            throw new Exception('Invalid Credentials', 400);

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }
}