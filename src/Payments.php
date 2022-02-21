<?php


namespace DHF\Pay;


class Payments
{
    const URL = '/api/payment';
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

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return self::URL;
    }

    public function add(array $params): array
    {
        return $this->gate->request('POST', $this->getUrl(), $params);
    }

    public function getOne($id):array
    {
        return $this->gate->request('GET', $this->getUrl() . "/" . $id, []);
    }

}
