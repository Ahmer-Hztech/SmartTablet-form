<?php
// ==================================DB Connection==================
include 'database.php';


?>

<body>

    <div class="container">
        <!-- ================================img=========== -->


        <div class="is-nowrap is-layout-flex wp-container-3 wp-block-group">
            <div class="img">

                <figure class="wp-block-image size-full">
                    <img width="69" height="50" src="images/download.png" alt="" class="wp-image-257">
                </figure>
            </div>
            <div class="title-h4">
                <h4>Business Registration</h4>
            </div>
        </div>

        <!-- ==============================main-form=================== -->

        <form action="form_save.php" method="post" class="wpcf7-form init cf7sa">
            <div style="display: none;">
                <input type="hidden" name="_wpcf7" value="191">
                <input type="hidden" name="_wpcf7_version" value="5.6.4">
                <input type="hidden" name="_wpcf7_locale" value="en_US">
                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f191-p192-o1">
                <input type="hidden" name="_wpcf7_container_post" value="192">
                <input type="hidden" name="_wpcf7_posted_data_hash" value="">
            </div>
            <div class="wpcf7-response-output" aria-hidden="true">
                <?php if (isset($_GET['msg'])) { ?>
                    <div id="success-message"><?php echo $_GET['msg']; ?></div>
                <?php  } ?>
            </div>
            <div class="form">
                <div class="form-column">
                    <span class="wpcf7-form-control-wrap" data-name="Name-of-Business">
                        <input type="text" name="Name-of-Business" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required Name-of-Business" aria-required="true" aria-invalid="false" placeholder="Name of Business"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="abn">
                        <input type="text" name="abn" value="" size="40" class="wpcf7-form-control wpcf7-text abn" id="abn" aria-invalid="false" placeholder="abn"></span>
                    <input type="hidden" name="amount" value="210" class="wpcf7-form-control wpcf7-hidden amount" id="amount">
                    <span class="wpcf7-form-control-wrap" data-name="StreetAddress">
                        <input type="text" name="StreetAddress" value="" size="40" class="wpcf7-form-control wpcf7-text Street Address" id="StreetAddress" aria-invalid="false" placeholder="Street Address"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="subrub">
                        <input type="text" name="subrub" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required subrub" id="subrub" aria-required="true" aria-invalid="false" placeholder="subrub"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="state">
                        <input type="text" name="state" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required state" id="state" aria-required="true" aria-invalid="false" placeholder="state"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="postcode">
                        <input type="number" name="postcode" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number postcode" id="postcode" aria-required="true" aria-invalid="false" placeholder="postcode"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="type-of-business">
                        <input type="text" name="type-of-business" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required type-of-business" id="type-of-business" aria-required="true" aria-invalid="false" placeholder="type-of-business"></span>
                </div>
                <div class="form-column">
                    <span class="wpcf7-form-control-wrap" data-name="contact-person">
                        <input type="tel" name="contact-person" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel contact-person" id="contact-person" aria-required="true" aria-invalid="false" placeholder="Contact Person"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="email-720">
                        <input type="email" name="bussiness-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email email" id="email" aria-required="true" aria-invalid="false" placeholder="Bussiness Email"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="phone">
                        <input type="tel" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel phone" id="phone" aria-required="true" aria-invalid="false" placeholder="phone"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="website-address">
                        <input type="url" name="website-address" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-url wpcf7-validates-as-required wpcf7-validates-as-url website-address" id="website-address" aria-required="true" aria-invalid="false" placeholder="website-address"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="facebook-url">
                        <input type="url" name="facebook-url" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-url wpcf7-validates-as-required wpcf7-validates-as-url facebook-url" id="facebook-url" aria-required="true" aria-invalid="false" placeholder="facebook-url"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="online-booking-url">
                        <input type="url" name="online-booking-url" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-url wpcf7-validates-as-required wpcf7-validates-as-url online-booking-url" id="online-booking-url" aria-required="true" aria-invalid="false" placeholder="online-booking-url"></span><br>
                    <span class="wpcf7-form-control-wrap" data-name="qoin-wallet">
                        <input type="text" name="qoin-wallet" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required qoin-wallet" id="qoin-wallet" aria-required="true" aria-invalid="false" placeholder="Qoin wallet"></span>
                </div>
                <div class="last-column">
                    <!-- =============================================Stripe-config================================================== -->
                    <div class="wrapper">
                        <input type="text" maxlength="19" name="cardnumber" class="cc-number-input" placeholder="Card: xxxx-xxxx-xxxx-xxx">
                        <input type="text" maxlength="5" name="exp-date" class="cc-expiry-input " placeholder="MM/YY">
                        <input type="text" maxlength="3" name="cvc" class="cc-cvc-input" placeholder="CVC">
                    </div>
                    <p>
                        <input type="submit" name="submit" value="Pay Now to Complete your Registration" class="wpcf7-form-control has-spinner wpcf7-submit pay-button" id="pay-button"><span class="ajax-loader"></span><span class="wpcf7-spinner"></span>
                    </p>
                </div>
            </div>
        </form>
    </div>
</body>

<style>
    body {
        margin: 0px;
        padding: 0px;
        background: #eceaea;
    }

    .container {
        width: 732px;
        margin: 0 auto;
        margin-top: 10px;

    }

    p {
        margin: 0px;
    }

    form input {

        width: 100%;
        height: 50px;
        font-size: 17px;
        margin: 0px 0px 20px 0px;
        padding: 6px 10px;
        border: 1px solid #d8d8d8;
        color: black;

    }

    ::placeholder {
        color: #d8d8d8;

    }

    input.pay-button {
        background: #159e15;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 20px;
    }

    .wp-container-3 {
        width: 100%;
        height: 100px;
    }

    div.img,
    div.title-h4 {

        width: 50%;
        float: left;
    }

    div.title-h4 h4 {

        font-size: 26px;
        font-family: system-ui;
        padding: 0px 0px 0px 40px;
        margin: 20px 0px;
        color: #505050;

    }

    .entry-content>*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide) {
        width: 60% !important;
        max-width: 60% !important;
    }

    .form .form-column {
        width: 45%;
        float: left;
        margin-left: 25px;

    }

    .form .last-column {

        width: 94%;
        float: left;
        margin: 0px 20px;

    }

    .page-id-192 .header-footer-group {
        display: none !important;
    }

    #pay-button {
        margin-top: 20px !important;
    }

    .cc-number-input {
        width: 66.8%;
    }

    .cc-expiry-input,
    .cc-cvc-input {

        width: 16%;
    }

    #success-message {

        color: white;
        background: green;
        padding: 10px 21px;
        margin: 13px 26px;
    }
</style>
<script>
    let ccNumberInput = document.querySelector('.cc-number-input'),
        ccNumberPattern = /^\d{0,16}$/g,
        ccNumberSeparator = "",
        ccNumberInputOldValue,
        ccNumberInputOldCursor,

        ccExpiryInput = document.querySelector('.cc-expiry-input'),
        ccExpiryPattern = /^\d{0,4}$/g,
        ccExpirySeparator = "/",
        ccExpiryInputOldValue,
        ccExpiryInputOldCursor,

        ccCVCInput = document.querySelector('.cc-cvc-input'),
        ccCVCPattern = /^\d{0,3}$/g,

        mask = (value, limit, separator) => {
            var output = [];
            for (let i = 0; i < value.length; i++) {
                if (i !== 0 && i % limit === 0) {
                    output.push(separator);
                }

                output.push(value[i]);
            }

            return output.join("");
        },
        unmask = (value) => value.replace(/[^\d]/g, ''),
        checkSeparator = (position, interval) => Math.floor(position / (interval + 1)),
        ccNumberInputKeyDownHandler = (e) => {
            let el = e.target;
            ccNumberInputOldValue = el.value;
            ccNumberInputOldCursor = el.selectionEnd;
        },
        ccNumberInputInputHandler = (e) => {
            let el = e.target,
                newValue = unmask(el.value),
                newCursorPosition;

            if (newValue.match(ccNumberPattern)) {
                newValue = mask(newValue, 4, ccNumberSeparator);

                newCursorPosition =
                    ccNumberInputOldCursor - checkSeparator(ccNumberInputOldCursor, 4) +
                    checkSeparator(ccNumberInputOldCursor + (newValue.length - ccNumberInputOldValue.length), 4) +
                    (unmask(newValue).length - unmask(ccNumberInputOldValue).length);

                el.value = (newValue !== "") ? newValue : "";
            } else {
                el.value = ccNumberInputOldValue;
                newCursorPosition = ccNumberInputOldCursor;
            }

            el.setSelectionRange(newCursorPosition, newCursorPosition);

            highlightCC(el.value);
        },
        highlightCC = (ccValue) => {
            let ccCardType = '',
                ccCardTypePatterns = {
                    amex: /^3/,
                    visa: /^4/,
                    mastercard: /^5/,
                    disc: /^6/,

                    genric: /(^1|^2|^7|^8|^9|^0)/,
                };

            for (const cardType in ccCardTypePatterns) {
                if (ccCardTypePatterns[cardType].test(ccValue)) {
                    ccCardType = cardType;
                    break;
                }
            }

            let activeCC = document.querySelector('.cc-types__img--active'),
                newActiveCC = document.querySelector(`.cc-types__img--${ccCardType}`);

            if (activeCC) activeCC.classList.remove('cc-types__img--active');
            if (newActiveCC) newActiveCC.classList.add('cc-types__img--active');
        },
        ccExpiryInputKeyDownHandler = (e) => {
            let el = e.target;
            ccExpiryInputOldValue = el.value;
            ccExpiryInputOldCursor = el.selectionEnd;
        },
        ccExpiryInputInputHandler = (e) => {
            let el = e.target,
                newValue = el.value;

            newValue = unmask(newValue);
            if (newValue.match(ccExpiryPattern)) {
                newValue = mask(newValue, 2, ccExpirySeparator);
                el.value = newValue;
            } else {
                el.value = ccExpiryInputOldValue;
            }
        };

    ccNumberInput.addEventListener('keydown', ccNumberInputKeyDownHandler);
    ccNumberInput.addEventListener('input', ccNumberInputInputHandler);

    ccExpiryInput.addEventListener('keydown', ccExpiryInputKeyDownHandler);
    ccExpiryInput.addEventListener('input', ccExpiryInputInputHandler);
</script>
<?php ?>