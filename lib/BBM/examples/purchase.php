<?php
/**
 * Created by Bibliomundi.
 * User: Victor Martins
 * Contact: victor.martins@bibliomundi.com.br
 * Site: http://bibliomundi.com.br
 *
 * The MIT License (MIT)
 * Copyright (c) 2015 bibliomundi
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

// NEW INSTANCE OF THE DOWNLOAD. EVERY NEW DOWNLOAD MUST BE A NEW INSTANCE.
$purchase = new BBM\Purchase('8effee409c625e1a2d8f5033631840e6ce1dcb64', 'testeclient');

$data = [
    'bibliomundiEbookID' => 1,
    'price' => 50,
    'customerIdentificationNumber' => 32,
    'customerFullname' => 'Astolfo Henrique',
    'customerEmail' => 'contato@vfreitas.com',
    'customerGender' => 'm',
    'customerBirthday' => '11/03/1991',
    'customerCountry' => 'BR',
    'customerZipcode' => '2250145',
    'customerState' => 'RJ'
];

var_dump($purchase->validate($data));

//
//if($purchase->validate($data)) // IF IS A VALID REQUEST.
//    $purchase->download(); // EXECUTE THE DOWNLOAD.
