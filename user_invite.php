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


uid
account
email
phone
pwd
invite_code
invite_by
reg_date
taobao_account

$query="";
$query .="select";
$query .="    account,";
$query .="    email,";
$query .="    reg_date";
$query .="from BS_User";
$query .="where invite_by=$uid";

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
$invites = array();
while (@$row = mysqli_fetch_assoc($result)) {
	$invites[] = $row;
}
// print_r($invites);
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
                    <h3>  邀请注册成员 <small> - 通过你的邀请链接成功注册的成员，他们将为你创造佣金</small></h3> <span></span>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mainform">
                    <div class="tabbable" id="tabs-1">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#panel-1" data-toggle="tab">邀请注册成员</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- 邀请注册成员 -->
                            <div class="tab-pane active" id="panel-1">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <h2>邀请注册成员</h2>
                                        <hr>
                                        <form class="navbar-form navbar-left" role="search" style="padding-left:0px;">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="order_id" name="order_id" placeholder="输入成员注册邮箱">
                                            </div>
                                            <button type="button" class="btn btn-success" onclick="SearchUserOrder(this, <?php echo " $uid "; ?>)">
                                                <span class="glyphicon glyphicon-search"></span> 查询成员
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="SearchUserOrder(this, <?php echo " $uid "; ?>,1)">
                                                <span class="glyphicon glyphicon-search"></span> 全部成员
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
                                                    <th>账号</th>
                                                    <th>注册邮箱</th>
                                                    <th>注册时间</th>
                                                    <th>最近登录</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $index = 1;foreach ($invites as $order) {
	echo <<<ORDER_EOD
                                            <tr>
                                                <td>
                                                    $index
                                                </td>
                                                <td>
                                                    $order[account]
                                                </td>
                                                <td>
                                                    $order[email]
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
        
        </script>
    </body>

    </html>
