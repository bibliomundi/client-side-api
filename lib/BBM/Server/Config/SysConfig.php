<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 */

namespace BBM\Server\Config;

/**
 * Class SysConfig
 * Just a config file, nothing to do here.
 * @package BBM\Server\Config
 */
class SysConfig {

    /**
     * @var string
     */
    public static $BASE_CONNECT_URI = 'http://connect.bibliomundi.com/';

    /**
     * @var string
     */
    public static $BASE_CATALOG = 'ebook/';

    /**
     * @var string
     */
    public static $BASE_DOWNLOAD = 'ebook/';

    /**
     * @var string
     */
    public static $BASE_PURCHASE = 'ebook/';

    /**
     * @var string
     */
    public static $GRANT_TYPE = 'client_credentials';
}