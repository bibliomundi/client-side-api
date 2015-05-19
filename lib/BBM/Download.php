<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:03 PM
 */

namespace BBM;

use BBM\Server;
use BBM\Server\Exception;

/**
 * Class Download
 * @package BBM
 */
class Download extends Connect {

    public function getHash($purchase_id)
    {
        $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . Server\Config\SysConfig::$BASE_DOWNLOAD . 'getHash');
        $request->build(array('purchase_id' => $purchase_id));

        try
        {
            $request->send();
        }
        catch(Exception $e)
        {
            // DEBUG -> $request->getErrors();
            throw new Exception($request->getErrors(), $e->getCode());
        }

        return $request->getResponse();
    }

    public function validate($hash)
    {
        $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . Server\Config\SysConfig::$BASE_DOWNLOAD . 'validate');
        $request->build(array('hash' => $hash));

        try
        {
            $request->send();
        }
        catch(Exception $e)
        {
            // DEBUG -> $request->getErrors();
            throw new Exception($request->getErrors(), $e->getCode());
        }

        return $request->getResponse();
    }

    public function download()
    {
        $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . Server\Config\SysConfig::$BASE_DOWNLOAD . 'download');
        $request->build();

        try
        {
            $request->send();
        }
        catch(Exception $e)
        {
            // DEBUG -> $request->getErrors();
            throw new Exception($request->getErrors(), $e->getCode());
        }

        return $request->getResponse();
    }

}