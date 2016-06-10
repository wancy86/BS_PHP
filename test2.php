<?php
header("Content-type: text/html; charset=utf-8");

require_once './lib/send_email.php';
// sendemail($receivers, $subject, $contents)
//


//************************************************
//PHP如何组织JSON数据
//关键是使用array
if(1){
    $rawdata=array();
    $rawdata['data']=array('1','2');
    $rawdata['totalrows']=100;
    header('Content-Type:application/json');
    echo json_encode($rawdata);
    exit();
}


//************************************************
// 这个好像是UTC时间，少8小时
//echo date("Y/m/d/ H:i:s a");


// echo str_replace('phpinfo.php','phpinfo','reg');

// // echo 123;

// //test mail
// // mail('mwan@maxprocessing.com', 'test', 'hello mark');

// //test MD5
// if (1 == 2) {
// 	echo strtoupper(substr(md5('潮装'), 8, 16));
// }

// //e10adc3949ba59abbe56e057f20f883e

// //test JSON
// if (1 == 2) {
// 	$arr = array(
// 		'a' => 1,
// 		'b' => 2,
// 		'c' => 3,
// 		'd' => 4,
// 		'e' => 5,
// 	);

// 	echo json_encode($arr);

// 	$obj->body = 'another post';
// 	$obj->id = 21;
// 	$obj->approved = true;
// 	$obj->favorite_count = 1;
// 	$obj->status = NULL;
// 	echo json_encode($obj);
// }

// echo $_server[self];

// echo strtoupper(substr(md5('admin'), 8, 16));
?>
<title>测试</title>

<?php
//test the paging
// require_once "lib/page.func.php";
// echo showBSPage(102);
?>

<?php

// require_once './lib/Logs.php';
// addLog(446456546);
?>


