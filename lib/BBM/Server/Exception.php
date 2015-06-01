<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:48 PM
 */

namespace BBM\Server;


class Exception extends \Exception {

    public function __construct($errors, $code)
    {
        if(is_array($errors))
            parent::__construct(implode(' - ', $errors), $code);
        else
            parent::__construct($errors, $code);
    }

}