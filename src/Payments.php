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
        return $this->gate->request('GET', $this->getUrl(), []);
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
        return $this->gate->request('GET', $this->getUrl() . "/" . $id, []);
    }

}
