<?php
header("Content-type: text/html; charset=utf-8");

// require_once './lib/send_email.php';
// // sendemail($receivers, $subject, $contents)
// //

// // 这个好像是UTC时间，少8小时
// echo date("Y/m/d/ H:i:s a");

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

//test the paging
// require_once "lib/page.func.php";
// echo showBSPage(102);

// require_once './lib/Logs.php';
// addLog(446456546);

//test--------------------------------------
//http://phpqrcode.sourceforge.net/examples/index.php
require_once './lib/phpqrcode/qrlib.php';
// require_once './lib/phpqrcode/qrconfig.php';
// outputs image directly into browser, as PNG stream
// how to configure pixel "zoom" factor

define('EXAMPLE_TMP_URLRELPATH', './images/qrcode');
$tempDir = EXAMPLE_TMP_URLRELPATH;

//要编码的内容
$codeContents = 'http://phpqrcode.sourceforge.net/examples/index.php';

// generating
QRcode::png($codeContents, $tempDir . '007_1.png', QR_ECLEVEL_L, 1);
QRcode::png($codeContents, $tempDir . '007_2.png', QR_ECLEVEL_L, 2);
QRcode::png($codeContents, $tempDir . '007_3.png', QR_ECLEVEL_L, 3);
QRcode::png($codeContents, $tempDir . '007_4.png', QR_ECLEVEL_L, 6);

// displaying
echo '<img src="' . EXAMPLE_TMP_URLRELPATH . '007_1.png" />';
echo '<img src="' . EXAMPLE_TMP_URLRELPATH . '007_2.png" />';
echo '<img src="' . EXAMPLE_TMP_URLRELPATH . '007_3.png" />';
echo '<img src="' . EXAMPLE_TMP_URLRELPATH . '007_4.png" />';

?>