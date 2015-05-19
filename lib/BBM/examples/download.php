<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:36 PM
 */

$download = new BBM\Download('CLIENT_ID', 'CLIENT_SECRET');

// PEGA O HASH PASSANDO O ID DA COMPRA
$purchase_id = 100;
$hash = $download->getHash($purchase_id);

if($download->validate($hash))
    $download->download();
