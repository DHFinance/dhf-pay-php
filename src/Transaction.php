<?php


namespace DHF\Pay;


class Transaction
{
    const URL = '/api/transaction';

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return self::URL;
    }

    /**
     * @var DHFPay
     */
    protected $gate;


    public function __construct(DHFPay $gate)
    {
        $this->gate = $gate;
    }



    public function getAll(): array
    {
        return $this->gate->request('GET', $this->getUrl(), []);
    }
}
