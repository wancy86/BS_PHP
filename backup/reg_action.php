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
$row = mysqli_fetch_assoc($checkresult);
print_r($row);
var_dump($row);
var_export($row);
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