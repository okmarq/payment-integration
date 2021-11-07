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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
                    let message = 'Payment complete! Reference: ' + response.reference;
                    alert(message);
                    window.location = "http://payment-integration.test/verify_transaction.php?reference=" + response.reference;
                    $.ajax({
                        url: 'verify_transaction.php',
                        method: 'get',
                        success: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
            handler.openIframe();
        }
    </script>
</body>

</html>

{
"reference": "T266609159585221",
"trans": "1435631706",
"status": "success",
"message": "Approved",
"transaction": "1435631706",
"trxref": "T266609159585221"
}
{
"reference": "T266609159585221",
"trans": "1435631706",
"status": "success",
"message": "Approved",
"transaction": "1435631706",
"trxref": "T266609159585221"
}
{
"reference": "T154882024429226",
"trans": "1435637063",
"status": "success",
"message": "Approved",
"transaction": "1435637063",
"trxref": "T154882024429226"
}