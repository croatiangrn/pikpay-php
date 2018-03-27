<?php

namespace croatiangrn\PikPay;

class GatewayTest extends \PHPUnit_Framework_TestCase
{
    public $gateway;
    public $data;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway(getenv('TEST_ENDPOINT'), getenv('API_KEY'), getenv('SECRET_KEY'));

        $order_number = md5(microtime());

        $this->data = [
            'amount'          => 5500,
            'expiration-date' => 1707,
            'cvv'             => 286,
            'pan'             => 5464000000000008,
            'ip'              => '128.93.108.112',
            'order-info'      => 'Test Order',
            'ch-address'      => '1419 Westwood Blvd',
            'ch-city'         => 'Los Angeles',
            'ch-country'      => 'USA',
            'ch-email'        => 'john.doe@gmail.com',
            'ch-full-name'    => 'John Doe',
            'ch-phone'        => '636-48018',
            'ch-zip'          => '90024',
            'currency'        => 'USD', //EUR, BAM, HRK
            'order-number'    => $order_number,
            'language'        => 'en',
        ];
    }

    /**
     * @test
     */
    public function it_sends_an_authorization_request()
    {
        $response = $this->gateway->authorize($this->data);
        $this->assertTrue($response->isSuccessfull());
    }

    /**
     * @test
     */
    public function it_sends_a_purchase_request()
    {
        $response = $this->gateway->purchase($this->data);
        $this->assertTrue($response->isSuccessfull());
    }

    /**
     * @test
     */
    public function it_sends_a_capture_request()
    {
        $response = $this->gateway->authorize($this->data);

        $response = $this->gateway->capture($this->data);
        $this->assertTrue($response->isSuccessfull());
    }

    /**
     * @test
     */
    public function it_sends_a_refund_request()
    {
        $response = $this->gateway->purchase($this->data);

        $response = $this->gateway->refund($this->data);
        $this->assertTrue($response->isSuccessfull());
    }

    /**
     * @test
     */
    public function it_sends_a_void_request()
    {
        $response = $this->gateway->authorize($this->data);

        $response = $this->gateway->void($this->data);
        $this->assertTrue($response->isSuccessfull());
    }

    /**
     * @test
     */
    public function it_sends_an_authorization_request_with_installments()
    {
        $response = $this->gateway->authorizeWithInstallments($this->data, 2);
        $this->assertTrue($response->isSuccessfull());
    }

    /**
     * @test
     */
    public function it_sends_a_purchase_request_with_installments()
    {
        $response = $this->gateway->purchaseWithInstallments($this->data, 2);
        $this->assertTrue($response->isSuccessfull());
    }
}
