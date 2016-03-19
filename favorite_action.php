<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';

session_start();
$uid = $_SESSION['uid'];
$action=$_REQUEST['action'];
$pro_id=$_REQUEST['pro_id'];

switch ($action) {
	case 'add':
		//add favorite items
		$query  =" replace into BS_Favorite(uid,pro_id,entrydate)";
		$query .=" values($uid,$pro_id,getdate())";
		mysqli_query(connect(),$query);
		echo "添加成功";

		break;
	case 'del':
		//remove favorite item		
		$query  =" delete from BS_Favorite	where uid=$uid and pro_id=$pro_id";
		mysqli_query(connect(),$query);
		echo "删除成功";
		break;
	default:
		# code...
		break;
}


?>