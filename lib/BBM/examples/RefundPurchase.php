<?php

$sale_reverser = new BBM\RefundPurchase(CLIENT_ID, CLIENT_SECRET);
$sale_reverser->environment = BBM_API_ENV;

// UNCOMMENT THIS CODE TO ACTIVATE THE VERBOSE MODE
$sale_reverser->verbose(VERBOSE);

$transaction_key = 'MY_STORE_TESTS_1608050783';

$ebook_ids = [0];

$data = [
    'ebook_ids' => $ebook_ids,
    'transaction_key' => $transaction_key,
    'refund_reason' => "Reason for the refund"
];

try {
    $sale_reverser->validate($data); // validate the fields
    $sale_reverser->requestRefund(); // send the refund request
} catch (\BBM\Server\Exception $e) {
    die($e->getMessage());
}
