<?php
date_default_timezone_set('Pacific/Auckland');

require_once("vendor/autoload.php");

// To get an API key contact http://whytewaters.com
$credentials = array(
    "host" => 'http://local.rtbslive.com',
    "key" => 'bolxejd2fa',
);


$booking_service = new Rtbs\ApiHelper\BookingServiceImpl($credentials);

$customer = $booking_service->create_customer("James", "Smith", "james@email.com", "021JAMESROCKS");
$itinerary = $booking_service->create_itinerary($customer);

$supplier_key = "s3qmgijy4a";//a Demonstration Supplier Key. Replace with a Supplier Key as provided to you by Whytewaters
$supplier = $booking_service->get_supplier($supplier_key);
$supplier_name = $supplier->get_name();
echo PHP_EOL . "Details for $supplier_name...";

/* @var $supplier Rtbs\ApiHelper\Models\Supplier */
echo count($supplier->get_tours()) . ' tours.';
if (count($supplier->get_tours()) < 1) {
    echo " Stopping.";
    return;
}

echo PHP_EOL,"Tours for $supplier_name...";
$tour_keys=array();
foreach ($supplier->get_tours() as $tour) {
    $tour_keys[] = $tour->get_tour_key();
}

$tours = $booking_service->get_tours($tour_keys);
echo count($tours);
if (empty($tours)) {
    echo " Stopping.".PHP_EOL;
    return;
}

foreach ($tours as $tour) {
    echo PHP_EOL.'TOUR: ' . $tour->get_name();
    foreach ($tour->get_prices() as $price) {
        echo PHP_EOL .'TOUR PRICE: '. $price->get_name() . ' = $' . $price->get_rate();
    }
}

//choose random tour
$tour = $tours[mt_rand(0,count($tours)-1)];
echo PHP_EOL."Sessions for " . $tour->get_name() . "...";
$tour_keys = array($tour->get_tour_key());
$date = date('Y-m-d', strtotime('tomorrow +2 week'));

$sessions_and_advanced_dates = $booking_service->get_sessions_and_advance_dates($supplier->get_supplier_key(), $tour_keys, $date);



$sessions = $sessions_and_advanced_dates->get_sessions();
echo count($sessions);
foreach ($sessions as $session) {
    echo PHP_EOL.'SESSION: ' . $session->get_datetime() . ' ' . ($session->is_open() ? 'OPEN' : 'CLOSED');
}

if (!empty($sessions_and_advanced_dates->get_advance_dates())) {
    echo PHP_EOL."Found " . count($sessions_and_advanced_dates['advance_dates']) . " advance dates.";
}

$found = false;
foreach ($sessions as $session) {
    if ($session->is_open() && sizeof($session->get_prices()) > 0) {
        $found = $session;
        break;
    }
}
if (!$found) {
    echo PHP_EOL."No open sessions with prices found, stopping.";
    echo PHP_EOL;
    return ;
}
$session = $found;

echo PHP_EOL."Adding capacity hold...";
$reserve_capacity_datetime = date("Y-m-d H:i:s", strtotime($session->get_datetime()));
$booking_service->reserve_capacity($session->get_tour_key(), $reserve_capacity_datetime, 10);

echo PHP_EOL."Checking pickups...";
$pickups = $booking_service->get_pickups($tour->get_tour_key());
echo count($pickups);


echo PHP_EOL,"Booking " . $tour->get_name() . " at " . $session->get_datetime() . "...";
$booking = new Rtbs\ApiHelper\Models\Booking();
$booking->set_tour_key($session->get_tour_key());
$booking->set_datetime($session->get_datetime());
$booking->set_first_name("James");
$booking->set_last_name("Hetfield");
$booking->set_email("james.hetfield@fake.email");
$booking->set_phone("0211234567");
$booking->set_itinerary_key($itinerary->get_itinerary_key());

//$booking->set_promo_key(40226);

$prices = $session->get_prices();
$price = $prices[0];

$booking->add_price_selection($price, 1);

$booking = $booking_service->make_booking($booking);

$payment_url = $booking_service->pay_itinerary($itinerary);

echo PHP_EOL, "Itinerary done. Response is : " . $payment_url;

echo PHP_EOL;
echo PHP_EOL;
echo "Finished.";
echo PHP_EOL;
