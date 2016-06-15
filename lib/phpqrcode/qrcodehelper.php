<?php
// header("Content-type: image/png");
header("Content-type: text/html; charset=utf-8");

//require_once 'lib/phpqrcode/qrcodehelper.php';

require_once 'qrlib.php';
define("QRCODE_PATH", "../../images/QR_CODE/");

function get_invite_login_link($img_path,$uid,$url){
    $img_url="";
    if($uid<>"")
    {
        $qrpath=$img_path;

        $file_name=$qrpath.$uid.'.png';
        $img_url="/images/QR_CODE/".$uid.".png";
        //TODO 文件不存在则生成
        if(!file_exists($filename)){
            $codeContents=$url;
            QRcode::png($codeContents,$file_name,QR_ECLEVEL_L,6);
        }

        // echo '<img src="/images/QR_CODE/007_4.png"/>';
    }
    return $img_url;
}

// test 
///lib/phpqrcode/qrcodehelper.php?fn_test
if(isset($_GET['fn_test'])){
    // echo "二维码图片";
    $img_src= get_invite_login_link(QRCODE_PATH,'1001','/reg.php?invite_by=1');
    echo '<img src="'.$img_src.'"/>';
    exit();
}

// test link
///lib/phpqrcode/qrcodehelper.php?qrtest=1
if(isset($_GET['qrtest'])){
    $qrpath=QRCODE_PATH;

    $codeContents='123123123';
    QRcode::png($codeContents,$qrpath.'007_1.png',QR_ECLEVEL_L,1);
    QRcode::png($codeContents,$qrpath.'007_2.png',QR_ECLEVEL_L,2);
    QRcode::png($codeContents,$qrpath.'007_3.png',QR_ECLEVEL_L,4);
    QRcode::png($codeContents,$qrpath.'007_4.png',QR_ECLEVEL_L,6);

    echo '<img src="/images/QR_CODE/007_1.png"/>';
    echo '<img src="/images/QR_CODE/007_2.png"/>';
    echo '<img src="/images/QR_CODE/007_3.png"/>';
    echo '<img src="/images/QR_CODE/007_4.png"/>';
    exit();
}





?>
