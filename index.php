<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<title>Payment Integration</title>
</head>

<body>
<div class="container">
    <div class="row g-5">
        <div class="col-12">
            <h1>Payment Integration with Paystack</h1>
            <form id="paymentForm" class="row g-3">
                <div class="col-auto">
                    <label for="paystack-email">Email Address</label>
                    <input class="form-control form-control-sm" type="email" id="paystack-email" required aria-label="paystack-email">
                </div>
                <div class="col-auto">
                    <label for="paystack-amount">Amount</label>
                    <input class="form-control form-control-sm" type="number" id="paystack-amount" required aria-label="paystack-amount">
                </div>
                <div class="col-auto">
                    <label for="paystack-first-name">First Name</label>
                    <input class="form-control form-control-sm" type="text" id="paystack-first-name" aria-label="paystack-first-name">
                </div>
                <div class="col-auto">
                    <label for="paystack-last-name">Last Name</label>
                    <input class="form-control form-control-sm" type="text" id="paystack-last-name" aria-label="paystack-last-name">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary mb-3" type="submit" onclick="{(e)=>payWithPaystack(e)}">Pay</button>
                </div>
            </form>
        </div>

        <div class="col-12">
            <h1>Payment Integration with Flutterwave</h1>
            <form id="paymentForm" class="row g-3">
                <div class="col-auto">
                    <label for="flutterwave-email">Email Address</label>
                    <input class="form-control form-control-sm" type="email" id="flutterwave-email" required aria-label="flutterwave-email">
                </div>
                <div class="col-auto">
                    <label for="flutterwave-amount">Amount</label>
                    <input class="form-control form-control-sm" type="number" id="flutterwave-amount" required aria-label="flutterwave-amount">
                </div>
                <div class="col-auto">
                    <label for="flutterwave-first-name">First Name</label>
                    <input class="form-control form-control-sm" type="text" id="flutterwave-first-name" aria-label="flutterwave-first-name">
                </div>
                <div class="col-auto">
                    <label for="flutterwave-last-name">Last Name</label>
                    <input class="form-control form-control-sm" type="text" id="flutterwave-last-name" aria-label="flutterwave-last-name">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary mb-3" type="button" onclick="makePayment()">Pay Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
    e.preventDefault();
    let handler = PaystackPop.setup({
        key: 'pk_test_aca08e6603a71b047c5e154f5c51c7557fdc9e55',
        email: document.getElementById("paystack-email").value,
        firstname: document.getElementById("paystack-first-name").value,
        lastname: document.getElementById("paystack-last-name").value,
        amount: document.getElementById("paystack-amount").value * 100,
        onClose: function() {
            alert('Window closed.');
        },
        callback: function(response) {
            $.ajax({
                url: '/paystack/verify_transaction.php?reference=' + response.reference,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    // the details needed will be extracted from response and used
                }
            });
        }
    });
    handler.openIframe();
}
</script>

<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
function makePayment() {
    FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-4e93c5d90d4ed60f9349275ff9f64680-X",
        tx_ref: '' + Math.floor((Math.random() * 1000000000) + 1), // use a better random number generator here
        amount: document.getElementById("flutterwave-amount").value,
        currency: "NGN",
        country: "NG",
        payment_options: " ",
        // redirect_url: "http://payment-integration.test", // leave this out to kep the page from reloading after successful  transaction verification
        customer: {
            email: document.getElementById("flutterwave-email").value,
            name: document.getElementById("flutterwave-first-name").value + " " + document.getElementById("flutterwave-last-name").value,
            phone_number: '08118682051',
        },
        callback: function(data) {
            $.ajax({
                url: '/flutterwave/verify_transaction.php?transaction_id=' + data.transaction_id,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    // the details needed will be extracted from response and used
                }
            });
        },
        customizations: {
            title: "My store",
            description: "Payment for items in cart",
            logo: "https://assets.piedpiper.com/logo.png",
        },
    });
}
</script>
</body>

</html>