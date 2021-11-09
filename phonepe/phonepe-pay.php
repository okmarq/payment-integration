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
    <h1>Payment Integration with PhonePe</h1>
    
    <form id="payment" class="row g-3">
        <div class="col-auto">
            <label for="phonepe-email">Email Address</label>
            <input class="form-control form-control-sm" type="email" id="phonepe-email" required aria-label="phonepe-email">
        </div>
        <div class="col-auto">
            <label for="phonepe-amount">Amount</label>
            <input class="form-control form-control-sm" type="number" id="phonepe-amount" required aria-label="phonepe-amount">
        </div>
        <div class="col-auto">
            <label for="phonepe-phone">Phone Number</label>
            <input class="form-control form-control-sm" type="tel" id="phonepe-phone" aria-label="phonepe-phone">
        </div>
        <div class="col-12">
            <button class="btn btn-primary mb-3" type="button" onclick="pay()">Pay</button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
function pay() {
    let payload = {
        "merchantId": "M2306160483220675579140",
        "transactionId": "TX123456789",
        "merchantUserId": "U123456789",
        "amount": document.getElementById("phonepe-amount").value,
        "merchantOrderId": "OD1234",
        "mobileNumber": document.getElementById("phonepe-phone").value,
        "message": "payment for order placed OD1234",
        "subMerchant": "DemoMerchant",
        "email": document.getElementById("phonepe-email").value,
        "shortName": "Amit",
    };
    let req = JSON.stringify(payload);

    let enc = btoa(unescape(encodeURIComponent(req)));

    // let dec = decodeURIComponent(escape(atob(enc)));

    $.ajax({
        url: '/phonepe/phonepe-debit.php',
        method: 'post',
        data: {
            data: payload
        },
        success: function(response) {
            console.log(response);
            // the details needed will be extracted from response and used
        }
    });
}
</script>
</body>

</html>