<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/18/15
 * Time: 6:36 PM
 */

$download = new BBM\Download('testeclient', 'testeclient');

$data = [
    'ebook_id' => 48,
    'transaction_time' => 1433185687,
    'transaction_key' => 'chaveTransacaoTeste'
];

if($download->validate($data))
    echo $download->download();
