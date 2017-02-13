<?php

use PHPieces\ANZGateway\exceptions\InvalidCostException;
use PHPieces\ANZGateway\exceptions\RequiredArgumentException;
use PHPieces\ANZGateway\models\Payment;

class PaymentTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_works()
    {
        $payment = new Payment(10000, 'Example Order', '12243432');

        $this->assertTrue($payment instanceof Payment);
    }

    /**
     * @test
     */
    public function it_gets_form_fields()
    {
        $fields = Payment::getFields();
        $expected = array(
            'Purchase Amount'       => 'vpc_Amount',
            'Transaction Order Info' => 'vpc_OrderInfo',
            'Ticket No'              => 'vpc_TicketNo',
        );

        $this->assertEquals($fields, $expected);
    }

    /**
     * @test
     */
    public function it_throws_error_for_negative_amount()
    {
        $this->expectException(InvalidCostException::class);

        new Payment(-1, 'foobar');
    }

    /**
     * @test
     */
    public function it_throws_error_if_no_order_info()
    {
         $this->expectException(RequiredArgumentException::class);
         new Payment(10000, '');
    }

    /**
     * @test
     */
    public function it_throws_error_if_order_info_too_long()
    {
        $this->expectException(Exception::class);

        new Payment(10000, '123456789012345678901234567890123456');
    }
}