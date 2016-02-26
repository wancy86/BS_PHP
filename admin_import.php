<?php
require_once 'lib/mysql.func.php';
require_once 'lib/PHPExcel.php';
require_once 'lib/PHPExcel/IOFactory.php';
require_once 'lib/PHPExcel/Reader/Excel5.php';
// require_once 'lib/PHPExcel/Reader/Excel2007.php';

header("Content-type: text/html; charset=utf-8");

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
    move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/proInfo.xls");
    // . $_FILES["file"]["name"]);
    // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    // $excelpath = "uploads/" . $_FILES["file"]["name"];
    $excelpath = "./uploads/proInfo.xls";
}

// 2.读取临时目录的文件
$objReader = PHPExcel_IOFactory::createReader('Excel5'); // use Excel5 for 2003 format
$objPHPExcel = $objReader->load($excelpath);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow(); // 取得总行数
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
                                             
// 3.开始导入数据
$link = mysqli_connect("127.0.0.1", "root", "111222", "BoyStyle", '3306') or die("unable to connect");
mysqli_set_charset($link, "utf8");
mysqli_query($link, "SET NAMES utf8");

// 4.循环读取插入数据
for ($j = 2; $j <= $highestRow; $j ++) // 从第二行开始读取数据
{
    $str = "";
    // 从A列读取数据
    for ($k = 'A'; $k <= $highestColumn; $k ++) {
        // 读取单元格
        $str .= $objPHPExcel->getActiveSheet()
            ->getCell("$k$j")
            ->getValue() . '|*|';
    }
    // TODO 修改编码
    $str = mb_convert_encoding($str, 'utf-8', 'auto');
    $strs = explode("|*|", $str);
    if ($strs == '') {
        echo "empty line...<br/>";
        continue;
    }
    
    // url, price, commission, earn, back_BB, title, img_url, img_list, show_order, category, entrydate
    $sql = "REPLACE INTO BS_ProInfo (pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url)";
    $sql .= " values ({$strs[0]},'{$strs[1]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}','{$strs[9]}','{$strs[10]}')";
    
    // echo $sql;
    // echo "<br/><br/>";
    
    // $sql = iconv("GBK","UTF-8",$sql);
    // $sql = "REPLACE INTO BS_ProInfo (pro_id, title) values(123123,'test')";
    // 直接UTF-8输入也是乱码，断定应该是设置问题
    // $sql= "REPLACE INTO BS_ProInfo (pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url) VALUES (522719735988, '2016新春秋连衣裙韩版女装长袖优雅冬打底裙修身OL包臀裙名媛短裙', 'http://img02.taobaocdn.com/bao/uploaded/i2/TB1mD7dLpXXXXbzXpXXXXXXXXXX_!!0-item_pic.jpg', 'http://item.taobao.com/item.htm?id=522719735988', '至简元素旗舰店', '239.00', '1023', '6.00', '至简元素旗舰店', 'http://s.click.taobao.com/YRSyhbx', 'http://s.click.taobao.com/t?e=m%3D2%26s%3Dvchsux4qjBUcQipKwQzePOeEDrYVVa64K7Vc7tFgwiHjf2vlNIV67t46HpQZEv2b%2Fl0%2B1yuzCtJOg2r8NdThQAD%2F0NtdZ9kyH9QiDT32gnJJPVbpKpZHQW7cYsqSGzZdI%2BHoIeFFznF6NW3gs6fWeMYMXU3NNCg%2F&pvid=11_61.141.137.74_320_1456488847374')";
    
    mysqli_query($link, "SET NAMES utf8");
    mysqli_query($link, $sql);
}

// 1.redirect
// header('Location: http://localhost/boystyle/admin_add.php');.
// exit();
// 2.redirect
echo "<script>window.location.href='http://localhost/boystyle/admin_add.php';alert('导入成功');</script>";




