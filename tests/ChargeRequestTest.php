<?php

use PHPieces\ANZGateway\ChargeRequest;
use PHPieces\ANZGateway\Config;
use PHPieces\ANZGateway\TestCase;

class ChargeRequestTest extends TestCase
{

    /**
     * @test
     */
    public function it_works()
    {
        $data = array(
            'Title'                   => 'PHP VPC 2-Party with CSC',
            'virtualPaymentClientURL' => 'https://migs.mastercard.com.au/vpcdps',
            'vpc_Version'             => '1',
            'vpc_Command'             => 'pay',
            'vpc_AccessCode'          => Config::load('egate.MERCHANT_ACCESS_CODE'),
            'vpc_MerchTxnRef'         => rand(1, 100000),
            'vpc_Merchant'            => Config::load('egate.MERCHANT_ID'),
            'vpc_OrderInfo'           => 'VPC Example',
            'vpc_Amount'              => '100',
            'vpc_CardNum'             => '5123456789012346',
            'vpc_CardExp'             => '1705',
            'SubButL'                 => 'Pay Now!',
            'vpc_CardSecurityCode'    => '123',
            'vpc_TicketNo'            => '432324',
            'vpc_TxSource'            => 'INTERNET',
            'vpc_TxSourceSubType'     => '',
        );

        $request = ChargeRequest::create($data);

        $this->assertTrue($request instanceof ChargeRequest);
    }

    /**
     * @test
     */
    public function it_gets_all_fields()
    {
        $expected = [
            'Card Number'                    => 'vpc_CardNum',
            'Card Expiry Date'               => 'vpc_CardExp',
            'Card Security Code'             => 'vpc_CardSecurityCode',
            'Purchase Amount'                => 'vpc_Amount',
            'Transaction Order Info'         => 'vpc_OrderInfo',
            'Ticket No'                      => 'vpc_TicketNo',
            'Type Field'                     => 'vpc_TxSource',
            'Sub Type Field'                 => 'vpc_TxSourceSubType',
            'Merchant Accesscode'            => 'vpc_AccessCode',
            'Merchant Transaction Reference' => 'vpc_MerchTxnRef',
            'Merchant Id'                    => 'vpc_Merchant',
        ];


        $actual = ChargeRequest::getFields();

        $this->assertEquals($expected, $actual);
    }
}