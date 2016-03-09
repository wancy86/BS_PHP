<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/FileUtil.php';

// [PHP_SELF] => /boystyle/index.php
preg_match('/^\/\w*\//', $_SERVER['PHP_SELF'], $webname);
$pro_name = str_replace('/', '', $webname[0]);

// 101 潮装 T恤 男神 - T恤
// 102 潮装 裤子 男神 - 裤子
// 103 潮装 衬衣 男神 - 衬衣
// 104 鞋子 运动鞋 男神 - 运动鞋
// 105 鞋子 皮鞋 男神 - 皮鞋
// 106 鞋子 板鞋 男神 - 板鞋
// 201 送女友 连衣裙春夏 女神 - 连衣裙春夏
// 202 送女友 短裙 女神 - 短裙
// 203 送女友 饰品 女神 - 饰品
// 204 送女友 单鞋 女神 - 单鞋
// 205 送女友 凉鞋 女神 - 凉鞋
// 206 送女友 高跟鞋 女神 - 高跟鞋
// 207 送女友 丝袜 女神 - 丝袜
// 208 送女友 文胸 女神 - 文胸
// 209 送女友 内裤 女神 - 内裤
// 210 送女友 包包 女神 - 包包
// 211 送女友 护肤 女神 - 护肤
// 212 送女友 化妆品 女神 - 化妆品
// 301 小屁孩 小衣服 小屁孩 - 小衣服
// 302 小屁孩 小裤子 小屁孩 - 小裤子
// 401 品质生活 其他 品质生活 - 其他
// 402 品质生活 电子产品 品质生活 - 电子产品
// 501 趣玩 趣玩 趣玩
// 601 美食 美食 美食

// http://localhost/boystyle/index.php/501.HTML
// 请求URL必须是path_info的模式
// echo $_SERVER["PATH_INFO"];
$cat_id = '';
$json_path = '';
if (isset($_SERVER["PATH_INFO"])) {
	if (preg_match('/^(\/\d{3})+.html/i', $_SERVER["PATH_INFO"], $arr)) {
		// print_r($arr[0]);
		$cat_id = $arr[0];
		$cat_id = str_replace('/', ',', $cat_id);
		// 不区分大小写替换
		$cat_id = str_ireplace('.html', '', $cat_id);
		$cat_id = substr($cat_id, 1);
		// echo $cat_id;

		$json_path = str_replace(',', '_', $cat_id);
		$json_path = $_SERVER['DOCUMENT_ROOT'] . "/$pro_name/data/" . $json_path . '.json';
		// echo $json_path;
	}
}

$query = " select pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url";
$query .= " from BS_ProInfo as A ";
$query .= " join BS_Category as B on A.cat_id=B.cat_id ";
$query .= " where A.disabled=0";
if ($cat_id != '') {
	$query .= " and B.cat_id in($cat_id)";
}
$query .= " order by A.pro_id";
$query .= " limit 0, 20";

$result = mysqli_query(connect(), $query);
$rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="images/bs.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/bs.ico" type="image/x-icon" />

<title>BoyStyle</title>

<meta name="description"
	content="Source code generated using layoutit.com">
<meta name="author" content="LayoutIt!">
<?php
echo "<link href='/$pro_name/css/bootstrap.min.css' rel='stylesheet'>";
echo "<link href='/$pro_name/css/style.css' rel='stylesheet'>";
?>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!--navbar-->
				<?php require_once 'header.php';?>
			</div>
		</div>
		<!--content-->
		<div class="row">
			<div class="col-md-12" id="content">
			</div>
		</div>
		<!--footer-->
		<?php require_once 'footer.php';?>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function() {
			RenderJSON("/boystyle/data/BFF7A6473FF23C3C_1_50.json");
			// RenderJSON("/boystyle/data/BFF7A6473FF23C3C_51_150.json");

			var JSONList=[];
<?php
$query = " select category,load_order,Data_rows,File_Name from BS_JSON";
$query .= " order by category, load_order";
$result = mysqli_query(connect(), $query);
while ($row = mysqli_fetch_assoc($result)) {
	echo <<<JSON_List
	JSONList.push({
		category:'$row[category]',
		load_order:'$row[load_order]',
		Data_rows:'$row[Data_rows]',
		File_Name:'$row[File_Name]'
	});
JSON_List;
}
?>
			$("#content").data("JSONList",JSONList);
		});
	</script>

</body>
</html>