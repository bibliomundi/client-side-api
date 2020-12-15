#About the API
We are Bibliomundi, an ebook distributor and have made this api with the purpose of integrating our ebooks with your store's platform. In order to commercialize our ebooks at your store, it does require knowledge of programing.
OBS: This API requires knowledge of PHP coding. In case you work with other coding standards, we have published the complete webservice which may be accessed through this <a href="https://drive.google.com/file/d/0BzwFNhJ9FBNwS0JCSzA3cXFPYUk/view">link</a>.


# Requirements
- <a href="http://php.net/manual/en/book.curl.php" target="blank">cURL</a>
- <a href="http://php.net/" target="blank">PHP >= 5.6</a>
- Knowledge of <a href="http://www.editeur.org/83/Overview/" target="blank">Onix</a>
- Key and Secret. If you do not possess these credentials, please contact us at contato@bibliomundi.com.br.

# Workflow
1. Import our complete calalogue. We will deliver the complete ONIX standard XML with all o four active ebooks.

2. Insert the ebooks from our database following the ONIX standard.

3. Update daily to verify if there are new ebooks, in case of a metadata update (e.g. title change) or if there are ebooks that have been deactivated which need to be removed from sale. We deliver an ONIX standard XML with the ebooks that require updating, adding or deleting.

4. Enable the ebooks for sale at your store.

5. Enable the download for a customer.. 
 
# Instalation

Simply download (or clone), add to your Project and then make a call to the file “autoload.php”, which is located within the &quot;lib&quot; folder. Concluding this step, you will have access to all of the API´s functionalities.

<pre>Ex: require &#39;lib/autoload.php&#39;</pre>

# Step 1 - Importing the ebooks to your store

Instance the Catalogue class by sending your credentials as parameter.
<pre>$catalog = new BBM\Catalog('YOUR_API_KEY', 'YOUR_API_SECRET');</pre>
Define if the environmente you will import our ebooks will be Production or Sandbox.
<pre>
$catalog->environment = 'production';
ou
$catalog->environment = 'sandbox'; 
</pre>

The following code is optional. It allows you to filter for ebooks which contain or not DRM protection.
<pre> 
$catalog->filters( array('drm' => 'no') );)//Will only deliver unprotected
ou
$catalog->filters( array('drm' => 'yes') );)// Will only deliver protected
</pre>

Another optional code. We offer the option of importing the ebook covers at a pre-determined size, allowing you to save on server space, for example.

<pre>
$catalog->filters( array('image_height' => 500) ););//Delivers covers at the height of 500px
...
$catalog->filters( array('image_width' => 700) ););//Delivers covers at the width of 700px
...
$catalog->filters( array('image_width' => 1024, 'image_height' => 768) );//Delivers covers at the width of 1024px e height de 768px
</pre>

At the end of this step, validate your credentials and import de ebooks.
<pre>
try
{
    $catalog->validate();//Validate your transactions
    $xml = $catalog->get();//Returns an <a href="https://github.com/bibliomundi/client-side-api/blob/master/onix-essential.xml" target="blank">XML</a>, with the string format and ONIX standard, containing all the active ebooks in our platform
}
catch(\BBM\Server\Exception $e)
{
    var_dump($e);
}
</pre>

Each tag &lt;Product&gt; returned by <a href="https://github.com/bibliomundi/client-side-api/blob/master/onix-essential.xml" target="blank">XML</a> is an ebook. You will run through all of them, following the ONIX standard and insert them into your database.

For more details, view an example <a href="https://github.com/bibliomundi/client-side-api/tree/master/lib/BBM/examples/catalog.php">here<a/>.

# Step 2 - Inserting the ebooks in your store
Once having imported our ebooks´s <a href="https://github.com/bibliomundi/client-side-api/blob/master/onix-essential.xml" target="blank">XML</a>, you may work in the matter you prefer but we strongly recommend using a Parser, like PHP´s Simple XML for example. It will be your responsibility to insert the ebooks with a minimum amount of basic information. We also recommend not inserting titles which are not available for sale, and for that you must check the tags &lt;PublishingStatus&gt; and &lt;ProductAvailability&gt;. By clicking <a target="blank" href="https://github.com/bibliomundi/client-side-api/blob/master/onix-essential.xml">here</a> you will see an example of the XML, which we deliver to you using ONIX standard, and the information we consider most essential.

# Step 3 - Daily Updates
Our routine is to update our systems daily and you will have to create one too.Create a daily routine to verify if there are new titles added, updated or removed. We recommend you create a task reminder to run between 01 and 06 AM (GMT -3) in order to avoid displaying ebooks with outdated information resulting in an error generation.

Simply add a third parameter called &#39;updates&#39;.

<pre>$catalog = new BBM\Catalog('YOUR_API_KEY', 'YOUR_API_SECRET', 'updates');</pre>

It does not change the routine for the usual request.

<pre>
$catalog->environment = 'production';
ou
$catalog->environment = 'sandbox';

try
{
    $catalog->validate();//Validate your credentials
    $xml = $catalog->get();//Returns an XML with the ebooks and their respective routines (insert, update or delete) in a string format and ONIX

standard
}
catch(\BBM\Server\Exception $e)
{
    var_dump($e);
}
</pre>

For each tag &lt;Product&gt;, returned by the XML, there is a tag named &lt;NotificationType&gt; indicating the operation to be performed.

Ex: 03 -> inserir. 04 -> Atualizar. 05 -> Deletar.

# Step 4 - Transactions
Once you have finished importing the catalogue, your consumers will be able to purchase the ebooks. Every time a consumer attempts to purchase an ebook from us, it is required that you validate the transaction with us before they head to the checkout. Notice that your validation and checkout and our validation and checkout are two different processes. You must always validate and checkout with us so that we may be aware that the transaction has been made so that we may approve the ebook´s download. Keep that in mind.

Workflow::

- Consumer purchases one or more of our products.
- You validade the transaction through the Validate() funcition.
- If confirmed you may proceed to both your and our checkouts.

Instance a Purchase class by sending your credentials as parameters.
<pre>$purchase = new BBM\Purchase('YOUR_API_KEY', 'YOUR_API_SECRET');</pre>

Choose your environment.
<pre>
$catalog->environment = 'production';
ou
$catalog->environment = 'sandbox';
</pre>

Send us the user information that made the transaction respecting the rules below.
<pre>
$customer = [
    'customerIdentificationNumber' => 1, // INT, YOUR STORE CUSTOMER ID
    'customerFullname' => 'CUSTOMER NAME', // STRING, CUSTOMER FULL NAME
    'customerEmail' => 'customer@email.com', // STRING, CUSTOMER EMAIL
    'customerGender' => 'm', // ENUM, CUSTOMER GENDER, USE m OR f (LOWERCASE!! male or female)
    'customerBirthday' => '1991/11/03', // STRING, CUSTOMER BIRTH DATE, USE Y/m/d (XXXX/XX/XX)
    'customerCountry' => 'BR', // STRING, 2 CHAR STRING THAT INDICATE THE CUSTOMER COUNTRY (BR, US, ES, etc)
    'customerZipcode' => '31231223', // STRING, POSTAL CODE, ONLY NUMBERS
    'customerState' => 'RJ' // STRING, 2 CHAR STRING THAT INDICATE THE CUSTOMER STATE (RJ, SP, NY, etc)
];

$purchase->setCustomer($customer);
</pre>

Then insert the ebook by adding its ID and Price and then inform the currency.
<pre>$purchase->addItem($ebookID, $ebookPrice, 'USD');</pre>

Check <a href="https://github.com/bibliomundi/client-side-api/blob/master/currency.md">here<a/> the full list.

OBS: You may add as many ebooks as necessary by simply repeating the procedure.

Then validate the ebooks and follow to checkout.

<pre>
try
{
    $purchase->validate();
    
    //A transaction key may be anything but we recommend using the same as the effective transaction. It will be requested when the attempting to download the ebooks related to this checkout.
    $purchase->checkout('TRANSACTION_KEY', time());
}
catch(\BBM\Server\Exception $e)
{
    var_dump($e);
}
</pre>

Done. If everything has run smoothly, you have just registered a sale with us.

For more detailes, se the following example <a href="https://github.com/bibliomundi/client-side-api/tree/master/lib/BBM/examples/purchase.php">here<a/>.

OBS..
- Do not sell the ebook to your customer without validating with us first,because there are conditions which may invalidate the sale such as your store not being active or issues with the ebook.
- Do not forget to confirm the checkout with us and you must only do so once the payment is confirmed with your client.

# Step 5 - Download
Once your customer has purchased one of our ebooks, you validated the transaction and made the checkout, they will be able to download the ebook. It will be your decision the way in which to make the link (or similar) available for your client to make the download. With us, all you need to download the ebook is inform us the transaction ID (the same used at the checkout) and the ebook´s ID.

Instance the download class by delivering your credentials as parameters.
<pre>$download = new BBM\Download('YOUR_APY_KEY', 'YOUR_API_SECRET');</pre>

Select the environment.
<pre>
$catalog->environment = 'production';
ou
$catalog->environment = 'sandbox';
</pre>

<pre>
$data = [
    'ebook_id' => $EBOOKID,
    'transaction_time' => time(),
    'transaction_key' => $TIMESTAMP // The key you have used to confirm the checkout
];
</pre>

<pre>
try
{
    $download->validate($data);
    $download->download();// Faz o download do ebook
}
catch(\BBM\Server\Exception $e)
{
    var_dump($e);
}
</pre>

If everything runs smoothly, as you request the download() function, the ebook file will be automatically downloaded to the consumer´s gadget since it is an Endpoint.

For more details, se the following example <a href="https://github.com/bibliomundi/client-side-api/tree/master/lib/BBM/examples/download.php">aqui<a/>.

# Refund a Purchase (Work in Progress)
Sometimes your customer may want to request a refund and doing so, your store needs to send us the request. 

You only need three fields.
| field           	| type   	| required 	| description                                                                    	|   	|
|-----------------	|--------	|----------	|--------------------------------------------------------------------------------	|---	|
| transaction_key 	| string 	| yes      	| the transaction key you sent us when you created the purchase through our API  	|   	|
| ebook_ids       	| array  	| yes      	| an array containing the ids of the ebooks you want to refund from the purchase 	|   	|
| refund_reason   	| string 	| yes      	| the reason why the refund is being requested                                   	|   	|

Here's a code sample.
<pre>
$sale_reverser = new BBM\RefundPurchase(CLIENT_ID, CLIENT_SECRET);

$data = [
    'transaction_key' => 'MY_STORE_TRANSACTION',
    'ebook_ids' => [/*ebook_ids from the transaction*/],
    'refund_reason' => "Reason for the refund"
];

$response = $sale_reverser->requestRefund();
</pre>
### The Response
In the response, you will receive an associative array where the keys are each one of ebook_ids you sent into the request.
| field   	| type    	| description                                                            	|
|---------	|---------	|------------------------------------------------------------------------	|
| code    	| integer 	| internal response code regarding the action of execution of the refund 	|
| message 	| string  	| the message of the execution of the refund                             	|

There are two cases where the refund will be automatically accepted:
- was requested within period demanded by law(seven days);
- the store and the ebooks's imprint belong to the same company.

Otherwise, the request will be sent to the imprint and you will have to wait for their approval.

### The Message Codes
| code 	| message                                                        	|
|------	|----------------------------------------------------------------	|
| -1   	| Ebook was not found in this transaction                        	|
| 0    	| Refund has already been refused(reason will be in the message) 	|
| 1    	| Refund has already been sent to imprint's analysis             	|
| 2    	| Refund has already been approved                               	|
| 3    	| Refund has been sent to imprint's analysis                     	|
| 4    	| Refund has automatically been approved                         	|
| 5    	| Refund has automatically been refused                          	|

# Errors
Errors may occur at all stages (Complete, Update, Validate, Checkout and Download) and will be of your responsibility to treat them and inform to the user if it is the case. Regardless of the requisition which is being made, we always return an Exception with information about the error. You may check the errors list and their respective stages <a href="https://github.com/bibliomundi/client-side-api/blob/master/errors.md" target="blank">here</a>. We have also made available the <a href="https://github.com/bibliomundi/client-side-api/tree/master/docs/" target="blank">documentation</a> generated by <a target="blank" href="http://www.phpdoc.org/" target="blank">PHPDoc.</a>
