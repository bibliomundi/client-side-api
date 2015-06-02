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