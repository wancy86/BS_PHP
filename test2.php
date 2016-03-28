<?php
header("Content-type: text/html; charset=utf-8");
// echo 123;

//test mail
// mail('mwan@maxprocessing.com', 'test', 'hello mark');

//test MD5
if (1 == 2) {
	echo strtoupper(substr(md5('潮装'), 8, 16));
}

//e10adc3949ba59abbe56e057f20f883e

//test JSON
if (1 == 2) {
	$arr = array(
		'a' => 1,
		'b' => 2,
		'c' => 3,
		'd' => 4,
		'e' => 5,
	);

	echo json_encode($arr);

	$obj->body = 'another post';
	$obj->id = 21;
	$obj->approved = true;
	$obj->favorite_count = 1;
	$obj->status = NULL;
	echo json_encode($obj);
}

echo $_server[self];

?>
<title>测试</title>
