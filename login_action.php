<?php
// header("Content-type: text/html; charset=utf-8");
// require_once './lib/mysql.func.php';
// require_once './lib/common.func.php';

// $emailphone = isset($_POST[emailphone]) ? $_POST[emailphone] : "";
// $pwd = isset($_POST[pwd]) ? $_POST[pwd] : "";
// $pwd = strtoupper(substr(md5($pwd), 8, 16));
// $validatecode = isset($_POST[validatecode]) ? $_POST[validatecode] : "";

// $query = "select pwd from BS_User where email='$emailphone' or account ='$emailphone' limit 1";
// // select top 1 pwd from BS_User where emial='$emailphone' or phone ='$emailphone'

// // echo $query;
// $result = mysqli_query(connect(), $query);

// $msg = "登录成功";
// $page = "index.php";
// $script = "";
// if ($row = mysqli_fetch_assoc($result)) {
// 	if ($row['pwd'] == $pwd) {
// 		//login, keep the session
// 		$msg = "登录成功";
// 		$page = "index.php";
// 	} else {
// 		//用户名密码不对
// 		$msg = "用户名密码不对";
// 		$page = "login.php";
// 		$script = "$('#emailphone').val($emailphone).focus();";
// 	}
// } else {
// 	//用户不存在
// 	$msg = "用户名密码不对";
// 	$page = "login.php";
// 	$script = "$('#emailphone').val($emailphone).focus();";
// }

// // redirect
// AlertMessage($page, $msg, $script);
