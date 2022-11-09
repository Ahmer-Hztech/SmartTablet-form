<?php

include 'database.php';
require 'vendor/autoload.php';

$nameOfBussiness = $_POST['Name-of-Business'];
$abn = $_POST['abn'];
// $nameOfBussiness = $_POST['Name-of-Business'];
$amount = $_POST['amount'];
$post_code = $_POST['postcode'];
$streetAddress = $_POST['StreetAddress'];
$subrub = $_POST['subrub'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];
$type_of_business = $_POST['type-of-business'];
$contact_person = $_POST['contact-person'];
$email = $_POST['bussiness-email'];
$phone = $_POST['phone'];
$website_address = $_POST['website-address'];
// $facebook_url = $_POST['facebook-url'];
$online_booking_url = $_POST['online-booking-url'];
// $qoin_wallet = $_POST['qoin-wallet'];

$result = "INSERT INTO `tbl_payment`( `name_of_business`, `abn`, `street_address`, `subrub`, `state`, `postcode`, 
`type_of_business`, `bussiness_email`, `phone`, `website_address`, `facebook_url`, `online_booking_url`, `qoin_wallet`, `amount`) 
    VALUES ('$nameOfBussiness',
        '$abn',
        '$streetAddress',
        '$subrub',
        '$state',
        '$post_code',
        '$type_of_business',
        '$email',
        '$phone',
        '$website_address',
        '$facebook_url',
        '$online_booking_url',
        '$qoin_wallet',
        '$amount')";
if ($conn->query($result) === TRUE) {
    $last_id = $conn->insert_id;
}


$stripeDetails = [
    'mode' => 'test',
    'publishable_key' => 'pk_test_51JNiI2Fi8jvMvtuW0xLPyjcnXLq9UNBLu8bNLgyjt25LcoiMGqXqYWa7udDrn4aPHLgx26v6cviUr0sBUlQ7wZDF00jU1nncas',
    'secret_key' => 'sk_test_51JNiI2Fi8jvMvtuWAFZVR1GdxdIXYR3RoHY0V18ZgmltID2cclF4QK588V67zSVgqqqCmzz3o5KqH0ZVTFs3DQxQ00EGGp5A4D',
];


$stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
 
$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Invalid Request!'    
    ) 
); 
