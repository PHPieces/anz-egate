<?php


class TransactionSourceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_throws_error_if_invalid_type_supplied()
    {
        $this->expectException(PHPieces\ANZGateway\exceptions\InvalidArgumentException::class);

        new PHPieces\ANZGateway\models\TransactionSource('foo');
    }

      /**
     * @test
     */
    public function it_throws_error_if_invalid_sub_type_supplied()
    {
        $this->expectException(PHPieces\ANZGateway\exceptions\InvalidArgumentException::class);

        new PHPieces\ANZGateway\models\TransactionSource('INTERNET', 'foo');
    }
}