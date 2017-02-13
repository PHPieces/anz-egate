<?php

use PHPieces\ANZGateway\Config;
use PHPieces\ANZGateway\enums\FormFields\CardFields;
use PHPieces\ANZGateway\exceptions\CardExpiredException;
use PHPieces\ANZGateway\models\Card;

class CardTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_works()
    {
        $card = new Card(123456789012, 1705, 123, 'Mastercard');

        $this->assertTrue($card instanceof Card);
    }

    /**
     * @test
     */
    public function it_gets_form_fields()
    {
        $fields = Card::getFields();
        $expected = array(
            'Card Number'        => 'vpc_CardNum',
            'Card Expiry Date'   => 'vpc_CardExp',
            'Card Security Code' => 'vpc_CardSecurityCode',
        );

        $this->assertEquals($fields, $expected);
    }

    /**
     * @test
     */
    public function it_throws_exception_for_expired_cards()
    {
        $this->expectException(CardExpiredException::class);
        $currentDate = new DateTime();
        $currentDate->modify("-2 month");
        $card = Config::load('test_cards')[0];


        new Card($card[CardFields::CARD_NUMBER], $currentDate->format('ym'), $card[CardFields::CARD_SECURITY_CODE]);
    }
}