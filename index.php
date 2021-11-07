<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <title>Payment Integration</title>
</head>

<body>
    <div class="container">
        <h1>Payment Integration with Paystack</h1>

        <form id="paymentForm" class="row g-3">
            <div class="col-auto">
                <label for="email">Email Address</label>
                <input class="form-control form-control-sm" type="email" id="email" required aria-label="email">
            </div>
            <div class="col-auto">
                <label for="amount">Amount</label>
                <input class="form-control form-control-sm" type="number" id="amount" required aria-label="amount">
            </div>
            <div class="col-auto">
                <label for="first-name">First Name</label>
                <input class="form-control form-control-sm" type="text" id="first-name" aria-label="first-name">
            </div>
            <div class="col-auto">
                <label for="last-name">Last Name</label>
                <input class="form-control form-control-sm" type="text" id="last-name" aria-label="last-name">
            </div>
            <div class="col-12">
                <button class="btn btn-primary mb-3" type="submit" onclick="{(e)=>payWithPaystack(e)}">Pay</button>
            </div>
        </form>
    </div>

    <script src="/js/jquery-3.6.0.min.js"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_test_aca08e6603a71b047c5e154f5c51c7557fdc9e55', // Replace with your public key
                email: document.getElementById("email").value,
                amount: document.getElementById("amount").value * 100,
                onClose: function() {
                    alert('Window closed.');
                },
                callback: function(response) {
                    // window.location = "http://www.yoururl.com/verify_transaction.php?reference=" + response.reference;
                    $.ajax({
                        url: 'http://payment-integration.test/verify_transaction.php?reference=' + response.reference,
                        method: 'get',
                        success: function(response) {
                            console.log(response);
                            // the details needed will be extracted from here and used
                        }
                    });
                }
            });
            handler.openIframe();
        }
    </script>
</body>

</html>