<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/FileUtil.php';

// [PHP_SELF] => /boystyle/index.php
preg_match('/^\/\w*\//', $_SERVER['PHP_SELF'], $webname);
$pro_name = str_replace('/', '', $webname[0]);

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
<style>
	.thumbnail img{
		max-height:428.25px;
		min-height:428.25px;
	}
</style>

<meta name="description" content="Source code generated using layoutit.com">
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

	<?php require_once 'script.php';?>
	<script type="text/javascript">
		$(function() {
			// RenderJSON("/boystyle/data/BFF7A6473FF23C3C_1_50.json");
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
			ScrollPaging();
		});
	</script>

</body>
</html>