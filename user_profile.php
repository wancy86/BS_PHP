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
                    <h3>我的资料</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-1">
                    <img style="width:140px;height:140px;flaot:right" alt="Bootstrap Image Preview" src="./images/user_header.png" />
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">邮箱</label><small>(非公开)</small><br>
                        <span class="text-primary">myemail@sina.com</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">账号</label><small>(非公开)</small><br>
                        <span class="text-primary">myboystyle</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">昵称</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="昵称, 登录后显示">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">淘宝账号</label><small>(非公开)</small><br>
                        <span class="text-primary">mytaobao</span> 
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="淘宝账号, 用于返利" disabled="1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">电话</label><small>(非公开)</small><br>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="收货联系电话">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">收货地址</label> <small>(非公开)</small>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="礼品邮寄地址" value="淘景大厦1301">
                    </div>
                </div>
            </div>
            <?php require_once 'script.php';?>
            <?php require_once 'footer.php';?>
    </body>

    </html>
