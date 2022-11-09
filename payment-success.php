<?php

include_once 'database.php';
require_once('vendor/autoload.php');

$payment_id = $statusMsg = '';
$status = 'error';

if (!empty($_REQUEST['session_id'])) {

    $session_id = $_REQUEST['session_id'];
    $last_id = $_REQUEST['form_id'];

    $stripe = new \Stripe\StripeClient(
        'sk_test_51JNiI2Fi8jvMvtuWAFZVR1GdxdIXYR3RoHY0V18ZgmltID2cclF4QK588V67zSVgqqqCmzz3o5KqH0ZVTFs3DQxQ00EGGp5A4D'
    );

    try {
        $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
    } catch (Exception $e) {
        $api_error = $e->getMessage();
    }

    if (empty($api_error) && $checkout_session) {
        $customer_details = $checkout_session->customer_details;

        try {
            $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $paymentIntent) {
            if (!empty($paymentIntent) && $paymentIntent->status == 'succeeded') {

                $query = "UPDATE tbl_payment set transation_id='$paymentIntent->id', status=1 where owner_ID='$last_id'";
                if ($conn->query($query) === TRUE) {
                    header("location: index.php?msg=Payment Successful!");
                }
            } else {
                header("location: index.php?msg=Payment Failed!");
            }
        } else {
            header("location: index.php?msg=Payment Failed!");
        }
    } else {
        header("location: index.php?msg=Payment Failed!");
    }
} else {
    header("location: index.php?msg=Payment Failed!");
}
