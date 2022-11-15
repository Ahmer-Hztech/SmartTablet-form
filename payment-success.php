<?php

require 'database.php';
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$payment_id = $statusMsg = '';
$status = 'error';

if (!empty($_REQUEST['session_id'])) {

    $session_id = $_REQUEST['session_id'];
    $last_id = $_REQUEST['form_id'];

    $stripe = new \Stripe\StripeClient(
        SECRET_KEY
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
                    $mail = new PHPMailer(true);
                    try {
                        $sql = "SELECT * FROM tbl_payment where owner_ID='$last_id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();


                            $name_business = $row['name_of_business'];

                            $body = '
                        <p>Hello ' . $name_business . ',<br /><br />
                        Welcome to TEAM. I look forward to helping you expand your business and increase revenues. The next couple of years are going to be very exciting indeed.
                        <br /><br />I can confirm your payment for $210 has been received.<br /><br />
                        In order to fully activate your Membership in TEAM, you need to transfer $450 in QOIN to the TEAM QOIN Wallet.<br /><br />
                        Our Wallet Address is [address details]. 
                        <br /><br />
                        Shortly, you will receive an email from our Account Management Team, requesting some further details to get you up and fully
                         live on TEAM at the earliest opportunity.<br /><br />With kind regards,<br /><br />Randall Harper<br />Chief Executive</p>
                        ';
                            $mail->isSMTP();
                            $mail->Host = 'smtp-relay.gmail.com';
                            $mail->SMTPAuth = false;
                            $mail->SMTPKeepAlive = true;
                            $mail->Port = 25;

                            $mail->setFrom('no_reply_registrations@tbnaustralia.com', 'The Bussiness Network');
                            $mail->addAddress($row['business_email'], $row['name_of_business']);


                            $mail->Subject = 'The Business Network Subscription';


                            $mail->msgHTML($body);
                            $mail->send();
                        } else {
                            header("location: index.php?msg=Payment Failed!");
                        }
                    } catch (\Exception $e) {
                        header("location: index.php?msg=Email Failed!");
                    }
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
