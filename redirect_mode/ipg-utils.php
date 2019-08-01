<?php

// Timezeone needs to be set
date_default_timezone_set('America/Buenos_Aires');
$dateTime = date("Y:m:d-H:i:s");

function getEndpoint() {
    return "https://test.ipg-online.com/connect/gateway/processing";
}

function getDateTime() {
   global $dateTime;
   return $dateTime;
}
/** Function that calculates the hash of the following parameters:
* - Store Id
* - Date/Time(see $dateTime above)
* - chargetotal
* - currency (numeric ISO value)
* - shared secret
*/
function createHash($chargetotal, $currency) {
   $storeId = getStoreId();
   $sharedSecret = getSharedSecret();
   $stringToHash = $storeId . getDateTime() . $chargetotal . $currency . $sharedSecret;
   $ascii = bin2hex($stringToHash);
   return hash("sha256", $ascii);
}

function getStoreId() {
   // Please change the store Id to your individual Store ID
   return "5900000000";
}

function getSharedSecret() {
   // NOTE: Please DO NOT hardcode the secret in that script. For example read it from a database.
   return "sharedsecret";
}

function getChargeTotal() {
    return "100.00";
}

function getCurrency() {
   // ARG Pesos
    return "032";
}

function validateGatewayHash($responsedata, $isNotify) {
   if (empty($responsedata) || !isset($responsedata['oid'])) {
       //No valid transaction data was passed to validate the order!
       return false;
   }
   $return = true;
   $storename = getStoreId();
   $sharedsecret = getSharedSecret();

   $chargetotal = $responsedata['chargetotal'];
   $txndatetime = $responsedata['txndatetime'];
   $approvalcode = $responsedata['approval_code'];
   $currencyCode = $responsedata['currency'];

   if ($isNotify == true) {
       $hashValue = hash("sha256", bin2hex($chargetotal . $sharedsecret . $currencyCode . $txndatetime . $storename . $approvalcode));
       if ($hashValue != $responsedata['notification_hash']) {
           //Invalid Notification Hash received from gateway
           $return = false;
       }
   } else {
       $hashValue = hash("sha256", bin2hex($sharedsecret . $approvalcode . $chargetotal . $currencyCode . $txndatetime . $storename));
       if ($hashValue != $responsedata['response_hash']) {
           //Invalid Response Hash received from gateway
           $return = false;
       }
   }
   return $return;
}