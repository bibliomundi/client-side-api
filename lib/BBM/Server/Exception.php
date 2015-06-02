<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 */

namespace BBM\Server;

/**
 * Class Exception
 * Nothing to do here for while.
 * @package BBM\Server
 */
class Exception extends \Exception {

    /**
     * @param string $errors
     * @param int    $code
     */
    public function __construct($errors, $code)
    {
        if(is_array($errors))
            parent::__construct(implode(' - ', $errors), $code);
        else
            parent::__construct($errors, $code);
    }

}