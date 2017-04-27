<?php

namespace PHPieces\ANZGateway;

use GuzzleHttp\Client;
use PHPieces\ANZGateway\enums\FormFields\MerchantFields;

class Gateway
{

	/**
	 * @param Client
	 */
	private $client;


	/**
	 *
	 * @var String
	 */
	private $merchantID;


	/**
	 *
	 * @var String
	 */
	private $merchantAccessCode;

	/**
	 * @var string
	 */
	private $url;


	/**
	 *
	 * @var array
	 */
	private $data = [];

	public function __construct(Client $client, $url = 'https://migs.mastercard.com.au/vpcdps')
	{
		$this->client = $client;
		$this->url = $url;
	}

	public static function create() : self
	{

		return new self(new Client([
			'base_uri' => 'https://migs.mastercard.com.au/vpcdps',
		]));
	}

	public function setUrl(string $url) : void 
	{
		$this->url = $url;
	}

	public function setMerchantID(string $id) : void
	{
		$this->merchantID = $id;
	}

	public function setAccessCode(string $code) : void
	{
		$this->merchantAccessCode = $code;
	}

	public function purchase(array $data) : self
	{
		$this->data = $data;
		return $this;
	}

	public function send() : Charge
	{
		$request = ChargeRequest::create($this->getData());
		return $this->charge($request);
	}

	private function getData() : array
	{
		return array_merge(
			$this->data,
			[
				MerchantFields::MERCHANT_ID         => $this->merchantID,
				MerchantFields::MERCHANT_ACCESSCODE => $this->merchantAccessCode,
			]
		);
	}

	public function charge(ChargeRequest $charge) : Charge
	{
		$response = $this->client->request('POST', $this->url, ['form_params' => $charge->toArray()]);

		return new Charge($response->getBody()->getContents());
	}
}
