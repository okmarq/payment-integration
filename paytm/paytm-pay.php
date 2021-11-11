<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
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
    
    <form method="post" action="complete_transaction.php" class="row g-3">
        <div class="col-6">
            <label for="paytm-orderid">Order ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-orderid" name="ORDER_ID" value="<?php echo "ORDS" . rand(10000,99999999)?>" readonly>
        </div>
        <div class="col-6">
            <label for="paytm-customerid">Customer ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-customerid" name="CUST_ID" value="CUST001" readonly>
        </div>
        <div class="col-4">
            <label for="paytm-industryid">Industry type ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-industryid" name="INDUSTRY_TYPE_ID" value="Retail" readonly>
        </div>
        <div class="col-4">
            <label for="paytm-channelid">Channel</label>
            <input class="form-control form-control-sm" type="text" id="paytm-channelid" name="CHANNEL_ID" value="WEB" readonly>
        </div>
        <div class="col-4">
            <label for="paytm-amount">Amount</label>
            <input class="form-control form-control-sm" type="number" id="paytm-amount" name="TXN_AMOUNT" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary mb-3" type="submit">Pay</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>