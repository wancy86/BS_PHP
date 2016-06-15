<?php
header("Content-type: text/html; charset=utf-8");
require_once 'lib/mysql.func.php';

$pro_id = $_GET['pro_id'];
// echo $pro_id;
$query = " select pro_id ,title ,img_url ,detail_url ,shop_name ,price ,month_sold ,comm_percent ,seller_ww ,back_BB ,";
$query .= " short_tbk_url ,tbk_url ,commission ,earn ,img_list ,show_order ,P.cat_id ,entrydate ,disabled ";
$query .= " from BS_ProInfo AS P";
$query .= " join BS_Category as C on P.cat_id=C.cat_id";
$query .= " where P.pro_id=$pro_id";

$result = mysqli_query(connect(), $query);
// var_dump($result);
// echo "<hr>";
$item = '';
if ($result) {
	$item = mysqli_fetch_assoc($result);
}
?>
    <html>

    <head>
        <title>BoyStyle</title>
        <?php require_once 'style.php';?>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div id="content" class="col-md-4 col-md-offset-4">
                            <div class="thumbnail">
                                <?php if ($result) {?>
                                <a class="pro" href="javascript:void(0);" pro_id="<?php echo $item['pro_id']; ?>" url="<?php echo $item['detail_url']; ?>" target="_blank"><img alt="<?php echo $item['detail_url']; ?>" src="<?php echo $item['img_url']; ?>"></a>
                                <div class="caption">
                                    <h3><?php echo $item['title']; ?></h3>
                                    <p> 价格: ￥
                                        <?php echo $item['price'] ?> / 返利:
                                        <?php echo $item['back_BB'] ?> BB / 月销量:
                                        <?php echo $item['month_sold'] ?> </p>
                                    <p> <a class="btn btn-danger pro" href="javascript:void(0);" pro_id="<?php echo $item['pro_id']; ?>" url="<?php echo $item['detail_url']; ?>" target="_blank">去看看</a>
                                        <button tabindex="0" onclick="AddFavorite(this, <?php echo $item['pro_id']; ?>)" class="btn"><span class="glyphicon glyphicon-heart-empty"></span> 添加收藏</button>
                                    </p>
                                </div>
                                <?php } else {?>
                                <?php header("location:/index.php");?>
                                <?php }?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php require_once 'script.php';?>
    </body>

    </html>
