<?php

namespace PHPieces\ANZGateway;

use PHPieces\ANZGateway\exceptions\RequiredArgumentException;
use PHPieces\ANZGateway\models\ResponseCode;
use Exception;

class Charge
{
    const AMOUNT = 'vpc_Amount';
    const BATCH_NO = 'vpc_BatchNo';
    const CARD = 'vpc_Card';
    const LOCALE = 'vpc_Locale';
    const MERCH_TXN_REF = 'vpc_MerchTxnRef';
    const ORDER_INFO = 'vpc_OrderInfo';
    const RECEIPT_NO = 'vpc_ReceiptNo';
    const TRANSACTION_NO = 'vpc_TransactionNo';

    /**
     *
     * @var ResponseCode
     */
    public $responseCode;
    public $amount;
    public $batchNo;
    public $card;
    public $locale;
    public $merchTxnRef;
    public $orderInfo;
    public $receiptNo;
    public $transactionNo;
    public $responseContent;
    private $failedValidation = false;

    public function __construct($params)
    {
        $this->formDecode($params);
        $this->validate();
    }

    /**
     *
     * @param array $params
     */
    private function formDecode($params)
    {
        $output = [];
        parse_str($params, $output);
        $this->responseContent = $params;
        $this->responseCode = ResponseCode::create($output);

        //Required
        $this->transactionNo = @$output[self::TRANSACTION_NO];

        //From Input
        $this->amount = @$output[self::AMOUNT];
        $this->locale = @$output[self::LOCALE];
        $this->merchTxnRef = @$output[self::MERCH_TXN_REF];
        $this->orderInfo = @$output[self::ORDER_INFO];

        //Optional
        $this->batchNo = @$output[self::BATCH_NO];
        $this->card = @$output[self::CARD];
        $this->receiptNo = @$output[self::RECEIPT_NO];

        $this->validate();
    }

    /**
     *
     * @throws RequiredArgumentException
     * @throws Exception
     */
    private function validate()
    {
        if (empty($this->transactionNo)) {
            $this->failedValidation = true;
        }
    }

    public function isSuccess()
    {
        if ($this->failedValidation) {
            return false;
        }
        return $this->responseCode->isSuccess();
    }

    public function getMessage()
    {
        return $this->responseCode->getErrorMessage();
    }

    public function toArray()
    {
        return [
            'responseContent' => $this->responseContent,
            'responseCode'    => $this->responseCode->toJson(),
            'amount'          => $this->amount,
            'batchNo'         => $this->batchNo,
            'card'            => $this->card,
            'locale'          => $this->locale,
            'merchTxnRef'     => $this->merchTxnRef,
            'orderInfo'       => $this->orderInfo,
            'receiptNo'       => $this->receiptNo,
            'transactionNo'   => $this->transactionNo,
        ];
    }
}