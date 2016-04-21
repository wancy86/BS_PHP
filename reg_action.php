<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';

$account = isset($_POST[account]) ? $_POST[account] : "";
$email = isset($_POST[emailphone]) ? $_POST[emailphone] : "";
$phone = isset($_POST[emailphone]) ? $_POST[emailphone] : "";
$pwd = isset($_POST[pwd]) ? $_POST[pwd] : "";
$pwd = strtoupper(substr(md5($pwd), 8, 16));
$taobao_account = isset($_POST[taobao_account]) ? $_POST[taobao_account] : "";
$invite_code = isset($_POST[invite_code]) ? $_POST[invite_code] : "";
$invite_by = isset($_POST[invite_by]) ? $_POST[invite_by] : 0;

$query = " insert into BS_User(account, email, phone, pwd, taobao_account, invite_code, invite_by, reg_date)";
$query .= " values('$account', '$email', '$phone', '$pwd', '$taobao_account', '$invite_code', $invite_by, now())";

// echo $query;
$result = mysqli_query(connect(), $query);

// insert into BS_User(account, email, phone, pwd, invite_code, invite_by, reg_date)
// values('$account', '$email', '$phone', '$pwd', '$invite_code', $invite_by, now())

// redirect
echo "<script>alert('注册成功，请登录！');window.location.href='http://localhost/boystyle/login.php';</script>";
