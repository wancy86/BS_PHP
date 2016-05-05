<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
require_once './lib/Logs.php';

$account = isset($_POST[account]) ? $_POST[account] : "";
$email = isset($_POST[emailphone]) ? $_POST[emailphone] : "";
$phone = isset($_POST[emailphone]) ? $_POST[emailphone] : "";
$pwd = isset($_POST[pwd]) ? $_POST[pwd] : "";
$pwd = strtoupper(substr(md5($pwd), 8, 16));

//写日志调试
addLog("pwd = " . $pwd);

$taobao_account = isset($_POST[taobao_account]) ? $_POST[taobao_account] : "";
$invite_code = isset($_POST[invite_code]) ? $_POST[invite_code] : "";
$invite_by = isset($_POST[invite_by]) ? $_POST[invite_by] : 0;

//检查用户名和邮箱是否已经注册过了
$checkquery = "";
$checkquery .= " select *";
$checkquery .= " from   (";
$checkquery .= "            select count(0) as account";
$checkquery .= "            from   BS_User";
$checkquery .= "            where  account = '$account'";
$checkquery .= "        ) as A";
$checkquery .= " left join (";
$checkquery .= "          select count(0) as email";
$checkquery .= "          from   BS_User";
$checkquery .= "          where  email = '$email'";
$checkquery .= "      ) as B on  1 = 1";

$msg = "";
$page = "";
$checkresult = mysqli_query(connect(), $checkquery);
$row = mysqli_fetch_assoc($checkresult); //得到数组

if ($row['account'] > 0) {
	$msg = "用户名已存在";
} elseif ($row['email'] > 0) {
	$msg = "邮箱已存在";
} else {
	//注册
	$query = " insert into BS_User(account, email, phone, pwd, taobao_account, invite_code, invite_by, reg_date)";
	$query .= " values('$account', '$email', '$phone', '$pwd', '$taobao_account', '$invite_code', $invite_by, now())";

	// echo $query;
	$result = mysqli_query(connect(), $query);
	$msg = "注册成功,请登录！";
	$page = "login.php";
}

// insert into BS_User(account, email, phone, pwd, invite_code, invite_by, reg_date)
// values('$account', '$email', '$phone', '$pwd', '$invite_code', $invite_by, now())

// redirect
AlertMessage($page, $msg);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>注册</title>
    <?php require_once 'style.php';?>
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="margin-bottom:100px;">
            <div class="col-md-12">
                <!--navbar-->
                <?php require_once 'header.php';?>
                <!--content-->
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <form role="form" class="form-horizontal" action="reg.php" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="emailphone">邮箱 : </label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="emailphone" name="emailphone" placeholder="请输入邮箱" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="account">用户名 : </label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="account" name="account" placeholder="用户名必须是纯字母和数组的组成" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="pwd">密码 : </label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="密码必须是6-25位数字、字母、符号" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="pdw2">确认密码 : </label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="pdw2" name="pdw2" placeholder="请重新输入" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="taobao_account">淘宝账号 : </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="taobao_account" name="taobao_account" placeholder="关联淘宝账号便于返利" />
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-5">
                                <button type="submit" class="btn btn-success"> 注册 </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php require_once 'footer.php';?>
    </div>
    <?php require_once 'script.php';?>
</body>

</html>
