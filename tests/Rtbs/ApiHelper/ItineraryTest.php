<?php namespace Rtbs\ApiHelper;

class ItineraryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateNullItinerary()
    {
        $api_client = new APIClient(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh'
        ));

        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException');
        $api_client->api_create_itinerary(null, array());
    }


    public function testCreateItinerary()
    {
        $api_client = new APIClient(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh'
        ));

        $res = $api_client->api_create_customer('firstname', 'lastname', 'invalid', 'phone');
        $customer_key = $res->customer->customer_key;

        $res = $api_client->api_create_itinerary($customer_key, array());

        $this->assertObjectHasAttribute('itinerary', $res);
        $this->assertObjectHasAttribute('itinerary_key', $res->itinerary);
    }

}