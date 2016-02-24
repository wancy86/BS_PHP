<?php
require_once 'lib/mysql.func.php';
require_once 'lib/PHPExcel.php';
require_once 'lib/PHPExcel/IOFactory.php';
require_once 'lib/PHPExcel/Reader/Excel5.php';

//1.将上传的文件保存到临时目录
$excelpath = 'myexcel.xlsx';
if ($_FILES["file"]["error"] > 0)
{
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
  // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  // echo "Type: " . $_FILES["file"]["type"] . "<br />";
  // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  // echo "Stored in: " . $_FILES["file"]["tmp_name"];

  move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);
  // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
  $excelpath = "uploads/" . $_FILES["file"]["name"];
}

//2.读取临时目录的文件
$objReader = PHPExcel_IOFactory::createReader('excel2007'); //use Excel5 for 2003 format 
$objPHPExcel = $objReader->load($excelpath); 
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow();//取得总行数 
$highestColumn = $sheet->getHighestColumn(); //取得总列数

//3.开始导入数据
for($j=2;$j<=$highestRow;$j++)//从第二行开始读取数据
{   
  $str="";
  for($k='A';$k<=$highestColumn;$k++)//从A列读取数据
  { 
     $str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
  }
  $str=mb_convert_encoding($str,'GBK','auto');//根据自己编码修改
  $strs = explode("|*|",$str);
  // echo $str . "<br />";
  // url, price, commission, earn, back_BB, title, img_url, img_list, show_order, category, entrydate
  $sql = "insert into BS_ProInfo (url, price, commission, earn, back_BB, title, img_url, img_list, show_order, category, entrydate)";
  $sql .=" values ('{$strs[0]}','{$strs[1]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}','{$strs[9]}','{$strs[10]}')";

  //echo $sql;
  if(!mysql_query($sql,connect()))
  {
    echo 'excel err';
  }  
}

echo '导入成功.<br/>';



