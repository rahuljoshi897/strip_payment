<?php
use \PhpPot\Service\StripePayment;
include_once("../include/config.db.php");
include_once ("../include/config.php");
require_once "payment/config.php";
$db = getMYSQLIConnection();
if (!empty($_POST["token"])) {
    require_once 'payment/StripePayment.php';
    $stripePayment = new StripePayment();

    $currDate = date('Y-m-d');
    $nextDate = '';
    $_POST['email'] = $_SESSION['candidate']['email'];
    $candidateId = $_SESSION['candidate']['id'];
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);

    if($_POST['subscription_type']=='monthly'){
        $nextDate = date('Y-m-d', strtotime('+1 month'));
    }else{
        $nextDate = date('Y-m-d', strtotime('+1 years'));
    }

    $paymentResponse = json_encode($stripeResponse);
    //Store response in DB in both succes and failure.. but show the appropriate message..

     $query = "INSERT INTO tbl_payment (amount, currency_code, transaction_id, payment_status, payment_response,subscription_start_date,subscription_end_date,candidate_id) values ('".$_POST['amount']."', '".$_POST['currency_code']."', '".$stripeResponse['balance_transaction']."', '".$stripeResponse['paid']."', '".$paymentResponse."', '".$currDate."', '".$nextDate."','".$candidateId."')";
    $db->query($query);
    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
        echo $successMessage = "<img src='../../assets/app/media/success.png' style='    text-align: center;
        width: 18%;
        margin-left: 50%;'><br><br><span    style=' font-size: 19px;
        font-weight: bold;
        margin-left: 35%;
        text-align: center;'>Your Payment is completed successfully. Your transaction Id is " . $stripeResponse["balance_transaction"].'</span>
        <br><br><span style="    font-size: 19px;
        font-weight: bold;
        margin-left: 44%;"> We are redirecting you to Pay Comparision screen in <span style="    color: blue;">5 sec...</span></span>';
       header( "refresh:5;url=/pay.php" );

    }else if($stripeResponse['paid'] == 0){
        //Error..
        echo $successMessage = "Error while processing your payment. Please try again later. We are redirecting you to dashbord in 5 sec...";
       // header( "refresh:5;url=/" );
    }
}else{
    //error handling and redirect to page..
}
?>