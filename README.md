##About the API
Bibliomundi is a ebook distributor, almost a marketplace, this API is used to handle the request between the store (client) and the application server, that host the ebook system. No configuration needed, just a ready-to-go application that was developed to make easier the client-side request.

All the requests are OAuth2 authenticated by client\_credentials method, and the API uses [cURL] to execute itself.

### Version
0.2 - We are in current development, as soon as possible we will launch the live app.

### Tech

Bibliomundi API uses the following technologies:

* [PHP 5.5]
* [cURL]

### Installation

No further installation is needed, only clone the repository and follow the examples. So easy as it should be.

```sh
$ git clone https://github.com/bibliomundi/client-side-api.git bibliomundi-api
```


###License

MIT


**Free Software, Hell Yeah!**

[php 5.5]:http://php.net/
[curl]:http://php.net/manual/en/book.curl.php

