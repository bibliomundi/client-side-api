<?php

$download = new BBM\ReversePurchase(CLIENT_ID, CLIENT_SECRET);
$download->environment = BBM_API_ENV;

// UNCOMMENT THIS CODE TO ACTIVATE THE VERBOSE MODE
//$download->verbose(true);

$data = [
    'ebook_id' => $EBOOKID, // YOU MUST 1 TO TEST, ANYONE MORE WILL BE COUNT AS AN ACTUAL DOWNLOAD.
    'transaction_time' => time(), // IT`S HIGHLY RECOMMENDED THAT YOU CANNOT CHANGE THE TRANSACTION TIME.
    'transaction_key' => $TIMESTAMP // YOU MUST SET THIS TO TEST, ANY OTHER ACTIVE TRANSACTION KEY WILL BE COUNT AS AN ACTUAL DOWNLOAD.
];

/*
 * IF YOU WANT TO HANDLE THE ERRORS, USE TRY/CATCH AS BELOW:
 */

try {
    $download->validate($data); // VALIDATE THE DOWNLOAD
    $download->reverse(); // TRY TO DOWNLOAD THE FILE
} catch (\BBM\Server\Exception $e) {
    // HERE YOU CAN HANDLE THE ERROR AS YOU WANT TO.
    // EXAMPLE:
    die($e->getMessage());
}

/*
 * EVERY ERROR ON THE REQUEST OR IN THE VALIDATIONS WILL THROW A EXCEPTION.
 */