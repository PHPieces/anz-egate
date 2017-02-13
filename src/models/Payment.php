<?php

namespace PHPieces\ANZGateway\models;

use PHPieces\ANZGateway\enums\FormFields\PaymentFields;
use PHPieces\ANZGateway\exceptions\InvalidCostException;
use PHPieces\ANZGateway\exceptions\RequiredArgumentException;

class Payment extends Model
{
    protected static $fields = PaymentFields::class;

    /**
     * The amount of a transaction must be converted into units of
     * cents. For example, an amount of $1 must be entered as 100.
     * If the amount was $100.50, this must be entered as 10050.
     * @var int
     */
    private $purchaseAmount;

    /**
     *  This is a required field and may have a
     *  maximum of 34 alpha numeric characters. This will appear
     *  in the Shopping Transactions Report on the MA site and is
     *  a searchable field so should be used as the primary
     *  reference number for transactions, for example the order
     *  number, invoice number, or customer number. This field
     *  label is Transaction OrderInfo in the Sample Code.
     * @var String
     */
    private $orderInfo;

    /**
     * This is an optional field that can store up to 15 alpha
     * numeric characters.
     * @var String
     */
    private $ticketNo;

    /**
     *
     * @param int $purchaseAmount
     * @param String $orderInfo
     * @param String $ticketNo
     */
    public function __construct($purchaseAmount, $orderInfo, $ticketNo = '')
    {
        $this->purchaseAmount = (int) $purchaseAmount;

        $this->orderInfo = (string) $orderInfo;

        $this->ticketNo = (string) $ticketNo;

        $this->validate();
    }

    public function validate()
    {
        
        if ($this->purchaseAmount < 1) {
            throw new InvalidCostException("Cannot create a charge for less than 1 cent");
        }
        if (empty($this->orderInfo)) {
            throw new RequiredArgumentException();
        }
        if (strlen($this->orderInfo) > 34) {
            throw new \Exception("length of order info too long");
        }
    }

    public function toArray()
    {
        return [
            PaymentFields::PURCHASE_AMOUNT       => $this->purchaseAmount,
            PaymentFields::TRANSACTION_ORDER_INFO => $this->orderInfo,
            PaymentFields::TICKET_NO              => $this->ticketNo,
        ];
    }
}
