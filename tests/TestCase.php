<?php

namespace PHPieces\ANZGateway;

use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    protected $successResponse = '';
    protected $failureResponse = '';

    public function setUp()
    {
        parent::setUp();

        Config::set('egate', [
            'MERCHANT_ID'          => 'FOOBAR',
            'MERCHANT_ACCESS_CODE' => '1QAZ2WSX'
        ]);

        $successResponse = [
            'vpc_AVSResultCode'   => 'Unsupported',
            'vpc_AcqAVSRespCode'  => 'Unsupported',
            'vpc_AcqCSCRespCode'  => 'Unsupported',
            'vpc_AcqResponseCode' => '00',
            'vpc_Amount'          => '100',
            'vpc_AuthorizeId'     => '185043',
            'vpc_BatchNo'         => '20170210',
            'vpc_CSCResultCode'   => 'Unsupported',
            'vpc_Card'            => 'MC',
            'vpc_Command'         => 'pay',
            'vpc_Locale'          => 'en_AU',
            'vpc_MerchTxnRef'     => '67478',
            'vpc_Merchant'        => Config::load('egate.MERCHANT_ID'),
            'vpc_Message'         => 'Approved',
            'vpc_OrderInfo'       => '6605',
            'vpc_ReceiptNo'       => '170210185043',
            'vpc_TransactionNo'   => '1250900',
            'vpc_TxnResponseCode' => '0',
            'vpc_Version'         => '1'
        ];

        $failureResponse = [
            'vpc_Amount'          => '0',
            'vpc_BatchNo'         => '0',
            'vpc_Locale'          => 'en',
            'vpc_Message'         => 'Required field vpc_Merchant was not present in the request',
            'vpc_TransactionNo'   => '0',
            'vpc_TxnResponseCode' => '7'
        ];

        $this->successResponse = http_build_query($successResponse);
        $this->failureResponse = http_build_query($failureResponse);
    }
}