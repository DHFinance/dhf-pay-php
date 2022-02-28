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
 
