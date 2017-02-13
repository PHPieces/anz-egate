<?php

namespace PHPieces\ANZGateway\models;

use PHPieces\ANZGateway\enums\FormFields\ResponseCodeFields;
use PHPieces\ANZGateway\enums\TransactionResponseCode;

class ResponseCode extends Model
{
    protected static $fields = ResponseCodeFields::class;

    /**
     * Primary status field sent back from ANZ
     *
     * @var String
     */
    private $txnResponseCode;

    /**
     * Human readable message for the error code.
     * @var String
     */
    private $message;

    /**
     * The subsequent fields are relevant to the card provider.
     * If the card could not be charged then the txnResponseCode will show that there was an error,
     * These fields are kept for posterity.
     * @var String
     */
    private $AVSResultCode;
    private $acqAVSRespCode;
    private $acqCSCRespCode;
    private $acqResponseCode;
    private $CSCResultCode;

    public function __construct($txnResponseCode, $message, $AVSResultCode = '', $acqAVSRespCode
    = '', $acqCSCRespCode = '', $acqResponseCode = '', $CSCResultCode = '')
    {
        $this->txnResponseCode = (int) $txnResponseCode;
        $this->message = (string) $message;
        $this->AVSResultCode = $AVSResultCode;
        $this->acqAVSRespCode = $acqAVSRespCode;
        $this->acqCSCRespCode = $acqCSCRespCode;
        $this->acqResponseCode = $acqResponseCode;
        $this->CSCResultCode = $CSCResultCode;
//        $this->validate();
    }

    public function isSuccess()
    {
        if ($this->txnResponseCode !== TransactionResponseCode::TRANSACTION_APPROVED) {
            return false;
        }
        return true;
    }

    public function getErrorMessage()
    {
        return TransactionResponseCode::MESSAGE[$this->txnResponseCode].", ".$this->message;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        return [
            'AVSResultCode'     => $this->AVSResultCode,
            'acqAVSRespCode'    => $this->acqAVSRespCode,
            'acqCSCRespCode'    => $this->acqCSCRespCode,
            'acqResponseCode'   => $this->acqResponseCode,
            'CSCResultCode'     => $this->CSCResultCode,
            'txnResponseCode'   => $this->txnResponseCode,
            'message'           => $this->message,
            'formatted_message' => $this->getErrorMessage()
        ];
    }
}
