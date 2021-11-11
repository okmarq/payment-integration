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
    <h1>Payment Integration with PayTM</h1>
    
    <form id="payment" class="row g-3">
        <div class="col-6">
            <label for="paytm-orderid">Order ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-orderid" required>
        </div>
        <div class="col-6">
            <label for="paytm-customerid">Customer ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-customerid" required>
        </div>
        <div class="col-4">
            <label for="paytm-industryid">Industry type ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-industryid" required value="Retail">
        </div>
        <div class="col-4">
            <label for="paytm-channelid">Channel</label>
            <input class="form-control form-control-sm" type="text" id="paytm-channelid" required value="WEB">
        </div>
        <div class="col-4">
            <label for="paytm-amount">Amount</label>
            <input class="form-control form-control-sm" type="number" id="paytm-amount" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary mb-3" type="button" onclick="{(e)=>pay(e)}">Pay</button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    function pay(e) {
        e.preventDefault();
        let orderid = $("#paytm-orderid"),
        customerid = $("#paytm-customerid"),
        industryid = $("#paytm-industryid"),
        channelid = $("#paytm-channelid"),
        amount = $("#paytm-amount");

        $.ajax({
            url: 'pgRedirect.php',
            method: 'post',
            data: {
                ORDER_ID: orderid,
                CUST_ID: customerid,
                INDUSTRY_TYPE_ID: industryid,
                CHANNEL_ID: channelid,
                TXN_AMOUNT: amount
            },
            success: function (response) {
                console.log();
            }
        });
    }
</script>
</body>

</html>