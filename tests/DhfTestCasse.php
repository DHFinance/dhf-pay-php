<?php

use DHF\Pay\DHFPay;

class DhfTestCasse extends \PHPUnit\Framework\TestCase
{
    public function testGetPayment()
    {
        $stub = $this->createMock(DHFPay::class);
        $stub->method('request')
            ->willReturn(['id' => '1']);
        $p = new \DHF\Pay\Payments($stub);
        $res = $p->getAll();
        $this->assertSame(['id' => '1'], $res);
    }

    public function testPostPayment()
    {
        $stub = $this->createMock(DHFPay::class);
        $stub->method('request')
            ->willReturn(['id' => '1']);
        $p = new \DHF\Pay\Payments($stub);
        $res = $p->add([]);
        $this->assertSame(['id' => '1'], $res);
    }

    public function testGetTransaction()
    {
        $stub = $this->createMock(DHFPay::class);
        $stub->method('request')
            ->willReturn(['id' => '1']);
        $p = new \DHF\Pay\Transaction($stub);
        $res = $p->getAll();
        $this->assertSame(['id' => '1'], $res);
    }

    public function testErrorIfGateIsNotAccessible(): void
    {
        $stub = $this->createMock(DHFPay::class);
        $stub->method('request')
            ->willThrowException(new Exception('network error'));
        $p = new \DHF\Pay\Transaction($stub);
        $this->expectException(Exception::class);
        $p->getAll();
    }

}
