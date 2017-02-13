# ANZ Payment Gateway

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a wrapper for the ANZ payment gateway to make it easier to use. THIS IS NOT PRODUCED BY ANZ, it comes without warranty, 
However the code is thoughoghly tested and used in production

## Installation

Add the repo to your composer file:
```json
{
    "require": {
        "PHPieces/anz-egate": "dev-master"
    }
}
```

## Usage


get fields:
```php
use PHPieces\ANZGateway\ChargeRequest;
$fields = ChargeRequest::getFields();
```

This will give all fields, including those relevant to the merchant details.
It is more likely the case that you only want the credit card fields:
```php
use PHPieces\ANZGateway\models\Card;
$fields = Card::getFields();
```

Render:
```html
<? foreach($fields as $label => $name) : ?>
    <div class="form-group">
        <label for="<?= $name ?>"><?= $label ?></label>
        <input type="text" class="form-control" id="<?= $name ?>" name="<?= $name ?>" >
    </div>
<? endforeach; ?>
```

Process:
```php
use PHPieces\ANZGateway\enums\FormFields\CardFields;
use PHPieces\ANZGateway\Gateway;

$gateway = Gateway::create();
$gateway->setAccessCode('mycode');
$gateway->setMerchantID('myid');

$response = $gateway->purchase([
    // This field must be unique for every transaction attempt.
    'vpc_MerchTxnRef'              => 'mymerchid',
    // This field will show up on the merchant account and is the primary way to search for transactions.
    'vpc_OrderInfo'                => 'orderid',
    // cents AUD
    'vpc_Amount'                   => '100',
    // using the available enum values for the form fields
    CardFields::CARD_NUMBER        => $_POST[CardFields::CARD_NUMBER],
    //YYmm
    CardFields::CARD_EXPIRY_DATE   => $_POST[CardFields::CARD_EXPIRY_DATE],
    // code from back of card
    CardFields::CARD_SECURITY_CODE => $_POST[CardFields::CARD_SECURITY_CODE],
])->send();

if($response->isSuccess()) {
    //proceed...
} else {
    $error = $response->getMessage();
}

```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpieces/anz-egate.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpieces/anz-egate/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phpieces/anz-egate.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phpieces/anz-egate.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpieces/anz-egate.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpieces/anz-egate
[link-travis]: https://travis-ci.org/phpieces/anz-egate
[link-scrutinizer]: https://scrutinizer-ci.com/g/phpieces/anz-egate/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phpieces/anz-egate
[link-downloads]: https://packagist.org/packages/phpieces/anz-egate
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors