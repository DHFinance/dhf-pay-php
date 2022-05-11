# dhf-pay-php

PHP SDK to integrate with DHFinance in minutes.

# Getting Started

1. **Sign up** - Before you begin, you need to sign up for your payment gateway account (https://pay.dhfi.online as
   example) and retrieve your store API token (add Store - APIKey Generate) and API url (https://pay.dhfi.online/api/ as
   example).
2. **Requirements** – To run the SDK, your system will need to have PHP >= 7.2, cURL and Composer installed . We highly
   recommend having it compiled with the cURL extension and cURL 7.16.2+ compiled with a TLS backend (e.g., NSS or
   OpenSSL).
3. **Install** sdk using composer

```sh
 "require": {
        dhfinance/dhf-pay-php": "*"

    }
```

# Create payment

 ```sh
$dhfPay = new DHFPay('<API endpoint>', '<Token>');
$params = [
    "amount"=> 2500000000,
    "comment"=> "test comment"
];
$payment = $dhfPay
    ->payments()
    ->add($params);
```

# Payments List

```sh
$dhfPay->payments()->getAll();
```

# Get payments by id

```sh
$dhfPay->payments()->getOne($id);
```

# Get transactions list

```sh
$dhfPay->transaction()->getAll()
```

# Run tests

Set variables in tests/.env file (see .env.example)

```sh
TEST_SERVER_API=<API endpoint>
TEST_SERVER_TOKEN=<token>
TEST_STORE_ID=<store id>

```

then run

```sh
./vendor/bin/phpunit tests/DhfInIntegrationTestCasse.php
```



