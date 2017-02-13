<?php

namespace PHPieces\ANZGateway\models;

use PHPieces\ANZGateway\enums\FormFields\CardFields;
use PHPieces\ANZGateway\exceptions\CardExpiredException;
use DateTime;

class Card extends Model
{
    protected static $fields = CardFields::class;

    /**
     * Card number
     *
     * @var int
     */
    private $cardNumber;

    /**
     * Card expiry date in the format mm/YY
     *
     * @var int
     */
    private $expiryDate;

    /**
     * Security code from back of card
     *
     * @var int
     */
    private $securityCode;

    /**
     * Card type, eg. Mastercard, Visa...
     * @var string
     */
    private $cardType;

    /**
     *
     * @param int $cardNumber
     * @param int $expiryDate
     * @param int $securityCode
     * @param string $cardType
     */
    public function __construct($cardNumber, $expiryDate, $securityCode, $cardType
    = '')
    {
        $this->cardType = (string) $cardType;

        $this->cardNumber = (int) $cardNumber;

        $this->expiryDate = (int) $expiryDate;

        $this->securityCode = (int) $securityCode;

        $this->validate();
    }

    public function validate()
    {
        $currentDate = new DateTime();

        $cardDate = DateTime::createFromFormat('ym', $this->expiryDate);

        if ($currentDate > $cardDate) {
            throw new CardExpiredException("This card has expired");
        }
    }

    public function toArray()
    {
        return [
            CardFields::CARD_NUMBER        => $this->cardNumber,
            CardFields::CARD_EXPIRY_DATE   => $this->expiryDate,
            CardFields::CARD_SECURITY_CODE => $this->securityCode,
        ];
    }
}
