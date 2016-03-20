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
                <!--content-->
                <div class="row">
                    <div class="col-md-12" id="content">
                    </div>
                </div>
                <!--footer-->
                <?php require_once 'footer.php';?>
            </div>
            <?php require_once 'script.php';?>
            <script>
            $(function  (){
                ShowFavorite();   
            });
            </script>
        </body>

    </html>
