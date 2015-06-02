<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 */

// NEW INSTANCE OF THE DOWNLOAD. EVERY NEW DOWNLOAD MUST BE A NEW INSTANCE.
$download = new BBM\Download('YOUR_CLIENT_ID', 'YOUR_CLIENT_STORE');

$data = [
    'ebook_id' => 1, // YOU MUST 1 TO TEST, ANYONE MORE WILL BE COUNT AS AN ACTUAL DOWNLOAD.
    'transaction_time' => time(), // IT`S HIGHLY RECOMMENDED THAT YOU CANNOT CHANGE THE TRANSACTION TIME.
    'transaction_key' => 'TEST_TRANSACTION_KEY' // YOU MUST SET THIS TO TEST, ANY OTHER ACTIVE TRANSACTION KEY WILL BE COUNT AS AN ACTUAL DOWNLOAD.
];

if($download->validate($data)) // IF IS A VALID REQUEST.
    $download->download(); // EXECUTE THE DOWNLOAD.

/*
 * IF YOU WANT TO HANDLE THE ERRORS, USE TRY/CATCH AS BELOW:
 */

//try
//{
//    $download->validate($data);
//    $download->download();
//}
//catch(\BBM\Server\Exception $e)
//{
//    // HERE YOU CAN HANDLE THE ERROR AS YOU WANT TO.
//    // EXAMPLE:
//    throw new TestException($e->getMessage(), $e->getCode());
//}

/*
 * EVERY ERROR ON THE REQUEST OR IN THE VALIDATIONS WILL THROWN A EXCEPTION.
 */