<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:04 PM
 */

namespace BBM\Server;

/**
 * Class Connect
 * @package BBM\Server
 */
/**
 * Class Connect
 * @package BBM\Server
 */
class Connect {

    /**
     * @property string
     */
    private $client_id = 'YOUR_CLIENT_ID';
    /**
     * @property string
     */
    private $client_secret = 'YOUR_CLIENT_SECRET';

    /**
     * @param $client_id
     * @param $client_secret
     */
    public function __construct($client_id, $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }
}