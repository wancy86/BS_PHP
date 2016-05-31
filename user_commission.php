<?php
require_once 'lib/mysql.func.php';
require_once "lib/page.func.php";

session_start();
$uid = $_SESSION['uid'];
$order_id=isset($_GET['order_id'])? $_GET['order_id']:'';
$del_oid=isset($_GET['del_oid'])? $_GET['del_oid']:'';

// echo "$order_id";

//先插入数据
if($order_id!=''){
    $query = "replace into BS_UserOrder(order_id,uid) values($order_id,$uid)";
    $result = mysqli_query(connect(), $query);
}elseif ($del_oid !='') {
    $query = "delete from BS_UserOrder where uid=$uid and order_id=$del_oid";
    $result = mysqli_query(connect(), $query);
}

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
if($order_id!=''){
    $query .= " and A.order_id=$order_id";
}

// echo $query;

// get the total records
$query2 .= "select count(0) as totalrecords from BS_UserOrder as A ";
$query2 .= " left join BS_Order as B on A.order_id=B.order_id";
$query2 .= " where A.uid=$uid";
$result = mysqli_query(connect(), $query2);
$totalrecords = (mysqli_fetch_assoc($result));
// echo $totalrecords['totalrecords'];
$totalrecords = $totalrecords['totalrecords'];

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
        <title>BoyStyle</title>
        <?php require_once 'style.php';?>
    </head>

    <body>
        <div class="container-fluid">
            <?php require_once 'header.php';?>
            <div class="row">
                <div class="col-md-12">
                    <h3>  结算中心 </h3> <span></span>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mainform">
                    <div class="tabbable" id="tabs-1">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#panel-1" data-toggle="tab">待结算订单</a>
                            </li>
                            <!-- <li>
                                <a href="#panel-2" data-toggle="tab">未关联订单</a>
                            </li>
                            <li>
                                <a href="#panel-3" data-toggle="tab">已结算订单</a>
                            </li>
                            <li>
                                <a href="#panel-4" data-toggle="tab">收入报表</a>
                            </li>
                            <li>
                                <a href="#panel-5" data-toggle="tab">邀请佣金收入</a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <!-- 待结算订单 -->
                            <div class="tab-pane active" id="panel-1">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <h2>待结算订单</h2>
                                        <hr>
                                        <form class="navbar-form navbar-left" role="search" style="padding-left:0px;">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="order_id" name="order_id" placeholder="输入订单号码">
                                            </div>
                                            <button type="button" class="btn btn-success" onclick="SearchUserOrder(this, <?php echo " $uid "; ?>)">
                                                <span class="glyphicon glyphicon-search"></span> 查询订单
                                            </button>
                                        </form>
                                    </div>
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
                                        <div class="col-md-12" id="pagebar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 未关联订单 -->
                            <div class="tab-pane" id="panel-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>未关联订单</h3>
                                    </div>

                                </div>
                            </div>
                            <!-- 已结算订单 -->
                            <div class="tab-pane" id="panel-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>已结算订单</h3>
                                    </div>

                                </div>
                            </div>
                            <!-- 收入报表 -->
                            <div class="tab-pane" id="panel-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>收入报表</h3>
                                    </div>

                                </div>
                            </div>
                            <!-- 邀请佣金收入 -->
                            <div class="tab-pane" id="panel-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>邀请佣金收入</h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--  end tab -->
                </div>
            </div>

            <?php require_once "footer.php";?>
        </div>
        <?php require_once 'script.php';?>
        <script>
        function SearchUserOrder(obj, uid) {
            //查询用户订单，没有记录则添加记录
            window.location.href="/boystyle/user_commission.php?order_id="+$("#order_id").val();
            // $.ajax({
            //     url: "commission_action.php",
            //     data: {
            //         uid: uid,
            //         action: "search_order",
            //         order_id: $("#order_id").val()
            //     },
            //     success: function(data) {
            //         //删除页面的DOM TR, 或者刷新列表
            //         console.log(data);
            //     }
            // });
        }

        function DeleteUserOrder(obj, uid, order_id) {
            //删除用户订单
            //del_oid
            if(confirm("确认删除订单信息吗？")){
                window.location.href="/boystyle/user_commission.php?del_oid="+order_id;
            }
            // $.ajax({
            //     url: "commission_action.php",
            //     data: {
            //         uid: uid,
            //         action: "del",
            //         order_id: order_id
            //     },
            //     success: function(data) {
            //         //删除页面的DOM TR, 或者刷新列表
            //         console.log(data);
            //     }
            // });
        }

        $(function  (){
            $('#pagebar').html(ShowBSPage(<?php echo $totalrecords ?>,1));
        });
        </script>
    </body>

    </html>
