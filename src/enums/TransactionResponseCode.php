<?php

namespace PHPieces\ANZGateway\enums;

/**
 * The Transaction Response Code (also known as the
 * Grouped Code or QSI) shows the overall result of a
 * transaction. The field name for the Transaction Response
 * Code is vpc_TxnResponse.
 */
class TransactionResponseCode
{
    const TRANSACTION_APPROVED = 0;
    const TRANSACTION_COULD_NOT_BE_PROCESSED = 1;
    const TRANSACTION_DECLINED__CONTACT_ISSUING_BANK = 2;
    const NO_REPLY_FROM_PROCESSING_HOST = 3;
    const CARD_HAS_EXPIRED = 4;
    const INSUFFICIENT_CREDIT = 5;
    const ERROR_COMMUNICATING_WITH_BANK = 6;
    const MESSAGE_DETAIL_ERROR = 7;
    const TRANSACTION_DECLINED__TRANSACTION_TYPE_NOT_SUPPORTED = 8;
    const BANK_DECLINED_TRANSACTION__DO_NOT_CONTACT_BANK = 9;
    const MESSAGE = [
        0 => 'Transaction approved',
        1 => 'Transaction could not be processed',
        2 => 'Transaction declined - contact issuing bank',
        3 => 'No reply from Processing Host',
        4 => 'Card has expired',
        5 => 'Insufficient credit',
        6 => 'Error Communicating with Bank',
        7 => 'Message Detail Error',
        8 => 'Transaction declined – transaction type not supported',
        9 => 'Bank Declined Transaction – Do Not Contact Bank'
    ];
}
