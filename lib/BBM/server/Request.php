<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:04 PM
 */

namespace BBM\Server;


class Request {

    protected $client_id;
    protected $client_secret;

    private $curl_handler;

    public function setCredentials(){}

    public function build(){}

    private function getAccessToken(){}

    public function send(){}

    public function getResponse(){}

    public function getErrors(){}

}