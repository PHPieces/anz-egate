<?php

class MerchantTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_throws_error_if_missing_credentials()
    {
        $this->expectException(PHPieces\ANZGateway\exceptions\InvalidMerchantDetails::class);

         new PHPieces\ANZGateway\models\Merchant('', '', '');
    }

    /**
     * @test
     */
    public function it_throws_error_if_wrong_type()
    {
        $this->expectException(TypeError::class);

         new PHPieces\ANZGateway\models\Merchant(null, null, null);
    }
}
