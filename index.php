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
        <?php
        if (isset($_GET['form_id'])) {
            $last_id=$_GET['form_id'];
            $sql = "SELECT * FROM tbl_payment where owner_ID='$last_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        }
        ?>
        <form action="#0" method="post" id="wpcf7-form " class="wpcf7-form init cf7sa">
            <div class="form">
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['name_of_business'] : "" ?>" name="name_business" id="name_business" required placeholder="Name of Business*">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['abn'] : "" ?>" name="abn" required id="abn" placeholder="Abn*">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['street_address'] : "" ?>" name="street_address" id="StreetAddress" placeholder="Street Address*">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['suburb'] : "" ?>" name="suburb" id="suburb" placeholder="Suburb*">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['state'] : "" ?>" name="state" id="state" placeholder="State*">
                    </div>
                    <div class="form-group">
                        <input type="number" value="<?= isset($_GET['form_id']) && isset($row) ? $row['postcode'] : "" ?>" name="postcode" id="postcode" placeholder="Postcode*">
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['contact_person'] : "" ?>" name="contact_person" id="contact-person" placeholder="Contact Person*">
                    </div>
                    <div class="form-group">
                        <input type="email" value="<?= isset($_GET['form_id']) && isset($row) ? $row['business_email'] : "" ?>" name="business_email" id="email" placeholder="Business Email*">
                    </div>
                    <div class="form-group">
                        <input type="tel" value="<?= isset($_GET['form_id']) && isset($row) ? $row['phone'] : "" ?>" name="phone" id="phone" placeholder="Phone*">
                    </div>
                    <div class="form-group">
                        <input type="url" value="<?= isset($_GET['form_id']) && isset($row) ? $row['website_address'] : "" ?>" name="website_address" id="website-address" placeholder="Website Address">
                    </div>
                    <div class="form-group">
                        <input type="url" value="<?= isset($_GET['form_id']) && isset($row) ? $row['online_booking_url'] : "" ?>" name="online_booking_url" id="online-booking-url" placeholder="Online Booking Url">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= isset($_GET['form_id']) && isset($row) ? $row['type_of_business'] : "" ?>" name="type_of_business" id="type-of-business" placeholder="Type of Business*">
                    </div>
                </div>

                <div class="last-column">
                    <div class="wpcf7-response-output" aria-hidden="true">
                        <?php if (isset($_GET['msg'])) { ?>
                            <div id="success-message" class="alert alert-success">
                                You will receive a Confirmation Email from TEAM shortly. If you don't receive a confirmation email
                                within 15 minutes (please check your spam folder first), please call us on <a href="tel:07 5635 4369">07 5635 4369</a> during business hours.
                            </div>

                        <?php  } ?>
                        <?php if (isset($_GET['fail'])) { ?>
                            <div id="success-message" class="alert alert-danger"><?php echo $_GET['fail']; ?></div>

                        <?php  } ?>
                        <div id="paymentResponse" class="alert hidden alert-danger"></div>
                    </div>
                    <p class="last-btn">
                        <button type="button" id="payButton" <?php if (isset($_GET['msg'])) { ?> disabled <?php } ?> class="pay-button">
                            <span id="buttonText">
                                <?php if (!isset($_GET['msg'])) { ?> Pay Now to Complete your Registration
                                <?php } else { ?>
                                    Payment Successful
                                <?php } ?>
                            </span>
                        </button>
                        <b>
                            Following registration, our Business Support Team will be in touch with you within a few days to get you up and
                            running on the Team Business Network and other Apps. You will also shortly receive an email outlining the next steps.
                        </b>
                        <?php if (isset($_GET['msg'])) { ?>
                    <div id="welcome_team">
                        <h4>Welcome to TEAM<br>Together Everyone Achieves More</h4>
                    </div>
                <?php
                        }
                ?>
                </p>
                </div>
            </div>
        </form>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('<?= PUBLISH_KEY ?>');
    const payBtn = document.querySelector("#payButton");

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