<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/FileUtil.php';

// 获取项目目录
preg_match('/^\/\w*\//', $_SERVER['PHP_SELF'], $webname);
$web_name = str_replace('/', '', $webname[0]);

//遍历目录
$cats = "'" . join("','", $_POST['category']) . "'";
$query = "select distinct category from BS_Category";
if (strpos($cats, 'ALL') == 0) {
    $query .= " where category in($cats)";
}
echo "$query";
$result = mysqli_query(connect(), $query);
while (@$category = mysql_fetch_assoc($result)) {
    echo 
    $query = "select count(0) as TotalRowsNum from BS_ProInfo as A where A.disabled=0 and C.category ='$category'";
    $result = mysqli_query(connect(), $query);
    $row = (mysql_fetch_assoc($result));
    $TotalRowsNum = $row["TotalRowsNum"];
    //loop to create the JSON
    $start = 1;
    for($end=50;$end<$TotalRowsNum;$end+=100)
    {
        SaveJsonData($web_name, $category, $start, $end);
        $start = $end+1;
        echo $end;
    }
}

// 从数据表查询数据并生成json文件
function SaveJsonData($web_name, $category, $start, $end)
{
    $rows = array();
    $query2 = " select pro_id ,title ,img_url ,detail_url ,shop_name ,price ,month_sold ,comm_percent ,seller_ww ,back_BB ,";
    $query2 .= " short_tbk_url ,tbk_url ,commission ,earn ,img_list ,show_order ,cat_id ,entrydate ,disabled ";
    $query2 .= " from BS_ProInfo AS P";
    $query2 .= " join BS_Category as C on P.cat_id=C.cat_id";
    $query2 .= " where A.disabled=0 and C.category ='$category'";
    $query2 .= " limit $start, $end";
    
    $result2 = mysqli_query(connect(), $query2);
    while (@$row = mysql_fetch_assoc($result2)) {
        $rows[] = $row;
    }
    $filename = $_SERVER['DOCUMENT_ROOT'] . "/$web_name/data/" . "" . $category . "$start" . "$end" . ".json";
    
    echo $filename;
    echo "<br>";
    
    if (! file_exists($filename)) {
        // 文件所在目录
        // echo dirname($json_path);
        // mkdir($json_path, 0777);
        FileUtil::createFile($filename);
    }
    // 修改文件权限为读写可执行
    // Read 4 - 允许读文件
    // Write 2 - 允许写/修改文件
    // eXecute1 - 读/写/删除/修改/目录
    chmod($filename, 0777);
    file_put_contents($filename, json_encode($rows));
    
}

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
        $json_path = $_SERVER['DOCUMENT_ROOT'] . "/$web_name/data/" . $json_path . '.json';
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
$query .= " limit 0, 100";

$result = mysqli_query(connect(), $query);
$rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

if ($json_path != '') {
    // 数据格式化为json
    $index_json = json_encode($rows);
    // echo json_encode($index_json);
    // 保存到文件
    if (! file_exists($json_path)) {
        // 文件所在目录
        // echo dirname($json_path);
        // mkdir($json_path, 0777);
        FileUtil::createFile($json_path);
    }
    // 修改文件权限为读写可执行
    // Read 4 - 允许读文件
    // Write 2 - 允许写/修改文件
    // eXecute1 - 读/写/删除/修改/目录
    chmod($json_path, 0777);
    file_put_contents($json_path, $index_json);
}
// 1.redirect
// header('Location: http://localhost/boystyle/admin_add.php');.
// exit();
// 2.redirect
// echo "<script>window.location.href='http://localhost/boystyle/admin_add.php';alert('导入成功');</script>";

?>