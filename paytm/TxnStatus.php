<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$ORDER_ID = "";
$requestParamList = array();
$responseParamList = array();

if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {

	// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
	$ORDER_ID = $_POST["ORDER_ID"];

	// Create an array having all required parameters for status query.
	$requestParamList = array("MID" => PAYTM_MERCHANT_MID, "ORDERID" => $ORDER_ID);

	$StatusCheckSum = getChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY);

	$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

	// Call the PG's getTxnStatusNew() function for verifying the transaction status.
	$responseParamList = getTxnStatusNew($requestParamList);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Transaction status query</title>
<meta name="GENERATOR" content="Evrsoft First Page">
</head>

<body>
	<h2>Transaction status query</h2>
	<form method="post" action="">
		<div class="col-6">
            <label for="paytm-orderid">Order ID</label>
            <input class="form-control form-control-sm" type="text" id="paytm-orderid" name="ORDER_ID" value="<?php echo $ORDER_ID ?>">
        </div>
		<div class="col-6">
            <button class="btn btn-primary mb-3" type="submit">Verify Transaction</button>
        </div>

		<br></br>		
	</form>

	<?php if (isset($responseParamList) && count($responseParamList) > 0) { ?>
		<h2>Response of status query:</h2>
		<table class="table table-sm table-striped table-hover">
			<tbody>
				<?php foreach ($responseParamList as $paramName => $paramValue) { ?>
				<tr>
					<th scope="row"><?php echo $paramName ?></th>
					<td><?php echo $paramValue ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>