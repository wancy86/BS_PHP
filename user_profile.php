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
            <div class="col-md-12">
                <h3>结算中心</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-11">
                <img style="width:140px;height:140px;" alt="Bootstrap Image Preview" src="./images/user_header.png" />
                <dl>
                    <dt>
                        账号
                        邮箱
                        淘宝账号、修改添加
                        修改密码
                        

                    </dt>
                    <dd>
                        myemail@123.com
                    </dd>
                    <dt>
                        电话
                    </dt>
                    <dd>
                        12345678911
                    </dd>
                    <dt>
                        淘宝账号
                    </dt>
                    <dd>
                        wancy8668
                    </dd>
                    <dt>
                        收货地址
                    </dt>
                    <dd>
                        淘景大厦1301
                    </dd>
                </dl>
            </div>
        </div>
        <?php require_once 'script.php';?>
</body>

</html>
