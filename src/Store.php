<?php


namespace DHF\Pay;


use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Store
 * @package DHF\Pay
 */
class Store implements EndpointInterface
{
    const URL = 'store';


    /**
     * @var DHFPay
     */
    protected $gate;

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
     * Return a api endpoint url
     *
     * @param int $id
     * @return string
     */

    public function getStoreUrl(int $id): string
    {
        return $this->getUrl() . "/". $id;
    }

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
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function get(int $id): array
    {
        return $this->gate->request('GET', $this->getStoreUrl($id), []);
    }


}
