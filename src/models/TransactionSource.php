<?php

namespace PHPieces\ANZGateway\models;

use PHPieces\ANZGateway\enums\FormFields\TransactionFields;
use PHPieces\ANZGateway\exceptions\InvalidArgumentException;

class TransactionSource extends Model
{
    protected static $fields = TransactionFields::class;

    private $type;

    /**
     * Only use this field if you are implementing an application
     * that mixes web shopping transactions and a phone order
     * system. You must discuss the use of this field with the ANZ
     * eGate team.
     *
     * @var string
     */
    private $subType;

    private $types = [
        "INTERNET"  => "Indicates an Internet transaction",
        "MAILORDER" => "Indicates a mail order transaction",
        "TELORDER"  => "Indicates a telephone order transaction",
    ];
    
    private $subTypes = [
        ""            => "No subtype",
        "SINGLE"      => "Indicates a single payment to complete order",
        "INSTALLMENT" => "Indicates an installment transaction",
        "RECURRING"   => "Indicates a recurring transaction",
    ];

    public function __construct($type = 'INTERNET', $subType = '')
    {
        $this->type = (string) $type;
        $this->subType = (string) $subType;
        $this->validate();
    }

    public function validate()
    {
        if (!array_key_exists($this->type, $this->types)) {
            throw new InvalidArgumentException("invalid transaction type supplied");
        }

        if (!array_key_exists($this->subType, $this->subTypes)) {
            throw new InvalidArgumentException("Invalid transaction subtype supplied");
        }
    }

    public function toArray()
    {
        return [
            TransactionFields::TYPE_FIELD     => $this->type,
            TransactionFields::SUB_TYPE_FIELD => $this->subType
        ];
    }
}
