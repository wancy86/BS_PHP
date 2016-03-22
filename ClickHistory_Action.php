<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';

session_start();
$uid = $_SESSION['uid'];
$action = $_REQUEST['action'];
$pro_id = $_REQUEST['pro_id'];

switch ($action) {
case 'click':
	//add favorite items
	$query = "replace into BS_ClickHistory(uid, pro_id, entrydate)";
	$query .= "values($uid, $pro_id, now())";
	echo "$query";
	mysqli_query(connect(), $query);
	echo "点击的链接已记录.";

	break;
default:
	# code...
	break;
}
