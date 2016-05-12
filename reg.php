<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
require_once './lib/Logs.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$action = isset($_POST[action]) ? $_POST[action] : "";
	// account 显示为昵称, 默认为邮箱，资料页可以修改
	$account = ""; //isset($_POST[account]) ? $_POST[account] : "";
	$email = isset($_POST[email]) ? $_POST[email] : "";
	$pwd = isset($_POST[pwd]) ? $_POST[pwd] : "";
	$pwd = strtoupper(substr(md5($pwd), 8, 16));

	// echo "$email";

	//写日志调试
	addLog("pwd = " . $pwd);

	// $taobao_account = isset($_POST[taobao_account]) ? $_POST[taobao_account] : "";
	//邀请码就是邀请人ID，invite_by就够了
	// $invite_code = ""; //isset($_POST[invite_code]) ? $_POST[invite_code] : "";
	$invite_by = isset($_POST[invite_by]) ? $_POST[invite_by] : 0;

	//邮箱必须唯一，昵称可以随意
	$query = "";
	$query .= " select count(0) as email";
	$query .= " from   BS_User";
	$query .= " where  email = '$email'";

	// echo $query;

	$msg = "";
	$page = "";
	$checkresult = mysqli_query(connect(), $query);
	$row = mysqli_fetch_assoc($checkresult); //得到数组

	if ($row['email'] > 0) {
		$msg = "邮箱已存在";
		if ($action == 'validate_email') {
			echo $msg;
			exit();
		}
	} else {
		//注册
		$query = " insert into BS_User(account, email, pwd, invite_by, reg_date)";
		$query .= " values('$email', '$email', '$pwd', '$invite_by', now())";

		// echo "$query";

		// echo $query;
		$result = mysqli_query(connect(), $query);
		$msg = "注册成功,请登录！";
		$page = "login.php";
	}

	// insert into BS_User(account, email, phone, pwd, invite_code, invite_by, reg_date)
	// values('$account', '$email', '$phone', '$pwd', '$invite_code', $invite_by, now())

	// redirect
	AlertMessage($page, $msg);
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>注册</title>
        <?php require_once 'style.php';?>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row" style="margin-bottom:100px;">
                <div class="col-md-12">
                    <!--navbar-->
                    <?php require_once 'header.php';?>
                    <!--content-->
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <form role="form" class="form-horizontal" action="reg.php" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-danger" for="email">邮箱 : </label>
                                    <div class="col-sm-5">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="请输入邮箱" />
                                    </div>
                                    <div class="col-sm-4 text-danger" style="margin-top:8px;">
                                        <span id="emailerr" style=""></span>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label" for="account">昵称 : </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="account" name="account" placeholder="请输入昵称" />
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-danger" for="pwd">密码 : </label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="密码必须是6-25位数字、字母、符号" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-danger" for="pdw2">确认密码 : </label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" id="pdw2" name="pdw2" placeholder="请重新输入密码" />
                                    </div>
                                    <div class="col-sm-4 text-danger" style="margin-top:8px;">
                                        <span id="pwd2err" style=""></span>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label" for="taobao_account">淘宝账号 : </label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="taobao_account" name="taobao_account" placeholder="关联淘宝账号便于返利" />
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-success" for="invite_by">邀请码 : </label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="invite_by" name="invite_by" placeholder="请输入邀请码，如果你有" />
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-5">
                                    <button type="submit" class="btn btn-success"> 注册 </button>
                                    <a href="login.php" style="float:right" class="btn btn-default"> 登录>> </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer-->
            <?php require_once 'footer.php';?>
        </div>
        <?php require_once 'script.php';?>
        <script type="text/javascript">
        $(function() {
            $("#pdw2").blur(function() {
                if ($(this).val() != $("#pwd").val() && $(this).val() != '') {
                    $(this).parents(".form-group").addClass("has-error");
                    $("#pwd2err").text("两次输入的密码不匹配");
                    $(this).focus();
                } else {
                    $(this).parents(".form-group").removeClass("has-error");
                    $("#pwd2err").text("");
                }
            }); //

            $("#email").blur(function() {
                var email = $(this);
                //邮箱合法性，邮箱是否已存在
                var email_reg = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
                if (!email_reg.test(email.val()) && email.val() != '') {
                    email.parents(".form-group").addClass("has-error");
                    $("#emailerr").text("请输入正确的邮箱地址");
                    email.focus();
                } else if (email.val() != '') {
                    email.parents(".form-group").removeClass("has-error");
                    $("#emailerr").text("");
                    //检查是否已注册
                    $.ajax({
                        url: "reg.php",
                        data: {
                            action: "validate_email",
                            email: email.val()
                        },
                        method: "POST",
                        success: function(data) {
                            if (data != '') {
                                email.parents(".form-group").addClass("has-error");
                                $("#emailerr").text(data);
                                email.focus();
                            } else {
                                email.parents(".form-group").removeClass("has-error");
                                $("#emailerr").text("");
                            }
                        }
                    });
                }
            }); //

        });
        </script>
    </body>

    </html>
