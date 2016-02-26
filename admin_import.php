<?php
require_once 'lib/mysql.func.php';
require_once 'lib/PHPExcel.php';
require_once 'lib/PHPExcel/IOFactory.php';
require_once 'lib/PHPExcel/Reader/Excel5.php';
//require_once 'lib/PHPExcel/Reader/Excel2007.php';

header("Content-type: text/html; charset=utf-8");

//1.将上传的文件保存到临时目录
$excelpath = '';
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
  // 

  echo $_FILES["file"]["tmp_name"];
  echo "<br/>";
  echo "uploads/" . $_FILES["file"]["name"];
  echo "<br/>";
    
  //iconv("gbk","utf8",$_FILES["file"]["tmp_name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/proInfo.xls");// . $_FILES["file"]["name"]);
  // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
  //$excelpath = "uploads/" . $_FILES["file"]["name"];
  $excelpath = "./uploads/proInfo.xls";
}

//2.读取临时目录的文件
$objReader = PHPExcel_IOFactory::createReader('Excel5'); //use Excel5 for 2003 format 
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
  //TODO 修改编码
  $str=mb_convert_encoding($str,'utf-8','auto');
  $strs = explode("|*|",$str);
  if($strs=='')
  {
      echo "empty line...<br/>";
      continue;
  }
  // echo $str . "<br />";
  // url, price, commission, earn, back_BB, title, img_url, img_list, show_order, category, entrydate
  $sql = "REPLACE INTO BS_ProInfo (pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url)";
  $sql .=" values ({$strs[0]},'{$strs[1]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}','{$strs[9]}','{$strs[10]}');";

  echo $sql;
  echo "<br/>";
  
  $sql = iconv("GB2312//TRANSLIT","UTF-8",$sql);
  $link=mysqli_connect("127.0.0.1","root","111222","BoyStyle",'3306');
  mysqli_set_charset($link, "utf8");
  mysqli_query($link,"SET NAMES UTF8");  
  if(!mysqli_query($link,$sql))
  {
    echo 'SQL Error, INSERT ERROR...';
    echo $sql;
    echo "<br/>";
  }
  else
  {
      //echo "插入一条数据...";
      echo "<br/>";
  }
}

echo '导入成功.<br/>';



