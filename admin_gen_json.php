<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
require_once './lib/FileUtil.php';

// 获取项目目录
preg_match('/^\/\w*\//', $_SERVER['PHP_SELF'], $webname);
$web_name = str_replace('/', '', $webname[0]);

// 遍历目录
// $cats = 'ALL';
if (isset($_POST['category'])) {
	$cats = "'" . join("','", $_POST['category']) . "'";
}

// echo $cats;
$query = "select distinct category from BS_Category";
// strpos 返回字符串在另一字符串中第一次出现的位置，如果没有找到字符串则返回 FALSE。
if (strpos($cats, 'ALL')) {
	$query .= " where category in($cats)";
}

// echo "$query";
$result = mysqli_query(connect(), $query);

while (@$category = mysqli_fetch_assoc($result)) {
	$cat = $category['category'];
	$query2 = " select count(0) as TotalRowsNum";
	$query2 .= " from BS_ProInfo as A";
	$query2 .= " join BS_category as C on A.cat_id=C.cat_id";
	$query2 .= " where A.disabled=0 and C.category ='$cat'";
	// echo $query2;
	// echo "<br>";
	$result2 = mysqli_query(connect(), $query2);

	$row = mysqli_fetch_assoc($result2);

	$TotalRowsNum = $row["TotalRowsNum"];
	// loop to create the JSON
	$start = 1;
	$load_order = 1;
	for ($end = 48; $end < $TotalRowsNum; $end += 48) {
		$filename = strtoupper(substr(md5($cat), 8, 16)) . "_" . $start . "_" . "$end" . ".json";
		$file_Path = $_SERVER['DOCUMENT_ROOT'] . "/$web_name/data/" . $filename;
		// echo $filename;
		SaveJsonData($cat, $start, $end, $file_Path);
		SaveFileNameToDB($cat, $load_order, $end - $start + 1, $filename);
		$start = $end + 1;
		$load_order += 1;
	}
}

// 按类别保存生产的文件到数据库
function SaveFileNameToDB($category, $load_order, $data_rows, $filename) {
	$query = "replace into BS_JSON(category ,load_order ,data_rows ,file_name)";
	$query .= "values('$category' ,$load_order ,$data_rows ,'$filename')";
	// echo $query;
	mysqli_query(connect(), $query);

	$query = "update BS_JSON set entry_date=now() where file_name='$filename'";
	mysqli_query(connect(), $query);
}

// 从数据表查询数据并生成json文件
function SaveJsonData($category, $start, $end, $file_Path) {
	$rows = array();
	$query2 = " select pro_id ,title ,img_url ,detail_url ,shop_name ,price ,month_sold ,comm_percent ,seller_ww ,back_BB ,";
	$query2 .= " short_tbk_url ,tbk_url ,commission ,earn ,img_list ,show_order ,P.cat_id ,entrydate ,disabled ";
	$query2 .= " from BS_ProInfo AS P";
	$query2 .= " join BS_Category as C on P.cat_id=C.cat_id";
	$query2 .= " where P.disabled=0 and C.category ='$category'";
	$query2 .= " limit $start, $end";

	// echo $query2;
	// exit();

	$result2 = mysqli_query(connect(), $query2);
	while (@$row = mysqli_fetch_assoc($result2)) {
		$rows[] = $row;
	}
	//random order
	shuffle($rows);

	// echo $filename;
	// echo $query2;
	// echo "<br>";

	if (!file_exists($file_Path)) {
		// 文件所在目录
		// echo dirname($json_path);
		// mkdir($json_path, 0777);
		FileUtil::createFile($file_Path);
	}
	// 修改文件权限为读写可执行
	// Read 4 - 允许读文件
	// Write 2 - 允许写/修改文件
	// eXecute1 - 读/写/删除/修改/目录
	chmod($file_Path, 0777);
	file_put_contents($file_Path, json_encode($rows));
}

AlertMessage("admin_tab.php", "JSON数据文件生成完成", "");
