<?php


namespace DHF\Pay;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Payments
 * @package DHF\Pay
 */
class Payments
{

    const URL = 'payment';
    const MOTS_S=1000000000;

    /**
     * @var DHFPay
     */
    protected $gate;

    /**
     * Payments constructor.
     * @param DHFPay $gate
     */
    public function __construct(DHFPay $gate)
    {
        $this->gate = $gate;
    }

    /**
     * Get all payments
     *
     * @return array
     * @throws GuzzleException
     */
    public function getAll(): array
    {
        return array_map(function ($e){
            return $this->processPayment($e);
        },$this->gate->request('GET', $this->getUrl(), []));
    }

    /**
     * @param array $p
     * @return array
     */
    private function processPayment(array $p){
        $p['amount']= $p['amount']/self::MOTS_S;
        return $p;
    }

    /**
     * Return a api endpoint url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return self::URL;
    }

    /**
     * Add new payment
     *
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function add(array $params): array
    {
        return $this->gate->request('POST', $this->getUrl(), $params);
    }

    /**
     * Get payment by id
     *
     * @param $id
     * @return array
     * @throws GuzzleException
     */
    public function getOne($id): array
    {
        return $this->processPayment($this->gate->request('GET', $this->getUrl() . "/" . $id, []));
    }

}
