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
    return "032";
}