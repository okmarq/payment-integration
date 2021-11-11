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
    <h1>Payment Integration with Google Pay</h1>

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
            <button class="btn btn-primary mb-3" type="submit">Pay</button>
        </div>
    </form>

    <div id="container"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
const baseRequest = {
    apiVersion: 2,
    apiVersionMinor: 0
};

const allowedCardNetworks = ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "VISA"];
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

const tokenizationSpecification = {
    type: 'PAYMENT_GATEWAY',
    parameters: {
    'gateway': 'auruspay',
    'gatewayMerchantId': '12345678910111213141'
    }   
    
    /* type: 'DIRECT',
    parameters: {
    protocolVersion: 'ECv2',
    publicKey: 'BOxnUMXdAh5VSr4jXwTKR/RS7zXyDbYkGkarLg0Mc4F8HLA5N20EY5kK1Mq4m2oZo/MtANLV6oCcU2Vt7e8Af3I='
}     */
};

const baseCardPaymentMethod = {
    type: 'CARD',
    parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks,
    billingAddressRequired:false
    
    // billingAddressRequired is optional parameter.
    // Merchant has to set value true f billing address is a requirement.
    // a billing address should only be requested if it's required to process the transaction. 
    // Additional data requests can increase friction in the checkout process and lead to a lower conversion rate.
    }
};

const cardPaymentMethod = Object.assign(
    {},
    baseCardPaymentMethod,
    {
    tokenizationSpecification: tokenizationSpecification
    }
);

//let paymentsClient = null;
function getGoogleIsReadyToPayRequest() {
    return Object.assign(
    {},
    baseRequest,
    {
    allowedPaymentMethods: [baseCardPaymentMethod]
    }
    );
}

function getGooglePaymentDataRequest() {
    const paymentDataRequest = Object.assign({}, baseRequest);
    paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
    paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
    paymentDataRequest.merchantInfo = {
    //merchantId: '12345678910111213141', //optional
    //merchantName: 'My Merchant' //optional
    };
    return paymentDataRequest;
}

function getGooglePaymentsClient() {
    //if ( paymentsClient === null ) {
    var paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
    //}
    return paymentsClient;
}

function onGooglePayLoaded() {
    const paymentsClient = getGooglePaymentsClient();
    paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
    .then(function(response) {
    if (response.result) {
            addGooglePayButton();
    }
    }) 
    .catch(function(err) {
    console.error(err);
    });
}

function addGooglePayButton() {
    const paymentsClient = getGooglePaymentsClient();
    const button =
    paymentsClient.createButton({onClick: onGooglePaymentButtonClicked});
    document.getElementById('container').appendChild(button);
}

function getGoogleTransactionInfo() {
    return {
    currencyCode: 'USD',
    totalPriceStatus: 'FINAL',
    totalPrice: '1.00'
    };
}

    function prefetchGooglePaymentData() {
    const paymentDataRequest = getGooglePaymentDataRequest();
    paymentDataRequest.transactionInfo = {
    totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
    currencyCode: 'USD'
    };
    const paymentsClient = getGooglePaymentsClient();
    paymentsClient.prefetchPaymentData(paymentDataRequest);
} 

function onGooglePaymentButtonClicked() {
    const paymentDataRequest = getGooglePaymentDataRequest();
    paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

    const paymentsClient = getGooglePaymentsClient();
    paymentsClient.loadPaymentData(paymentDataRequest)
    .then(function(paymentData) {
    processPayment(paymentData);
    
    })
    .catch(function(err) {
    console.error(err);
    });
}

function processPayment(paymentData) {
    
    console.log(paymentData);
    paymentToken = paymentData.paymentMethodData.tokenizationData.token;
    console.log(paymentToken);
    // alert("processPayment");
    document.write(paymentToken);
}
</script>
<script async
    src="https://pay.google.com/gp/p/js/pay.js"
    onload="onGooglePayLoaded()"></script>
</body>

</html>