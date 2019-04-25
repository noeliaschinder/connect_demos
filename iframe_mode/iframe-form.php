<?php include("ipg-utils.php"); ?>

<h2>ARS <?php echo getChargeTotal(); ?></h2>
<form id="checkoutform" method="post" action="<?php echo getEndpoint(); ?>">
   <input type="hidden" name="checkoutoption" value="simpleform">
   <input type="hidden" name="hostURI" value="http://localhost/connect/iframe_mode/index.php">
   <input type="hidden" name="txntype" value="sale">
   <input type="hidden" name="timezone" value="America/Buenos_Aires"/>
   <input type="hidden" name="txndatetime" value="<?php echo getDateTime(); ?>"/>
   <input type="hidden" name="hash_algorithm" value="SHA256"/>
   <input type="hidden" name="hash" value="<?php echo createHash(getChargeTotal(), getCurrency()); ?>"/>
   <input type="hidden" name="storename" value="<?php echo getStoreId(); ?>" />
   <input type="hidden" name="currency" value="<?php echo getCurrency(); ?>" />
   <input type="hidden" name="chargetotal" value="<?php echo getChargeTotal(); ?>"/>
   <input type="hidden" name="responseFailURL" value="http://localhost/connect/iframe_mode/result.php"/>
   <input type="hidden" name="responseSuccessURL" value="http://localhost/connect/iframe_mode/result.php"/>
   <input type="submit" value="Submit">
</form>