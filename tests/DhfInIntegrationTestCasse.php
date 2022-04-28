<?php

use DHF\Pay\DHFPay;

class DhfInIntegrationTestCasse extends \PHPUnit\Framework\TestCase
{

    /** @var DHFPay */
    protected $dhf;

    protected $payment = [
        'amount' =>2.6,
        'comment' => 'Test payment last build'
    ];

    protected $spoiledPayment = [
        'amount' => 'hi honey',
        'store' => -1,
        'comment' => 'Spoiled payment'
    ];

    public function __construct()
    {
        parent::__construct();
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $api = $_ENV['TEST_SERVER_API'];
        $token = $_ENV['TEST_SERVER_TOKEN'];
        $this->dhf = new DHFPay($api, $token);
    }


    /**
     * Test create payment
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreatePayment()
    {

        $payment = $this
            ->dhf
            ->payments()
            ->add($this->payment);

        $res = $this
            ->dhf
            ->payments()
            ->getOne($payment['id']);

        $this->assertSame($this->payment['amount'], $res['amount']);
        $this->assertSame($this->payment['comment'], $res['comment']);
        $this->assertSame($payment['id'], $res['id']);
    }

    /**
     *
     */
    public function testGetAllPayments()
    {
        $payments = $this
            ->dhf
            ->payments()
            ->getAll();

        $this->assertIsArray($payments);
        $this->assertTrue(count($payments) > 0);


    }

    /**
     * Test create payment
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreateWrongPayment()
    {
        $this->expectException(DHF\Pay\Exception\DHFBadRequestException::class);
        $this
            ->dhf
            ->payments()
            ->add($this->spoiledPayment);

    }

    /**
     * Test create payment
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testWrongToken()
    {
        $this->expectException(DHF\Pay\Exception\DHFUnauthorisedException::class);
        $api = $_ENV['TEST_SERVER_API'];
        $token = 'O_o';
        $dhf = new DHFPay($api, $token);
        $dhf
            ->payments()
            ->add($this->spoiledPayment);

    }

    /**
     * Test create payment
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetTransactions()
    {
        $trensactions = $this
            ->dhf
            ->transaction()
            ->getAll();

        $this->assertIsArray($trensactions);
    }

    /**
     * Test create payment
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function _testGetTransactionsAuth()
    {
        $this->expectException(DHF\Pay\Exception\DHFUnauthorisedException::class);
        $api = $_ENV['TEST_SERVER_API'];
        $token = 'O_o';
        $dhf = new DHFPay($api, $token);

        $dhf
            ->transaction()
            ->getAll();

    }


}
