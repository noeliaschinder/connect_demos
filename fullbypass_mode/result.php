<style>
pre {
  background: darkcyan;
} 
</style>
<?php

include_once ("ipg-utils.php");

$validateGatewayHash = validateGatewayHash($_POST, false);
    
if ($validateGatewayHash === true) {
    $approval_code = substr($_POST['approval_code'], 0, 1);
    if ($approval_code == 'N') {
        echo "Sorry, an error occurred while processing your purchase<br>";
        echo "Fail Reason: " . $_POST['fail_reason'] . "<br>";
    } else if($approval_code == 'Y') {
        echo "Thank you for your purchase!<br>";
    } else {
        echo "result: " . $_POST['approval_code'] . "<br>";
    }

    echo '<br><pre>' . print_r($_POST, true) . "</pre>";
} else {
    echo "Invalid Response Hash received";
}