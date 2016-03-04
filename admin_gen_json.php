<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/FileUtil.php';

// 获取项目目录
preg_match('/^\/\w*\//', $_SERVER['PHP_SELF'], $webname);
$web_name = str_replace('/', '', $webname[0]);

// 遍历目录
$cats = "'" . join("','", $_POST['category']) . "'";
$query = "select distinct category from BS_Category";
if (strpos($cats, 'ALL') == 0) {
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
    for ($end = 50; $end < $TotalRowsNum; $end += 100) {
        SaveJsonData($web_name, strtoupper(substr(md5($cat), 8, 16)), $start, $end);
        $start = $end + 1;
        // echo $end;
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
    while (@$row = mysqli_fetch_assoc($result2)) {
        $rows[] = $row;
    }
    $filename = $_SERVER['DOCUMENT_ROOT'] . "/$web_name/data/" . "" . $category . "_" . $start . "_" . "$end" . ".json";
    
    // echo $filename;
    // echo "<br>";
    
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

// 1.redirect
// header('Location: http://localhost/boystyle/admin_add.php');.
// exit();
// 2.redirect
echo "<script>window.location.href='http://localhost/boystyle/admin_add.php';alert('JSON数据文件生成完成');</script>";

?>