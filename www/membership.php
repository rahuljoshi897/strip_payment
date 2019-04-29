<?php
include_once("../include/config.php");
include_once("../include/config.auth.php");
include_once("../include/functions.Parser.php");
include_once("payment/config.php");

echo parsePage("payment.html", array(


));
?>
 <input type='hidden' id='publishableKey' value="<?php echo STRIPE_PUBLISHABLE_KEY; ?>">
 <input type='hidden' id='product_desc' value="<?php echo PRODUCT_DESCRIPTION; ?>">
 <input type='hidden' id='currency_code' value="<?php echo CURRENCY_CODE; ?>">

 <input type='hidden' id='subscriptionMonthly' value="<?php echo SUBS_MONTHLY; ?>">
 <input type='hidden' id='subscriptionYearly' value="<?php echo SUBS_YEARLY; ?>">