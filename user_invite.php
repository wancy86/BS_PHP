<?php
require_once 'lib/mysql.func.php';
require_once "lib/page.func.php";

session_start();
$uid = $_SESSION['uid'];

//if get json list 
if(isset($_GET['getlist']))
{
    $currentpage=(int)(isset($_GET['currentpage'])? $_GET['currentpage']:0);
    $pagesize=(int)(isset($_GET['pagesize'])? $_GET['pagesize']:0);
    $startindex = ($currentpage-1) * $pagesize;
    $startindex = $startindex < 0? 0 : $startindex;
    $endindex = $startindex + $pagesize;

    $query="select count(0) as totalrecords from BS_User where invite_by=$uid"; 
    $result = mysqli_query(connect(), $query);
    $totalrecords= mysqli_fetch_array($result);
    $totalrecords=$totalrecords[0];

    // $jsondata=array();
    // $jsondata['totalrecords']=$totalrecords;

    $query="";
    $query .=" select";
    $query .="    account,";
    $query .="    email,";
    $query .="    reg_date";
    $query .=" from BS_User";
    $query .=" where invite_by=$uid";
    $query .=" limit $startindex, $pagesize";

    // echo "$query";

    $result = mysqli_query(connect(), $query);
    $invites = array();
    while (@$row = mysqli_fetch_assoc($result)) {
        $invites[] = $row;
    }

    // $jsondata['data']=$invites; //用用这个写法
    $jsondata=array('totalrecords'=>$totalrecords,'data'=>$invites);

    //没有这个，默认输出的就是字符串了
    header('Content-Type: application/json');
    echo json_encode($jsondata);
    exit();
}

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
                                <a href="#panel-1" data-toggle="tab">邀请注册成员列表 <span id="totalbadge" class="badge"></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- 邀请注册成员 -->
                            <div class="tab-pane active" id="panel-1">
                                <div class="row">
                                    <div class="col-md-12" style="padding-top:20px; "> 
                                        <table id="invitetable" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>账号</th>
                                                    <th>注册邮箱</th>
                                                    <th>注册时间</th>
                                                    <th>最近登录</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr pk="#ip#" template=1 style="display: none">
                                                    <td>#account#</td>
                                                    <td>#email#</td>
                                                    <td>#reg_date#</td>
                                                    <td>#reg_date#</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12" id="pagebar">
                                        </div>
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
        <script type="text/javascript" src="js/pager.js"></script>
        <script>
            $(function  (){
                //laod table
                $("#invitetable").pagingTable({
                    json_url: "user_invite.php?getlist=1",
                    pageSize: 2,
                    callback: function(){
                        console.log('this is callback...');
                        $("#totalbadge").text($("#invitetable").data("totalrecords"));
                    }
                });
            });
        </script>
    </body>

    </html>
