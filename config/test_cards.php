<?php

use PHPieces\ANZGateway\enums\FormFields\CardFields;

return [
    [CardFields::CARD_NUMBER => 5123456789012346, CardFields::CARD_EXPIRY_DATE => '1705', CardFields::CARD_SECURITY_CODE => 123, 'type' => 'MasterCard'],
    [CardFields::CARD_NUMBER => 5313581000123430, CardFields::CARD_EXPIRY_DATE => '1705', CardFields::CARD_SECURITY_CODE => 123, 'type' => 'MasterCard'],
    [CardFields::CARD_NUMBER => 4005550000000001, CardFields::CARD_EXPIRY_DATE => '1705', CardFields::CARD_SECURITY_CODE => 123, 'type' => 'Visa'],
    [CardFields::CARD_NUMBER => 4557012345678902, CardFields::CARD_EXPIRY_DATE => '1705', CardFields::CARD_SECURITY_CODE => 123, 'type' => 'Visa'],
    [CardFields::CARD_NUMBER => 345678901234564, CardFields::CARD_EXPIRY_DATE => '1705', CardFields::CARD_SECURITY_CODE => 1234, 'type' => 'Amex'],
    [CardFields::CARD_NUMBER =>  30123456789019, CardFields::CARD_EXPIRY_DATE => '1705', CardFields::CARD_SECURITY_CODE => 123, 'type' => 'Diners Club'],
];
