<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connect - Redirect</title>
</head>
<body>
    <?php include("ipg-utils.php"); ?>

    <h2>ARS <?php echo getChargeTotal(); ?></h2>
    <!--h3>Pagar utilizando la tarjeta (VISA) 400000...0002</h3-->
    <form id="checkoutform" method="post" action="<?php echo getEndpoint(); ?>">
        <input type="hidden" name="checkoutoption" value="combinedpage">
        <input type="hidden" name="txntype" value="sale">
        <input type="hidden" name="timezone" value="America/Buenos_Aires"/>
        <input type="hidden" name="txndatetime" value="<?php echo getDateTime(); ?>"/>
        <input type="hidden" name="hash_algorithm" value="SHA256"/>
        <input type="hidden" name="hash" value="<?php echo createHash(getChargeTotal(), getCurrency()); ?>"/>
        <input type="hidden" name="storename" value="<?php echo getStoreId(); ?>" />
        <input type="hidden" name="currency" value="<?php echo getCurrency(); ?>" />
        <input type="hidden" name="chargetotal" value="<?php echo getChargeTotal(); ?>"/>
        <input type="hidden" name="responseFailURL" value="http://localhost/connect/redirect_mode/result.php"/>
        <input type="hidden" name="responseSuccessURL" value="http://localhost/connect/redirect_mode/result.php"/>

        <!--input type="hidden" name="numberOfInstallments" value="6"/-->

        <!--input type="hidden" name="assignToken" value="true"/>
        <input type="hidden" name="tokenType" value="MULTIPAY"/-->

        <!--input type="hidden" name="hosteddataid" value="0470716A-E971-44A6-A07F-AC2789710E7C"/>
        <input type="hidden" name="hosteddatastoreid" value="5999999999"/-->

        <input type="submit" value="Submit">
    </form>
</body>
</html>