<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:12 PM
 */

namespace BBM\Server\Config;


class SysConfig {

    public static $BASE_CONNECT_URI = 'http://connect.bibliomundi.com/';

    public static $BASE_CATALOG = 'catalog/';

    public static $BASE_DOWNLOAD = 'download/';

    public static $BASE_PURCHASE = 'purchase/';

    public static $NUMBER_OF_TRIES = 3;

    public static $GRANT_TYPE = 'client_credentials';
}