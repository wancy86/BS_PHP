<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
// 想用session就一定要开启session
session_start();

$email = "wancy86@sina.com";
$emailMsg = "";
$validateMsg = "";
$emailCheck = "";
$validateCheck = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$validatecode = isset($_POST[validatecode]) ? $_POST[validatecode] : "";
	// echo "$validatecode";
	// echo $_SESSION['verify'];

	if (!(isset($_SESSION['verify']) && $_SESSION['verify'] == $validatecode)) {
		$validateCheck = "has-error";
		$validateMsg = "验证码输入有误";
	} else {
		$query = "select uid from BS_User where email='$email' limit 1";
		$result = mysqli_query(connect(), $query);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			if ($row['uid'] != 0) {
				//email to the register email to rest password
				echo "reset pwd...";
				//发送验证邮件
				//

			} else {
				$emailMsg = "邮箱不存在";
				$emailCheck = "has-error";
			}
		} else {
			echo "Error...";
		}

	}
}
?>
    <html>

    <head>
        <title>忘记密码</title>
        <?php require_once 'style.php';?>
    </head>

    <body>
        <div class="container-fluid">
            <!--navbar-->
            <?php require_once 'header.php';?>
            <div class="row">
                <div class="col-md-12">
                    <h3>忘记密码</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 mainform">
                    <form class="form-horizontal" action="#" method="POST">
                        <div class="form-group <?php echo $emailCheck; ?>">
                            <label class="col-sm-2 control-label text-danger" for="email">邮箱 : </label>
                            <div class="col-sm-4">
                                <input value="<?php echo $email; ?>" type="email" class="form-control" id="email" name="email" placeholder="请输入注册邮箱" />
                            </div>
                            <div class="col-sm-4 text-danger" style="margin-top:8px;">
                                <span style=""><?php echo $emailMsg; ?></span>
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
