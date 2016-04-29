<?php
require_once 'lib/mysql.func.php';
require_once 'lib/PHPExcel.php';
require_once 'lib/PHPExcel/IOFactory.php';
require_once 'lib/PHPExcel/Reader/Excel5.php';
// require_once 'lib/PHPExcel/Reader/Excel2007.php';

header("Content-type: text/html; charset=utf-8");

//0.数据导入类型, prodata-商品数据, orderdata-订单数据
$datatype = isset($_POST['datatype']) ? $_POST['datatype'] : "prodata";

// 获取类别
$cat_id = isset($_POST["cat_id"]) ? $_POST["cat_id"] : "101";

// 1.将上传的文件保存到临时目录
$excelpath = '';
if ($_FILES["file"]["error"] > 0) {
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
} else {
	// echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	// echo "Type: " . $_FILES["file"]["type"] . "<br />";
	// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	// echo "Stored in: " . $_FILES["file"]["tmp_name"];

	// echo $_FILES["file"]["tmp_name"];
	// echo "<br/>";
	// echo "uploads/" . $_FILES["file"]["name"];
	// echo "<br/>";

	// iconv("gbk","utf8",$_FILES["file"]["tmp_name"]);
	move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/temp.xls");
	// . $_FILES["file"]["name"]);
	// echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	// $excelpath = "uploads/" . $_FILES["file"]["name"];
	$excelpath = "./uploads/temp.xls";
}

// 2.读取临时目录的文件
// use Excel5 for 2003 format
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load($excelpath);
$sheet = $objPHPExcel->getSheet(0);
// 取得总行数
$highestRow = $sheet->getHighestRow();
// 取得总列数
$highestColumn = $sheet->getHighestColumn();

// 3.开始导入数据
// $link = mysqli_connect("127.0.0.1", "root", "111222", "BoyStyle", '3306') or die("unable to connect");
$link = connect();
mysqli_set_charset($link, "utf8");
mysqli_query($link, "SET NAMES utf8");

//导入商品信息
if ($datatype == 'prodata') {
	// 4.循环读取插入数据
	// 从第二行开始读取数据
	for ($j = 2; $j <= $highestRow; $j++) {
		$str = "";
		// 从A列读取数据
		for ($k = 'A'; $k <= $highestColumn; $k++) {
			// 读取单元格
			$str .= $objPHPExcel->getActiveSheet()
				->getCell("$k$j")
				->getValue() . '|*|';
		}
		// 修改编码
		$str = mb_convert_encoding($str, 'utf-8', 'auto');
		$strs = explode("|*|", $str);
		if ($strs == '') {
			continue;
		}

		// url, price, commission, earn, back_BB, title, img_url, img_list, show_order, category, entrydate
		$sql = "REPLACE INTO BS_ProInfo (pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url,cat_id)";
		$sql .= " values ({$strs[0]},'{$strs[1]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}','{$strs[9]}','{$strs[10]}',$cat_id)";

		mysqli_query($link, "SET NAMES utf8");
		mysqli_query($link, $sql);
	}

	//update commission
	$sql = "update BS_Proinfo set commission=truncate(round(price*comm_percent/100.0,2),2) where commission is null";
	mysqli_query($link, $sql);

}
//导入订单信息
if ($datatype == 'orderdata') {
	// 4.循环读取插入数据
	// 从第二行开始读取数据
	for ($j = 2; $j <= $highestRow; $j++) {
		$str = "";
		// 从A列读取数据
		for ($k = 'A'; $k <= $highestColumn; $k++) {
			// 读取单元格
			$str .= $objPHPExcel->getActiveSheet()
				->getCell("$k$j")
				->getValue() . '|*|';
		}
		// 修改编码
		$str = mb_convert_encoding($str, 'utf-8', 'auto');
		$strs = explode("|*|", $str);
		if ($strs == '') {
			continue;
		}

		// url, price, commission, earn, back_BB, title, img_url, img_list, show_order, category, entrydate
		$sql = "REPLACE INTO BS_Order (order_id ,pro_id ,title ,seller_ww ,shop_name ,pro_number ,price ,order_status ,totalcomm_percent ,share_percent ,paid_amount ,earn_preview ,price_real,earn_inplan ,paid_date ,comm_percent ,commission ,butie_percent ,butie_amount ,butie_type ,platform ,thrid_server ,category ,ad_holder ,entry_date)";
		$sql .= " values ('$strs[22]', '$strs[2]', '$strs[1]', '$strs[3]', '$strs[4]', '$strs[5]', '$strs[6]', '$strs[7]', '$strs[8]', '$strs[9]', '$strs[10]', '$strs[11]', '$strs[12]', '$strs[13]', '$strs[14]', '$strs[15]', '$strs[16]', '$strs[17]', '$strs[18]', '$strs[19]', '$strs[20]', '$strs[21]', '$strs[23]', '$strs[24]', '$strs[0]')";

		echo "$sql";
		echo "<br>";
		mysqli_query($link, "SET NAMES utf8");
		mysqli_query($link, $sql);
	}
}

// 1.redirect
// header('Location: http://localhost/boystyle/admin_data.php');.
// exit();
// 2.redirect
echo "<script>window.location.href='http://localhost/boystyle/admin_data.php';alert('导入成功');</script>";
