<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Connect - Full_Bypass</title>
</head>
<body>
    <?php include("ipg-utils.php"); ?>
    <div class="container">
        <h2>ARS <?php echo getChargeTotal(); ?></h2>
        <form id="checkoutform" method="post" action="<?php echo getEndpoint(); ?>">

            <div class="form-group">
                <label for="">Card Numbers</label>
                <input type="text" class="form-control" name="cardnumber" value="">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Exp Month</label>
                    <select class="form-control" name="expmonth">
                        <?php for($i=1; $i<=12; $i++) { ?>
                        <?php if ($i<10) { ?>
                        <option><?php echo "0",$i; ?></option>
                        <?php } else { ?>
                        <option><?php echo $i; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Exp Year</label>
                    <select class="form-control" name="expyear">
                        <?php $year = date('Y'); for($i=$year; $i<=$year+35; $i++) { ?>
                        <?php if ($i<10) { ?>
                        <option><?php echo "0",$i; ?></option>
                        <?php } else { ?>
                        <option><?php echo $i; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="">CVC</label>
                <input type="password" class="form-control" name="cvm" value="">
            </div>

            <input type="hidden" name="txntype" value="sale">
            <input type="hidden" name="timezone" value="America/Buenos_Aires"/>
            <input type="hidden" name="txndatetime" value="<?php echo getDateTime(); ?>"/>
            <input type="hidden" name="hash_algorithm" value="SHA256"/>
            <input type="hidden" name="hash" value="<?php echo createHash(getChargeTotal(), getCurrency()); ?>"/>
            <input type="hidden" name="storename" value="<?php echo getStoreId(); ?>" />
            <input type="hidden" name="currency" value="<?php echo getCurrency(); ?>" />
            <input type="hidden" name="chargetotal" value="<?php echo getChargeTotal(); ?>"/>
            <input type="hidden" name="responseFailURL" value="http://localhost/connect/fullbypass_mode/result.php"/>
            <input type="hidden" name="responseSuccessURL" value="http://localhost/connect/fullbypass_mode/result.php"/>
            <input type="hidden" name="full_bypass" value="true">
            <input type="hidden" name="mode" value="payonly">
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>
</body>
</html>