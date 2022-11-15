<?php

require 'database.php';
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['submit'])) {
    $name_business = $_POST['name_business'];
    $type_of_business = $_POST['type_of_business'];
    $contact_person = $_POST['contact_person'];
    $business_email = $_POST['business_email'];
    $phone = $_POST['phone'];
    $website_address = $_POST['website_address'];

    $result = "INSERT INTO `info_table`( `name_business`, `contact_person`,  
`type_of_business`, `business_email`, `phone`, `website_address`) 
    VALUES (
        '$name_business',
        '$contact_person',
        '$type_of_business',
        '$business_email',
        '$phone',
        '$website_address'
       )";


    if ($conn->query($result) === TRUE) {
        try {
            $mail = new PHPMailer(true);

            $body = '
        Name of Business: ' . $name_business . '<br>
        Phone: ' . $phone . '<br>
        Email of Business: ' . $business_email . '<br>
        Type of Business: ' . $type_of_business . '<br>
        Contact Person: ' . $contact_person . '<br>
        Website Address: ' . $website_address . '<br>
        ';
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.gmail.com';
            $mail->SMTPAuth = false;
            $mail->SMTPKeepAlive = true;
            $mail->Port = 25;

            $mail->setFrom('no_reply_registrations@tbnaustralia.com', 'The TEAM Business Network');
            $mail->addAddress($business_email, $name_business);

            $mail->Subject = 'Request for Information';

            $mail->msgHTML($body);
            $mail->send();
        } catch (\Exception $ex) {
        }
        $msg = "Thank you for contacting us, a member of our Account Management Team will reach out to you soon.";
    } else {
        $fail = "Server Error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAM BUSINESS NETWORK</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
</head>

<body>
    <div class="container" style="padding-top:5%">
        <div class="is-nowrap is-layout-flex wp-container-3 wp-block-group">
            <div class="img">
                <figure class="wp-block-image size-full">
                    <img src="images/logo.png" alt="" class="wp-image-257">
                </figure>
            </div>
            <div class="title-h4">
                <h4>Request for More Information</h4>
            </div>
        </div>
        <form action="#0" method="post" class="wpcf7-form init cf7sa">
            <div class="form">
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" name="name_business" id="name_business" required placeholder="Name of Business*">
                    </div>
                    <div class="form-group">
                        <input type="text" name="contact_person" id="contact-person" required placeholder="Contact Person*">
                    </div>
                    <div class="form-group">
                        <input type="email" name="business_email" id="email" required placeholder="Business Email*">
                    </div>
                    </span>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <input type="tel" name="phone" id="phone" required placeholder="Phone*">
                    </div>

                    <div class="form-group">
                        <input type="text" name="website_address" id="website-address" placeholder="Website Address">
                    </div>

                    <div class="form-group">
                        <input type="text" name="type_of_business" id="type-of-business" required placeholder="Type of Business*">
                    </div>
                </div>
                <div class="last-column">
                    <p class="last-btn">
                        <button type="submit" id="payButton" class="pay-button" name="submit">
                            <span id="buttonText">
                                Request for More Information
                            </span>
                        </button>
                    <div class="wpcf7-response-output" aria-hidden="true">
                        <?php if (isset($msg)) { ?>
                            <div class="alert alert-success"><?php echo $msg; ?></div>
                        <?php  } ?>
                        <?php if (isset($fail)) { ?>
                            <div class="alert alert-danger"><?php echo $fail; ?></div>
                        <?php  } ?>
                    </div>

                    <!-- <b>
                        Following registration, our Business Support Team will be in touch with you within a few days to get you up and running on the Team Business Network and other Apps.

                    </b> -->
                    </p>
                </div>
            </div>
        </form>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</html>