<?php
// ==================================DB Connection==================
require_once 'database.php';

?>
<link rel="stylesheet" href="assets/css/style.css">
<body>
    <div class="container">
        <!-- ================================img=========== -->
        <div class="is-nowrap is-layout-flex wp-container-3 wp-block-group">
            <div class="img">
                <figure class="wp-block-image size-full">
                    <img src="images/image.png" alt="" class="wp-image-257">
                </figure>
            </div>
            <div class="title-h4">
                <h4>Business Registration</h4>
            </div>
        </div>

        <!-- ==============================main-form=================== -->

        <form action="#0" method="post" class="wpcf7-form init cf7sa">

            <div class="wpcf7-response-output" aria-hidden="true">
                <?php if (isset($_GET['msg'])) { ?>
                    <div id="success-message"><?php echo $_GET['msg']; ?></div>
                <?php  } ?>
                <div id="paymentResponse"></div>
            </div>
            <div class="form">
                <div class="form-column">

                    <input type="text" name="name_business" id="name_business" required value="" size="40" class="" aria-invalid="false" placeholder="Name of Business"><br>
                    <input type="text" name="abn" value="" required size="40" class="" id="abn" aria-invalid="false" placeholder="Abn">
                    <input type="hidden" name="amount" value="210" class=" " id="amount">
                    <input type="text" name="street_address" value="" size="40" class="" id="StreetAddress" aria-invalid="false" placeholder="Street Address"><br>
                    <input type="text" name="subrub" value="" size="40" class="" id="subrub" aria-invalid="false" placeholder="Suburb"><br>
                    <input type="text" name="state" value="" size="40" class="" id="state" aria-invalid="false" placeholder="State"><br>
                    <input type="number" name="postcode" value="" class="" id="postcode" aria-invalid="false" placeholder="Postcode"><br>
                    </span>
                </div>
                <div class="form-column">
                    <input type="tel" name="contact_person" value="" size="40" class="" id="contact-person" aria-required="true" aria-invalid="false" placeholder="Contact Person"><br>
                    <input type="email" name="bussiness_email" value="" size="40" class="" id="email" aria-required="true" aria-invalid="false" placeholder="Business Email"><br>
                    <input type="tel" name="phone" value="" size="40" class="" id="phone" aria-required="true" aria-invalid="false" placeholder="phone"></span><br>
                    <input type="url" name="website_address" value="" size="40" class="" id="website-address" aria-required="true" aria-invalid="false" placeholder="Website Address"><br>
                    <input type="url" name="online_booking_url" value="" size="40" class="" id="online-booking-url" aria-required="true" aria-invalid="false" placeholder="Online Booking Url"><br>
                    <input type="text" name="type_of_business" value="" size="40" class="" id="type-of-business" aria-required="true" aria-invalid="false" placeholder="Type of Business">
                </div>
                <div class="last-column">
                    <!-- =============================================Stripe-config================================================== -->

                    <p class="last-btn">
                        <button type="button" id="payButton" class="pay-button">Pay Now to Complete your Registration</button>
                    </p>
                    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++Stripe Checkout++++++++++++++++++++++++ -->


                </div>
            </div>
        </form>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('pk_test_51JNiI2Fi8jvMvtuW0xLPyjcnXLq9UNBLu8bNLgyjt25LcoiMGqXqYWa7udDrn4aPHLgx26v6cviUr0sBUlQ7wZDF00jU1nncas');
    // Select payment button
    const payBtn = document.querySelector("#payButton");

    // Payment request handler
    payBtn.addEventListener("click", function(evt) {
        if($(".name_business").val()==""){
            alert("Name of business is Required");
            return;
        }
        createCheckoutSession().then(function(data) {
            if (data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function(stripe) {
        
        var form_array = $(".wpcf7-form").serializeArray();
        var data = new FormData();
        for (var i = 0; i < form_array.length; i++) {
            data.append(form_array[i].name, form_array[i].value);
        }
        return fetch("payment_init.php", {
            method: "POST",

            body: data
        }).then(function(result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function(result) {
        if (result.error) {
            showMessage(result.error.message);
        }

    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#buttonText").classList.remove("hidden");
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