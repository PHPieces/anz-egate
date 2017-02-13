<?php

use PHPieces\ANZGateway\Charge;
use PHPieces\ANZGateway\ChargeRequest;
use PHPieces\ANZGateway\Config;
use PHPieces\ANZGateway\enums\FormFields\CardFields;
use PHPieces\ANZGateway\Gateway;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPieces\ANZGateway\TestCase;

class GatewayTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $mock = new MockHandler([
            new Response(200, [], $this->successResponse),
        ]);
        $handler = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handler]);
    }

    /**
     * @test
     */
    public function it_works()
    {
        $card = Config::load('test_cards')[0];
        $data = [
            'vpc_AccessCode'               => Config::load('egate.MERCHANT_ACCESS_CODE'),
            'vpc_MerchTxnRef'              => rand(1, 100000),
            'vpc_Merchant'                 => Config::load('egate.MERCHANT_ID'),
            'vpc_OrderInfo'                => rand(1, 100000),
            'vpc_Amount'                   => '100',
            CardFields::CARD_NUMBER        => $card[CardFields::CARD_NUMBER],
            CardFields::CARD_EXPIRY_DATE   => $card[CardFields::CARD_EXPIRY_DATE],
            CardFields::CARD_SECURITY_CODE => $card[CardFields::CARD_SECURITY_CODE],
        ];

        $request = ChargeRequest::create($data);
        $gateway = new Gateway($this->client);
        $response = $gateway->charge($request);

        $this->assertTrue($response instanceof Charge);
    }

    /**
     * @test
     */
    public function it_processes_purchase()
    {
        $gateway = new Gateway($this->client);
        $card = Config::load('test_cards')[0];

        $gateway->setAccessCode(Config::load('egate.MERCHANT_ACCESS_CODE'));
        $gateway->setMerchantID(Config::load('egate.MERCHANT_ID'));

        $response = $gateway->purchase([
                'vpc_MerchTxnRef'              => rand(1, 100000),
                'vpc_OrderInfo'                => rand(1, 100000),
                'vpc_Amount'                   => '100',
                CardFields::CARD_NUMBER        => $card[CardFields::CARD_NUMBER],
                CardFields::CARD_EXPIRY_DATE   => $card[CardFields::CARD_EXPIRY_DATE],
                CardFields::CARD_SECURITY_CODE => $card[CardFields::CARD_SECURITY_CODE],
            ])->send();

        $this->assertTrue($response instanceof Charge);
    }

    /**
     * @test
     */
    public function it_acts_as_service_provider()
    {
        $gateway = Gateway::create();

        $this->assertTrue($gateway instanceof Gateway);
    }
}