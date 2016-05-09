Txty class for PHP
============================

You'll need an account with Txty before using this API, it's free to try. [Click here to contact us](https://txty.dk/kontakt/ "Contact us").

Installation
------------

To install you only need the class txty.class.php which will contain the needed methods.

You can clone the repository via your terminal:

    git clone git@github.com:txtydk/txty-php.git

Usage
-----

Just include the class into your project:

    include_once 'txty.class.php';

Before using the methods implemented into the class, you'll need to authenticate, which luckily is easy:

    $authentication = new Authentication('user', 'key');

Examples
--------

### Send SMS

    // Initiate authentication
    $authentication = new Authentication('user', 'key');

    // Initiate SMS
    $sms = new TxtySMS($authentication);

    // Send SMS
    $result = $sms->sendSMS([
        'msisdn' => 4512345678,
        'sender' => 'TestClass',
        'text' => 'Test class text'
    ]);