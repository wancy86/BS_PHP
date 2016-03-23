<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';

session_start();
$uid = $_SESSION['uid'];
$action = $_REQUEST['action'];
$pro_id = $_REQUEST['pro_id'];

switch ($action) {
case 'add':
	//add favorite items
	$query = " replace into BS_Favorite(uid,pro_id,entrydate)";
	$query .= " values($uid,$pro_id,now())";
	// echo "$query";
	mysqli_query(connect(), $query);
	echo "收藏成功，可以在我的收藏中查看.";

	break;
case 'delete':
	//remove favorite item
	$query = " delete from BS_Favorite	where uid=$uid and pro_id=$pro_id";
	mysqli_query(connect(), $query);
	echo "删除成功";
	break;
case 'show':
	//show user favorite
	$rows = array();
	$query = " select P.pro_id ,title ,img_url ,detail_url ,shop_name ,price ,month_sold ,comm_percent ,seller_ww ,back_BB ,";
	$query .= " short_tbk_url ,tbk_url ,commission ,earn ,img_list ,show_order ,P.cat_id ,C.entrydate ,disabled ";
	$query .= " from BS_ProInfo AS P";
	$query .= " join BS_Favorite as C on P.pro_id=C.pro_id";
	$query .= " where P.disabled=0 and C.uid=$uid";
	// $query .= " limit 30";//TODO add paging

	// echo "$query";

	$result = mysqli_query(connect(), $query);
	while (@$row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	echo json_encode($rows);
	break;
default:
	# code...
	break;
}
