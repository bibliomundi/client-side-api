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
/**
 * Class Request
 * @package BBM\Server
 */
class Request
{

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
     * @param null $auth_name
     * @param null $auth_pass
     */
    public function authenticate($y = TRUE, $auth_name = null, $auth_pass = null)
    {
        $this->authentication = $y;

        if($auth_name && $auth_pass)
        {
            $this->setName($auth_name);
            $this->setPass($auth_pass);
        }
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
     * @param $postFields
     */
    public function setPost($postFields)
    {
        $this->_post = true;
        $this->_postFields = $postFields;
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

        if($this->authentication)
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

        curl_setopt($this->curlHandler,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($this->curlHandler,CURLOPT_REFERER, $_SERVER['SERVER_NAME']);
    }

    /**
     *
     */
    public function execute()
    {
        $this->_return = curl_exec($this->curlHandler);
        $this->_status = curl_getinfo($this->curlHandler,CURLINFO_HTTP_CODE);
        curl_close($this->curlHandler);

        if($this->getHttpStatus() == 200)
            return $this->_return;
        else
            throw new Exception($this->_return, $this->getHttpStatus());
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