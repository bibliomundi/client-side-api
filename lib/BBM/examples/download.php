<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:36 PM
 */

$download = new BBM\Download('8effee409c625e1a2d8f5033631840e6ce1dcb64', 'testeclient');

$data = [
    'ebook_id' => 48,
    'transaction_time' => time(),
    'transaction_key' => 'chaveTransacaoTeste'
];

if($download->validate($data))
    $download->download();
