<?php

namespace PHPieces\ANZGateway;

use PHPieces\ANZGateway\models\Card;
use PHPieces\ANZGateway\models\Merchant;
use PHPieces\ANZGateway\models\Payment;
use PHPieces\ANZGateway\models\TransactionSource;
use ReflectionClass;

class ChargeRequest
{
    const VPC_VERSION = "vpc_Version";
    const COMMAND_TYPE = "vpc_Command";

    /**
     *
     * @var Card
     */
    private $card;

    /**
     *
     * @var Merchant
     */
    private $merchant;

    /**
     *
     * @var TransactionSource
     */
    private $transactionSource;

    /**
     *
     * @var PaymPayment  */
    private $payment;

    /**
     * The value for this field is always 1 and is the same for test
     * and live transactions.
     * @var int
     */
    private $version = 1;

    /**
     * The value for this field is always ‘pay’ and is the same for
     * test and live transactions.
     * @var string
     */
    private $commandType = 'pay';

    public function __construct(
        Card $card,
        Merchant $merchant,
        TransactionSource $transactionSource,
        Payment $payment
    ) {
    

        $this->card = $card;
        $this->merchant = $merchant;
        $this->transactionSource = $transactionSource;
        $this->payment = $payment;
    }

    public static function create($params)
    {
        return new self(
            Card::create($params),
            Merchant::create($params),
            TransactionSource::create($params),
            Payment::create($params)
        );
    }

    public function toArray()
    {
        return array_merge(
            $this->card->toArray(),
            $this->merchant->toArray(),
            $this->transactionSource->toArray(),
            $this->payment->toArray(),
            [
            self::COMMAND_TYPE => $this->commandType,
            self::VPC_VERSION  => $this->version,
            ]
        );
    }

    public static function getFields()
    {
        return array_merge(
            Card::getFields(),
            Payment::getFields(),
            TransactionSource::getFields(),
            Merchant::getFields()
        );
    }
}
