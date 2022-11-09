<?php

// Include the configuration file 
require 'database.php';

require_once('vendor/autoload.php');

$base_url="http://localhost/stripe-form/stripe-form/";
// Include the Stripe PHP library 
$amount = 210;

$nameOfBussiness = $_POST['name_business'];
$abn = $_POST['abn'];
$post_code = $_POST['postcode'];
$streetAddress = $_POST['street_address'];
$subrub = $_POST['subrub'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];
$type_of_business = $_POST['type_of_business'];
$contact_person = $_POST['contact_person'];
$email = $_POST['bussiness_email'];
$phone = $_POST['phone'];
$website_address = $_POST['website_address'];
$online_booking_url = $_POST['online_booking_url'];

$result = "INSERT INTO `tbl_payment`( `name_of_business`, `abn`, `street_address`, `subrub`, `state`, `postcode`, 
`type_of_business`, `bussiness_email`, `phone`, `website_address`, `online_booking_url`,  `amount`) 
    VALUES (
        '$nameOfBussiness',
        '$abn',
        '$streetAddress',
        '$subrub',
        '$state',
        '$post_code',
        '$type_of_business',
        '$email',
        '$phone',
        '$website_address',
        '$online_booking_url',
        '$amount')";


if ($conn->query($result) === TRUE) {
    $last_id = $conn->insert_id;

    $stripe = new \Stripe\StripeClient(
        'sk_test_51JNiI2Fi8jvMvtuWAFZVR1GdxdIXYR3RoHY0V18ZgmltID2cclF4QK588V67zSVgqqqCmzz3o5KqH0ZVTFs3DQxQ00EGGp5A4D'
    );
    $response = array(
        'status' => 0,
        'error' => array(
            'message' => 'Invalid Request!'
        )
    );


    if (!empty($nameOfBussiness)) {
        // Convert product price to cent 
        $stripeAmount = round($amount * 100, 2);

        // Create new Checkout Session for the order 
        try {
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => [[
                    'price_data' => [
                        'product_data' => [
                            'name' => $nameOfBussiness,
                        ],
                        'unit_amount' => $stripeAmount,
                        'currency' => "AUD",
                    ],
                    'quantity' => 1
                ]],
                'mode' => 'payment',
                'success_url' => $base_url.'/payment-success.php?session_id={CHECKOUT_SESSION_ID}&form_id=' . $last_id,
                'cancel_url' => $base_url.'/?msg=Payment Cancelled',
            ]);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $checkout_session) {
            $response = array(
                'status' => 1,
                'message' => 'Checkout Session created successfully!',
                'sessionId' => $checkout_session->id
            );
        } else {
            $response = array(
                'status' => 0,
                'error' => array(
                    'message' => 'Checkout Session creation failed! ' . $api_error
                )
            );
        }
    }

    // Return response 
    echo json_encode($response);
}
