<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
require_once './lib/send_email.php';

// 想用session就一定要开启session
session_start();

$validateMsg = "";
$validateCheck = "";
$msg = "";
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
$active = isset($_REQUEST['active']) ? $_REQUEST['active'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
	$validatecode = isset($_POST['validatecode']) ? $_POST['validatecode'] : "";

	if (!(isset($_SESSION['verify']) && $_SESSION['verify'] == $validatecode)) {
		$validateCheck = "has-error";
		$validateMsg = "验证码输入有误";
	} else {
		$query = "select uid,pwd from BS_User where email='$email' limit 1";
		// echo "$query";

		$result = mysqli_query(connect(), $query);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			if ($row['uid'] != 0) {
				$active_key = substr(md5($row['pwd'] . date("Y/m/d/H")), 8, 16);
				// echo "$active_key";
				// echo "<br>";
				// echo "$active";
				if ($active_key == $active) {
					$newpwd = strtoupper(substr(md5($pwd), 8, 16));
					$query = "update BS_User set pwd='$newpwd' where email='$email'";
					$result = mysqli_query(connect(), $query);
					if (!$result) {
						$msg = "修改密码失败";
					} else {
						$msg = "重置密码成功，<a href='login.php'>亲登录</a>";
					}
				} else {
					$msg = "链接已失效";
				}
			} else {
				$msg = "邮箱不存在";
			}
		} else {
			$msg = "发生错误";
		}
	}
}

?>
    <html>

    <head>
        <title>重置密码</title>
        <?php require_once 'style.php';?>
    </head>

    <body>
        <div class="container-fluid">
            <!--navbar-->
            <?php require_once 'header.php';?>
            <div class="row">
                <div class="col-md-12">
                    <h3>重置密码</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 mainform">
                    <form class="form-horizontal" action="reset_pwd.php?action=rest_pwd&email=<?php echo $email; ?>&active=<?php echo $active; ?>" method="POST">
                        <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                        <input type="hidden" name="active" value="<?php echo $active; ?>"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-danger" for="pwd">密码 : </label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="密码必须是6-25位数字、字母、符号" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-danger" for="pdw2">确认密码 : </label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="pdw2" name="pdw2" placeholder="请重新输入密码" />
                            </div>
                            <div class="col-sm-4 text-danger" style="margin-top:8px;">
                                <span id="pwd2err" style=""></span>
                            </div>
                        </div>
                        <div class="form-group <?php echo $validateCheck; ?>">
                            <label class="col-sm-2 control-label text-danger" for="validatecode">验证码 : </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="validatecode" name="validatecode" placeholder="验证码" />
                            </div>
                            <div class="col-sm-2" style="margin-left: 0px;margin-top: 3px;">
                                <img src="./validate_img.php" style="width:100px;hight:40px;" onclick="RefreshValidImg(this)" />
                            </div>
                            <div class="col-sm-3 text-danger" style="margin-top:8px;margin-left:-20px;">
                                <span style=""><?php echo $validateMsg; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button id="ok_btn" class="btn btn-md btn-success">确定</button>
                            </div>
                        </div>
                        <div class="form-group has-error text-danger">
                            <div class="col-sm-4 col-sm-offset-2">
                                <label><?php echo $msg; ?></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php require_once 'footer.php';?>
        </div>
        <?php require_once 'script.php';?>
        <script type="text/javascript">
        $("#ok_btn").click(function() {
            console.log('click ok');

        });
        </script>
    </body>

    </html>
