<?php

namespace PHPieces\ANZGateway\enums;

class AcquirerResponseCode
{
    const APPROVED = 0;
    const REFER_TO_CARD_ISSUER = [1, 2];
    const INVALID_MERCHANT = 3;
    const PICK_UP_CARD = [4, 7];
    const DO_NOT_HONOUR = 5;
    const INVALID_TRANSACTION = 12;
    const INVALID_CARD_NUMBER__NO_SUCH_NUMBER = 14;
    const NO_SUCH_ISSUER = 15;
    const EXPIRED_CARD = [33, 54];
    const SUSPECTED_FRAUD = [34, 59];
    const RESTRICTED_CARD = [36, 62];
    const NO_CREDIT_ACCOUNT = 39;
    const CARD_REPORTED_LOST = 41;
    const STOLEN_CARD = 43;
    const INSUFFICIENT_FUNDS = 51;
    const TRANSACTION_NOT_PERMITTED = 57;
    const DAILY_LIMIT_WITH_CARD = 61;
    const EXCEEDS_WITHDRAWAL_FREQUENCY_LIMIT = 65;
    const BANK_LINK_ERROR = [91, 92, 96];
    const MESSAGE = [
        0  => 'Approved',
        1  => 'Refer to Card Issuer',
        2  => 'Refer to Card Issuer',
        3  => 'Invalid Merchant',
        4  => 'Pick Up Card',
        5  => 'Do Not Honour',
        7  => 'Pick Up Card',
        12 => 'Invalid Transaction',
        14 => 'Invalid Card Number (No such Number)',
        15 => 'No Such Issuer',
        33 => 'Expired Card',
        34 => 'Suspected Fraud',
        36 => 'Restricted Card',
        39 => 'No Credit Account',
        41 => 'Card Reported Lost',
        43 => 'Stolen Card',
        51 => 'Insufficient Funds',
        54 => 'Expired Card',
        57 => 'Transaction Not Permitted',
        59 => 'Suspected Fraud',
        61 => 'Daily limit with card',
        62 => 'Restricted Card',
        65 => 'Exceeds withdrawal frequency limit',
        91 => 'Bank link error',
        92 => 'Bank link error',
        96 => 'Bank link error'
    ];
}
