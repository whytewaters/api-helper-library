<?php namespace Rtbs\ApiHelper;

class CustomerTest extends \PHPUnit_Framework_TestCase
{

    public function testInvalidApiKey()
    {
        $api_client = new APIClient(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'INVALID',
        ));

        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException', 'invalid apikey');
        $api_client->api_create_customer('firstname', 'lastname', 'email', 'phone');
    }


    public function testCreateNullCustomer()
    {
        $api_client = new APIClient(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh'
        ));

        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException');
        $api_client->api_create_customer(null, null, null, null);
    }


    public function testCreateCustomer()
    {
        $api_client = new APIClient(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh'
        ));

        $res = $api_client->api_create_customer('firstname', 'lastname', 'invalid', 'phone');

        $this->assertObjectHasAttribute('customer', $res);
        $this->assertObjectHasAttribute('customer_key', $res->customer);
    }

}