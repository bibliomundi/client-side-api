<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:04 PM
 */

namespace BBM\Server;

/**
 * Class Request
 * @package BBM\Server
 */
class Request
{
    /**
     * @var string
     */
    protected $_useragent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1';
    /**
     * @var
     */
    protected $_url;
    /**
     * @var bool
     */
    protected $_followlocation;
    /**
     * @var int
     */
    protected $_timeout;
    /**
     * @var int
     */
    protected $_maxRedirects;
    /**
     * @var
     */
    protected $_post;
    /**
     * @var
     */
    protected $_postFields;
    /**
     * @var string
     */
    protected $_referer ="http://www.google.com";

    /**
     * @var
     */
    protected $_session;
    /**
     * @var
     */
    protected $_return;
    /**
     * @var bool
     */
    protected $_includeHeader;
    /**
     * @var bool
     */
    protected $_noBody;
    /**
     * @var
     */
    protected $_status;
    /**
     * @var bool
     */
    protected $_binaryTransfer;
    /**
     * @var
     */
    private $curlHandler;
    /**
     * @var int
     */
    private $authentication = 0;
    /**
     * @var string
     */
    private $auth_name      = '';
    /**
     * @var string
     */
    private $auth_pass      = '';

    /**
     * @param bool $y
     */
    public function authenticate($y = TRUE)
    {
        $this->authentication = $y;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->auth_name = $name;
    }

    /**
     * @param $pass
     */
    public function setPass($pass)
    {
        $this->auth_pass = $pass;
    }

    /**
     * @param      $url
     * @param bool $followlocation
     * @param int  $timeOut
     * @param int  $maxRedirecs
     * @param bool $binaryTransfer
     * @param bool $includeHeader
     * @param bool $noBody
     */
    public function __construct($url,$followlocation = true,$timeOut = 30,$maxRedirecs = 4,$binaryTransfer = false,$includeHeader = false,$noBody = false)
    {
        $this->_url = $url;
        $this->_followlocation = $followlocation;
        $this->_timeout = $timeOut;
        $this->_maxRedirects = $maxRedirecs;
        $this->_noBody = $noBody;
        $this->_includeHeader = $includeHeader;
        $this->_binaryTransfer = $binaryTransfer;
    }

    /**
     * @param $referer
     */
    public function setReferer($referer)
    {
        $this->_referer = $referer;
    }

    /**
     * @param $postFields
     */
    public function setPost ($postFields)
    {
        $this->_post = true;
        $this->_postFields = $postFields;
    }

    /**
     * @param $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->_useragent = $userAgent;
    }

    /**
     *
     */
    public function create()
    {
        $this->curlHandler = curl_init();

        curl_setopt($this->curlHandler,CURLOPT_URL,$this->_url);
        curl_setopt($this->curlHandler,CURLOPT_HTTPHEADER,array('Expect:'));
        curl_setopt($this->curlHandler,CURLOPT_TIMEOUT,$this->_timeout);
        curl_setopt($this->curlHandler,CURLOPT_MAXREDIRS,$this->_maxRedirects);
        curl_setopt($this->curlHandler,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->curlHandler,CURLOPT_FOLLOWLOCATION,$this->_followlocation);

        if($this->authentication == 1)
        {
            curl_setopt($this->curlHandler, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass);
        }

        if($this->_post)
        {
            curl_setopt($this->curlHandler,CURLOPT_POST,true);
            curl_setopt($this->curlHandler,CURLOPT_POSTFIELDS,$this->_postFields);
        }

        if($this->_includeHeader)
        {
            curl_setopt($this->curlHandler,CURLOPT_HEADER,true);
        }

        if($this->_noBody)
        {
            curl_setopt($this->curlHandler,CURLOPT_NOBODY,true);
        }

        if($this->_binaryTransfer)
        {
            curl_setopt($this->curlHandler,CURLOPT_BINARYTRANSFER,true);
        }

        curl_setopt($this->curlHandler,CURLOPT_USERAGENT,$this->_useragent);
        curl_setopt($this->curlHandler,CURLOPT_REFERER,$this->_referer);
    }

    /**
     *
     */
    public function execute()
    {
        $this->_return = curl_exec($this->curlHandler);
        $this->_status = curl_getinfo($this->curlHandler,CURLINFO_HTTP_CODE);
        curl_close($this->curlHandler);
    }

    /**
     * @return mixed
     */
    public function getHttpStatus()
    {
        return $this->_status;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->_return;
    }
}