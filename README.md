# dhf-pay-php
PHP SDK to integrate with DHFinance in minutes.
# Install

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


# Get paymen by id
```sh
$dhfPay->payments()->getOne();
```
# Get transactions list
```sh
$dhfPay->transaction()->getAll()
```
# Run tests
```sh
./vendor/bin/phpunit tests/DhfTestCasse.php 
```





