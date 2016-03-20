<?php
require_once 'lib/mysql.func.php';
session_start();
$uid = $_SESSION['uid'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BoyStyle</title>
    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--navbar-->
                <?php require_once 'header.php';?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-11">
                <img style="width:140px;height:140px;" alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" />
                <dl>
                    <dt>
                        Description lists
                    </dt>
                    <dd>
                        A description list is perfect for defining terms.
                    </dd>
                    <dt>
                        Euismod
                    </dt>
                    <dd>
                        Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
                    </dd>
                    <dd>
                        Donec id elit non mi porta gravida at eget metus.
                    </dd>
                    <dt>
                        Malesuada porta
                    </dt>
                    <dd>
                        Etiam porta sem malesuada magna mollis euismod.
                    </dd>
                    <dt>
                        Felis euismod semper eget lacinia
                    </dt>
                    <dd>
                        Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                    </dd>
                </dl>
            </div>
        </div>
        <?php require_once 'script.php';?>
</body>

</html>
