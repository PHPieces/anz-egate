<?php

namespace PHPieces\ANZGateway\models;

use PHPieces\ANZGateway\Config;
use PHPieces\ANZGateway\enums\FormFields\MerchantFields;
use PHPieces\ANZGateway\exceptions\InvalidMerchantDetails;

class Merchant extends Model
{
    protected static $fields = MerchantFields::class;

    /**
     * You need to log into the MA site to obtain this value. This
     * value will be different for test and live transactions. This
     * should be located in a configuration file or extracted from
     * a database.
     * @var String
     */
    private $merchantAccessCode;

    /**
     * This is a required field and may have
     * a maximum of 40 alpha numeric characters. This
     * reference should be unique for each transaction attempt
     * and is used for the Query DR function. This field label is
     * Merchant Transaction Reference in the Sample Code.
     *
     * @var String
     */
    private $merchantTransactionReference;

    /**
     * Your Merchant ID is supplied in your Welcome Email.
     *
     * @var String
     */
    private $merchantID;

    /**
     *
     * @param String $merchantAccessCode
     * @param String $merchantTransactionReference
     * @param String $merchantID
     */
    public function __construct(
        $merchantAccessCode,
        $merchantTransactionReference,
        $merchantID
    ) {
    
        $this->validate($merchantAccessCode, $merchantTransactionReference, $merchantID);
        $this->merchantAccessCode = (string) $merchantAccessCode;
        $this->merchantTransactionReference = (string) $merchantTransactionReference;
        $this->merchantID = (string) $merchantID;
    }

    /**
     *
     * @param String $merchantAccessCode
     * @param String $merchantTransactionReference
     * @param String $merchantID
     * @throws InvalidMerchantDetails
     */
    private function validate($merchantAccessCode, $merchantTransactionReference, $merchantID)
    {
        if (empty($merchantAccessCode) || empty($merchantTransactionReference) || empty($merchantID)
        ) {
            throw new InvalidMerchantDetails("Missing merchant details");
        }
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {
        return [
            MerchantFields::MERCHANT_ACCESSCODE            => $this->merchantAccessCode,
            MerchantFields::MERCHANT_TRANSACTION_REFERENCE => $this->merchantTransactionReference,
            MerchantFields::MERCHANT_ID                    => $this->merchantID
        ];
    }
}
