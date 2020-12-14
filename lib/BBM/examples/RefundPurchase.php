<?php

$sale_reverser = new BBM\RefundPurchase(CLIENT_ID, CLIENT_SECRET);
$sale_reverser->environment = BBM_API_ENV;

// UNCOMMENT THIS CODE TO ACTIVATE THE VERBOSE MODE
$sale_reverser->verbose(true);

$transaction_key = 'MANUAL_4_1605812866';

$ids = [1065];

$data = [
    'ebook_ids' => $ids,
    'transaction_key' => $transaction_key,
    'refund_reason' => "The reason to request the refund"
];

try {
    $sale_reverser->validate($data); // validate the fields
    $sale_reverser->requestRefund(); // send the refund request
} catch (\BBM\Server\Exception $e) {
    die($e->getMessage());
}
