<?php


namespace DHF\Pay;

/**
 * Class Transaction
 * @package DHF\Pay
 */
class Transaction
{
    const URL = '/transaction';

    /**
     * @var DHFPay
     */
    protected $gate;

    /**
     * Transaction constructor.
     * @param DHFPay $gate
     */
    public function __construct(DHFPay $gate)
    {
        $this->gate = $gate;
    }

    /**
     * Get all transaction
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
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
}
