<?php
require_once 'lib/mysql.func.php';
session_start();
$uid = $_SESSION['uid'];

// echo $_SERVER['REQUEST_METHOD'];

$account = "";
$email = "";
$taobao_account = "";
$phone = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$query = "";
	$query .= "select account,taobao_account,phone,email from BS_User where uid=$uid";
	$result = mysqli_query(connect(), $query);
	$user = mysqli_fetch_assoc($result);
	// print_r($user);

	$account = $user['account'];
	$email = $user['email'];
	$taobao_account = $user['taobao_account'];
	$phone = $user['phone'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$account = isset($_POST['account']);
	$taobao_account = "";
	$phone = "";

	$query = "";
	$query .= "update BS_User set account=,taobao_account,phone,email from BS_User where uid=$uid";
	$result = mysqli_query(connect(), $query);
	$user = mysqli_fetch_assoc($result);
	print_r($user);
	$account = $user['account'];
	$email = $user['email'];
	$taobao_account = $user['taobao_account'];
	$phone = $user['phone'];
}

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
                    <form action="user_profile.php" method="POST">
                        <div class="form-group">
                            <label>邮箱</label><small>(非公开)</small>
                            <br>
                            <span class="text-primary"><?php echo $email; ?></span>
                        </div>
                        <div class="form-group">
                            <label>昵称</label>
                            <br>
                            <div style="display:<?php if ($account == '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <span class="text-primary"><?php echo $account; ?></span>
                                <a role="button" class="btn btn-sm btn-default" href="#"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                            </div>
                            <div style="display:<?php if ($account != '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <input style="display: inline-block;width:80%" type="text" class="form-control" id="account" name="account" placeholder="昵称, 登录后显示">
                                <a class="btn btn-sm btn-success"><span class="glyphicon glyphicon-save"></span> 保存</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>淘宝账号</label><small>(非公开)</small>
                            <br>
                             <div style="display:<?php if ($taobao_account == '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <span class="text-primary"><?php echo $taobao_account; ?></span>
                                <a role="button" class="btn btn-sm btn-default" href="#"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                            </div>
                            <div style="display:<?php if ($taobao_account != '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <input style="display: inline-block;width:80%" type="text" class="form-control" id="taobao_account" name="taobao_account" placeholder="淘宝账号, 用于返利">
                                <a class="btn btn-sm btn-success"><span class="glyphicon glyphicon-save"></span> 保存</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>电话</label><small>(非公开)</small>
                            <br>
                            <div style="display:<?php if ($phone == '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <span class="text-primary"><?php echo $phone; ?></span>
                                <a role="button" class="btn btn-sm btn-default" href="#"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                            </div>
                            <div style="display:<?php if ($phone != '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <input style="display: inline-block;width:80%" type="text" class="form-control" id="phone" name="phone" placeholder="联系电话">
                                <a class="btn btn-sm btn-success"><span class="glyphicon glyphicon-save"></span> 保存</a>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                        <label>收货地址</label> <small>(非公开)</small>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="礼品邮寄地址" value="淘景大厦1301">
                        </div> -->
                        <!-- <div class="form-group">
                            <button type="submit" class="btn btn-success">保存</button>
                        </div> -->
                    </form>
                </div>
            </div>
            <?php require_once 'script.php';?>
            <?php require_once 'footer.php';?>
    </body>

    </html>
