<?php
require_once 'database.php';

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
    <div class="container">
        <div class="is-nowrap is-layout-flex wp-container-3 wp-block-group">
            <div class="img">
                <figure class="wp-block-image size-full">
                    <img src="images/logo.png" alt="" class="wp-image-257">
                </figure>
            </div>
            <div class="title-h4">
                <h4>Business Registration</h4>
            </div>
        </div>

        <form action="#0" method="post" id="wpcf7-form " class="wpcf7-form init cf7sa">


            <div class="form">
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" name="name_business" id="name_business" required placeholder="Name of Business*">
                    </div>
                    <div class="form-group">
                        <input type="text" name="abn" required id="abn" placeholder="Abn*">
                    </div>
                    <div class="form-group">
                        <input type="text" name="street_address" id="StreetAddress" placeholder="Street Address*">
                    </div>
                    <div class="form-group">

                        <input type="text" name="suburb" id="suburb" placeholder="Suburb*">
                    </div>
                    <div class="form-group">

                        <input type="text" name="state" id="state" placeholder="State*">
                    </div>
                    <div class="form-group">
                        <input type="number" name="postcode" id="postcode" placeholder="Postcode*">
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">

                        <input type="text" name="contact_person" id="contact-person" placeholder="Contact Person*">
                    </div>
                    <div class="form-group">
                        <input type="email" name="business_email" id="email" placeholder="Business Email*">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" id="phone" placeholder="Phone*">
                    </div>
                    <div class="form-group">
                        <input type="url" name="website_address" id="website-address" placeholder="Website Address">
                    </div>
                    <div class="form-group">
                        <input type="url" name="online_booking_url" id="online-booking-url" placeholder="Online Booking Url">
                    </div>
                    <div class="form-group">
                        <input type="text" name="type_of_business" id="type-of-business" placeholder="Type of Business*">
                    </div>
                </div>

                <div class="last-column">

                    <div class="wpcf7-response-output" aria-hidden="true">
                        <?php if (isset($_GET['msg'])) { ?>
                            <div id="success-message" class="alert alert-success">
                                You will receive a Confirmation Email from TEAM shortly. If you don't receive a confirmation email within 15 minutes (please check your spam folder first), please call us on <a href="tel:070756354369">07 07 5635 4369</a> during business hours.
                            </div>

                        <?php  } ?>
                        <?php if (isset($_GET['fail'])) { ?>
                            <div id="success-message" class="alert alert-danger"><?php echo $_GET['fail']; ?></div>

                        <?php  } ?>
                        <div id="paymentResponse" class="alert hidden alert-danger"></div>

                    </div>
                    <p class="last-btn">
                        <button type="button" id="payButton" class="pay-button">
                            <span id="buttonText">
                                Pay Now to Complete your Registration
                            </span>
                        </button>
                        <b>
                            Following registration, our Business Support Team will be in touch with you within a few days to get you up and running on the Team Business Network and other Apps.
                        </b>
                    </p>
                </div>
            </div>
        </form>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51JNiI2Fi8jvMvtuW0xLPyjcnXLq9UNBLu8bNLgyjt25LcoiMGqXqYWa7udDrn4aPHLgx26v6cviUr0sBUlQ7wZDF00jU1nncas');
    const payBtn = document.querySelector("#payButton");
    // $("#payButton").click(function() {

    //     if ($("#name_business").val() == "") {
    //         showMessage("Name of Business is Required");
    //     }else if ($("#abn").val() == "") {
    //         showMessage("Abn is Required");
    //     } else if ($("#StreetAddress").val() == "") {
    //         showMessage("Street Address is Required");
    //     } else if ($("#suburb").val() == "") {
    //         showMessage("Suburb is Required");
    //     } else {
    //         setLoading(true);
    //         createCheckoutSession().then(function(data) {
    //             if (data.sessionId) {
    //                 stripe.redirectToCheckout({
    //                     sessionId: data.sessionId,
    //                 }).then(handleResult);
    //             } else {
    //                 handleResult(data);
    //             }
    //         });
    //     }

    // });

    $('#payButton').on('click', function() {
        $(".error").remove();
        var valid = true,
            message = '';

        $('form input').each(function() {
            var $this = $(this);
            if ($this.attr("type") != "url") {
                if (!$this.val()) {
                    var inputName = $this.attr('placeholder');
                    valid = false;
                    var text1 = "<br>";
                    message = '<small class="text-danger error">*Please enter your ' + inputName + '</small>';
                    $(this).parent().append(message);
                }
            }
        });

        if (!valid) {
            console.log(message);
            // $("#paymentResponse").removeClass("hidden").append(message);
        } else {
            setLoading(true);
            createCheckoutSession().then(function(data) {
                if (data.sessionId) {
                    stripe.redirectToCheckout({
                        sessionId: data.sessionId,
                    }).then(handleResult);
                } else {
                    handleResult(data);
                }
            });
        }
    });













    // Payment request handler

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function(stripe) {

        var form_array = $(".wpcf7-form").serializeArray();
        var data = new FormData();
        for (var i = 0; i < form_array.length; i++) {
            if (form_array[i].value != "") {
                data.append(form_array[i].name, form_array[i].value);
            }
        }
        return fetch("payment_init.php", {
            method: "POST",
            body: data
        }).then(function(result) {
            console.log(result);
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function(result) {
        if (result.error) {
            setLoading(false);
            showMessage(result.error.message);
        }

    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            $("#buttonText").text("Loading...");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            $("#buttonText").text("Pay Now to Complete your Registration");

        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function() {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
</script>

</html>