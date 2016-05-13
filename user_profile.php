<?php
require_once 'lib/mysql.func.php';
session_start();
$uid = $_SESSION['uid'];

// echo "$uid";

// echo $_SERVER['REQUEST_METHOD'];

$account = "";
$email = "";
$taobao_account = "";
$phone = "";
$pwderror = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$query = "";
	$query .= "select account,taobao_account,phone,email from BS_User where uid=$uid";
	$result = mysqli_query(connect(), $query);
	$user = mysqli_fetch_assoc($result);
	// print_r($user);

	$account = $user['account'];
	$email = $user['email'];
	$taobao_account = $user['taobao_account'];
	$phone = $user['phone'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$query = "";
	if (isset($_POST['account'])) {
		$query .= "update BS_User set account='" . $_POST['account'] . "' where uid=$uid";

	} elseif (isset($_POST['taobao_account'])) {
		$query .= "update BS_User set taobao_account='" . $_POST['taobao_account'] . "' where uid=$uid";

	} elseif (isset($_POST['phone'])) {
		$query .= "update BS_User set phone='" . $_POST['phone'] . "' where uid=$uid";

	} elseif (isset($_POST['oldpwd'])) {
		$pwd = strtoupper(substr(md5($_POST['oldpwd']), 8, 16));
		$query = "select pwd from BS_User where uid=$uid";
		$result = mysqli_query(connect(), $query);
		$user = mysqli_fetch_assoc($result);
		if ($pwd == $user['pwd']) {
			if (isset($_POST['pwd']) && isset($_POST['pwd2']) && $_POST['pwd'] == $_POST['pwd2']) {
				$newpwd = strtoupper(substr(md5($_POST['pwd']), 8, 16));
				$query = "update BS_User set pwd='" . $newpwd . "' where uid=$uid";
				// echo "$query";
			} else {
				echo '两次输入的新密码不一致';
				exit();
			}

		} else {
			echo '原密码不正确';
			exit();
		}

	}

	$result = mysqli_query(connect(), $query);
	echo "$result";
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
            <div class="row">
                <div class="col-md-12">
                    <!--navbar-->
                    <?php require_once 'header.php';?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>我的资料</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-1">
                    <img style="width:140px;height:140px;flaot:right" alt="Bootstrap Image Preview" src="./images/user_header.png" />
                </div>
                <div class="col-md-3">
                    <form action="user_profile.php" method="POST">
                        <div class="form-group">
                            <label>邮箱</label><small>(非公开)</small>
                            <br>
                            <span class="text-primary"><?php echo $email; ?></span>
                        </div>
                        <div class="form-group">
                            <label>昵称</label>
                            <br>
                            <div style="display:<?php if ($account == '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <span class="text-primary"><?php echo $account; ?></span>
                                <a role="button" class="btn btn-sm btn-default" href="#"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                            </div>
                            <div style="display:<?php if ($account != '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <input style="display: inline-block;width:70%" type="text" class="form-control" id="account" name="account" placeholder="昵称, 登录后显示">
                                <a role="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-save"></span> 保存</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>淘宝账号</label><small>(非公开)</small>
                            <br>
                            <div style="display:<?php if ($taobao_account == '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <span class="text-primary"><?php echo $taobao_account; ?></span>
                                <a role="button" class="btn btn-sm btn-default" href="#"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                            </div>
                            <div style="display:<?php if ($taobao_account != '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <input style="display: inline-block;width:70%" type="text" class="form-control" id="taobao_account" name="taobao_account" placeholder="淘宝账号, 用于返利">
                                <a role="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-save"></span> 保存</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>电话</label><small>(非公开)</small>
                            <br>
                            <div style="display:<?php if ($phone == '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <span class="text-primary"><?php echo $phone; ?></span>
                                <a role="button" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                            </div>
                            <div style="display:<?php if ($phone != '') {
	echo 'none';
} else {
	echo '';
}
?>">
                                <input style="display: inline-block;width:70%" type="text" class="form-control" id="phone" name="phone" placeholder="联系电话">
                                <a role="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-save"></span> 保存</a>
                            </div>
                        </div>
                        <?php if ($uid > 0) {?>
                        <div class="form-group">
                            <div>
                                <span> <b>修改密码</b> </span>
                                <a id="mdf_pwd" role="button" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> 修改</a>
                                <br>
                            </div>
                            <div id="pwds" style="margin-top:5px;display:none;">
                                <input style="width:70%" class="form-control" type="password" id="oldpwd" name="oldpwd" placeholder="请输入原密码" />
                                <br/>
                                <input style="width:70%" class="form-control" type="password" id="pwd" name="pwd" placeholder="请输入新密码" />
                                <br/>
                                <input style="display: inline-block;width:70%" class="form-control" type="password" id="pwd2" name="pwd2" placeholder="请再次输入新密码" />
                                <a id="update_pwd" role="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> 保存</a>
                                <br/>
                            </div>
                            <span id="pwderror" class="text-danger"><?php echo "$pwderror"; ?></span>
                        </div>
                        <?php }?>
                        <!-- <div class="form-group">
                        <label>收货地址</label> <small>(非公开)</small>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="礼品邮寄地址" value="淘景大厦1301">
                        </div> -->
                        <!-- <div class="form-group">
                            <button type="submit" class="btn btn-success">保存</button>
                        </div> -->
                    </form>
                </div>
            </div>
            <?php require_once 'script.php';?>
            <?php require_once 'footer.php';?>
            <script type="text/javascript">
            $(function() {


                $("a:has(span.glyphicon-edit):lt(3)").click(function() {
                    // console.log('edit');
                    var new_val = $(this).siblings('.text-primary').text();

                    var form_div = $(this).parents('.form-group');

                    // var form_div = $("a:has(span.glyphicon-edit)").eq(0).parents('.form-group');

                    form_div.find('div:eq(0)').hide();
                    form_div.find('div:eq(1)').slideDown();
                    form_div.find('div:eq(1)').find(":text").val(new_val);

                });
                $("a:has(span.glyphicon-save):lt(3)").click(function() {
                    // console.log('save');
                    var form_div = $(this).parents('.form-group');
                    var new_val = $(this).siblings(':text').val();
                    var param = {};
                    param[$(this).siblings(':text').attr('name')] = new_val;

                    $.ajax({
                        url: "user_profile.php",
                        method: "post",
                        data: param,
                        success: function(data) {
                            // console.log(data);
                            if (data == 1) {
                                form_div.find('div:eq(1)').hide();
                                form_div.find('div:eq(0)').slideDown();
                                form_div.find('div:eq(0)').find(".text-primary").text(new_val);
                            }
                        }

                    });
                }); //

                $("#mdf_pwd").click(function() {
                    $("#pwds").slideToggle('slow');
                });
                $("#update_pwd").click(function() {
                    var param = $.param($("#pwds :input"));
                    var errtext = $(this).siblings('span.text-danger');
                    // console.log('update_pwd');

                    $.ajax({
                        url: "user_profile.php",
                        method: "post",
                        data: param,
                        success: function(data) {
                            if (data == 1) {
                                $("#pwderror").show();
                                $("#pwderror").text('密码修改成功')
                                $("#pwds").slideUp('slow');
                                setTimeout(function() {
                                    $("#pwderror").fadeOut('slow');
                                    $("#pwderror").text('');
                                }, 2000)
                            } else {
                                $("#pwderror").show();
                                $("#pwderror").text(data);
                            }
                        }

                    });
                });
            });
            </script>
    </body>

    </html>
