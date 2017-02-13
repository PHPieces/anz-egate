<?php

namespace PHPieces\ANZGateway;

use PHPieces\ANZGateway\Config;
use GuzzleHttp\Client;
use PHPieces\ANZGateway\enums\FormFields\MerchantFields;

class Gateway
{
    /**
     * @param Client
     */
    private $client;
    private $merchantID;
    private $merchantAccessCode;
    private $data = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public static function create()
    {
        return new self(new Client([
            'base_uri' => Config::load('egate.url'),
        ]));
    }

    public function setMerchantID($id)
    {
        $this->merchantID = $id;
    }

    public function setAccessCode($code)
    {
        $this->merchantAccessCode = $code;
    }

    public function purchase($data)
    {
        $this->data = $data;
        return $this;
    }

    public function send()
    {
        $request = ChargeRequest::create($this->getData());
        return $this->charge($request);
    }

    private function getData()
    {
        return array_merge(
            $this->data,
            [
            MerchantFields::MERCHANT_ID         => $this->merchantID,
            MerchantFields::MERCHANT_ACCESSCODE => $this->merchantAccessCode,
            ]
        );
    }

    /**
     *
     * @param ChargeRequest $charge
     * @return Charge
     */
    public function charge(ChargeRequest $charge)
    {
        $response = $this->client->request('POST', Config::load('egate.url'), ['form_params' => $charge->toArray()]);

        return new Charge($response->getBody()->getContents());
    }
}
