<?php

use PHPieces\ANZGateway\Charge;
use PHPieces\ANZGateway\TestCase;

class ChargeTest extends TestCase
{

    /**
     * @test
     */
    public function it_works()
    {
        $charge = new Charge($this->successResponse);

        $this->assertTrue($charge->isSuccess());
    }

    /**
     * @test
     */
    public function it_shows_errors()
    {
        $charge = new Charge($this->failureResponse);

        $this->assertFalse($charge->isSuccess());

        $this->assertEquals('Message Detail Error, Required field vpc_Merchant was not present in the request', $charge->getMessage());
    }

    /**
     * @test
     */
    public function it_converts_to_array()
    {
        $expected = [
            'responseContent' => $this->successResponse,
            'responseCode'    => json_encode([
                "AVSResultCode"     => "Unsupported",
                "acqAVSRespCode"    => "Unsupported",
                "acqCSCRespCode"    => "Unsupported",
                "acqResponseCode"   => "00",
                "CSCResultCode"     => "Unsupported",
                "txnResponseCode"   => 0,
                "message"           => "Approved",
                "formatted_message" => "Transaction approved, Approved"
            ]),
            'amount'          => '100',
            'batchNo'         => '20170210',
            'card'            => 'MC',
            'locale'          => 'en_AU',
            'merchTxnRef'     => '67478',
            'orderInfo'       => '6605',
            'receiptNo'       => '170210185043',
            'transactionNo'   => '1250900',
        ];

        $charge = new Charge($this->successResponse);

        $this->assertEquals($expected, $charge->toArray());
    }
}