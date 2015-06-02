<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 */

/**
 * This file is used to autoload the API library
 */

$classes = [
    'BBM\Server\Config\SysConfig',
    'BBM\Server\Connect',
    'BBM\Server\Exception',
    'BBM\Server\Request',
    'BBM\Download',
    'BBM\Catalog',
    'BBM\Purchase'
];

/**
 * Used to load the class passed by parameter.
 * @param $className
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

foreach($classes as $class)
{
    autoload($class);
}