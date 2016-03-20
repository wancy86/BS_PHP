<?php
require_once 'lib/mysql.func.php';
session_start();
$uid = $_SESSION['uid'];

$query = " select A.order_id, A.uid,";
$query .= " IFNULL(B.pro_id,'') as pro_id,";
$query .= " IFNULL(B.title,'') as title,";
$query .= " IFNULL(B.seller_ww,'') as seller_ww,";
$query .= " IFNULL(B.shop_name,'') as shop_name,";
$query .= " IFNULL(B.pro_number,'') as pro_number,";
$query .= " IFNULL(B.price,'') as price,";
$query .= " IFNULL(B.order_status,'') as order_status,";
$query .= " IFNULL(B.totalcomm_percent,'') as totalcomm_percent,";
$query .= " IFNULL(B.share_percent,'') as share_percent,";
$query .= " IFNULL(B.paid_amount,'') as paid_amount,";
$query .= " IFNULL(B.earn_preview,'') as earn_preview,";
$query .= " IFNULL(B.price_real,'') as price_real,";
$query .= " IFNULL(B.earn_inplan,'0')*0.5 as earn_inplan,";
$query .= " IFNULL(B.paid_date,'') as paid_date,";
$query .= " IFNULL(B.comm_percent,'0')*0.5 as comm_percent,";
$query .= " IFNULL(B.commission,'') as commission,";
$query .= " IFNULL(B.butie_percent,'') as butie_percent,";
$query .= " IFNULL(B.butie_amount,'') as butie_amount,";
$query .= " IFNULL(B.butie_type,'') as butie_type,";
$query .= " IFNULL(B.platform,'') as platform,";
$query .= " IFNULL(B.thrid_server,'') as thrid_server,";
$query .= " IFNULL(B.category,'') as category,";
$query .= " IFNULL(B.ad_holder,'') as ad_holder,";
$query .= " IFNULL(B.entry_date,'') as entry_date";
$query .= " from BS_UserOrder as A ";
$query .= " left join BS_Order as B on A.order_id=B.order_id";
$query .= " where A.uid=$uid";

// echo "$query";
$result = mysqli_query(connect(), $query);
$orders = array();
while (@$row = mysqli_fetch_assoc($result)) {
	$orders[] = $row;
}
// print_r($orders);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BoyStyle</title>
        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-fluid">
            <?php require_once 'header.php';?>
            <div class="row">
                <div class="col-md-12">
                    <h3> 订单列表 </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form class="navbar-form navbar-left" role="search" style="padding-left:0px;">
                        <div class="form-group">
                            <input type="text" class="form-control" id="order_id" name="order_id" placeholder="订单号码">
                        </div>
                        <button type="button" class="btn btn-success" onclick="SearchUserOrder(this, <?php echo " $uid "; ?>)">
                            查询订单 >>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover">
                        <colgroup>
                            <col class="span1">
                            <col class="span7">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>订单号</th>
                                <th>商品描述</th>
                                <th>成交价格</th>
                                <th>订单状态</th>
                                <th>预计返利</th>
                                <th>返利状态</th>
                                <th>订单日期</th>
                                <th>计算日期</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;foreach ($orders as $order) {
	echo <<<ORDER_EOD
						<tr>
                            <td>
                                $index
                            </td>
                            <td>
                                $order[order_id]
                            </td>
                            <td>
                                $order[title]
                            </td>
                            <td>
                                $order[paid_amount]
                            </td>
                            <td>
                                $order[order_status]
                            </td>
                            <td>
                                $order[earn_inplan]
                            </td>
                            <td>
                                 待结算
                            </td>
                            <td>
                                $order[paid_date]
                            </td>
                            <td>
                                $order[entry_date]
                            </td>
                            <td>
								<a href="#" onclick="DeleteUserOrder(this,$order[uid],$order[order_id])">删除</a>
                            </td>
                        </tr>
ORDER_EOD;
	$index++;
}
?>
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <ul class="pagination">
                            <li>
                                <a href="#">Prev</a>
                            </li>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php require_once "footer.php";?>
        </div>
        <?php require_once 'script.php';?>
        <script>
        function SearchUserOrder(obj, uid) {
            //查询用户订单，没有记录则添加记录
            $.ajax({
                url: "admin_ajax.php",
                data: {
                    uid: uid,
                    action: "search",
                    order_id: $("#order_id").val()
                },
                success: function(data) {
                    //删除页面的DOM TR, 或者刷新列表
                    console.log(data);
                }
            });
        }

        function DeleteUserOrder(obj, uid, order_id) {
            //删除用户订单
            $.ajax({
                url: "admin_ajax.php",
                data: {
                    uid: uid,
                    action: "del",
                    order_id: order_id
                },
                success: function(data) {
                    //删除页面的DOM TR, 或者刷新列表
                    console.log(data);
                }
            });
        }
        </script>
    </body>

    </html>
