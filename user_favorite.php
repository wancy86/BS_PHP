<?php
require_once 'lib/mysql.func.php';
session_start();
$uid = $_SESSION['uid'];

?>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <title>BoyStyle</title>
            <?php require_once 'style.php';?>
        </head>

        <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--navbar-->
                        <?php require_once 'header.php';?>
                    </div>
                </div>
                <!--title-->
                <div class="row">
                    <div class="col-md-12" id="content">
                        <h3>我的收藏</h3>
                        <hr>
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
