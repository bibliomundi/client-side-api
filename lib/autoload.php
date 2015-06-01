<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 6/1/15
 * Time: 2:37 PM
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