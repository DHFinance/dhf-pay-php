<?php

namespace DHF\Pay;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class DHFPay
{
    /**
     * @var Payments
     */
    protected $payments;

    /**
     * @var Transaction
     */
    protected $transactions;

    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var string
     */
    protected $token;
    /**
     * @var Client
     */
    protected $client;

    public function __construct(string $endpoint, string $token)
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
        $this->payments = new Payments($this);
        $this->transactions = new Transaction($this);
        $this->client = new Client(['base_uri' => $this->endpoint]);
    }

    /**
     * @return Payments
     */
    public function payments(): Payments
    {
        return $this->payments;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return Transaction
     */
    public function transaction(): Transaction
    {
        return $this->transactions;
    }

    /**
     * @param $method
     * @param $uri
     * @param $params
     * @return array
     * @throws GuzzleException
     */
    public function request($method, $uri, $body): array
    {
        try {

            $newresponse = (string)$this->client->request(
                $method,
                $uri,
                [
                    //'debug'=>true,
                    'headers' =>
                        [
                            'Authorization' => "Bearer {$this->token}"
                        ],
                    RequestOptions::JSON => $body
                ]
            )->getBody();

        } catch (RequestException $exception) {
            throw $this->processException($exception);
        }


        return json_decode($newresponse, true);
    }

    protected function processException(RequestException $exception): \Exception
    {

        switch ($exception->getCode()) {
            case 401:
                $e = new Exception\DHFUnauthorisedException($exception->getMessage(), $exception->getCode(), $exception);
                break;
            case 400:
                $e = new Exception\DHFBadRequestException($exception->getMessage(), $exception->getCode(), $exception);
                break;
            default:
                $e = $exception;
                break;
        }

        return $e;

    }

}
