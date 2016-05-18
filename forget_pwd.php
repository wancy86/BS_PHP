<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
require_once './lib/send_email.php';

// 想用session就一定要开启session
session_start();

$email = "wancy86@sina.com";
$emailMsg = "";
$validateMsg = "";
$emailCheck = "";
$validateCheck = "";

// rest_pwd
$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$validatecode = isset($_POST['validatecode']) ? $_POST['validatecode'] : "";
	// echo "$validatecode";
	// echo $_SESSION['verify'];

	if (!(isset($_SESSION['verify']) && $_SESSION['verify'] == $validatecode)) {
		$validateCheck = "has-error";
		$validateMsg = "验证码输入有误";
	} else {
		$query = "select uid,pwd,account from BS_User where email='$email'";
		$result = mysqli_query(connect(), $query);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			if ($row['uid'] != 0) {
				//发送验证邮件
				$active_key = substr(md5($row['pwd'] . date("Y/m/d/H")), 8, 16);
				$secu_url = "localhost/boystyle/reset_pwd.php?action=rest_pwd&email=$email&active=$active_key";
				// echo $secu_url;

				$contents = "<br/>";
				$contents .= "亲爱的用户 " . $row['account'] . "：您好！<br/>";
				$contents .= "<br/>";
				$contents .= "    您收到这封这封电子邮件是因为您 (也可能是某人冒充您的名义) 申请了一个新的密码。假如这不是您本人所申请, 请不用理会这封电子邮件, 但是如果您持续收到这类的信件骚扰, 请您尽快联络管理员。<br/>";
				$contents .= "<br/>";
				$contents .= "    要使用新的密码, 请使用以下链接启用密码。<br/>";
				$contents .= "<br/>";
				$contents .= "<a href='" . $secu_url . "'>" . $secu_url . "</a>";
				$contents .= "<br/>";
				$contents .= "    (如果无法点击该URL链接地址，请将它复制并粘帖到浏览器的地址输入框，然后单击回车即可。该链接使用后将立即失效。)<br/>";
				$contents .= "   <br/>";
				$contents .= "    注意:请您在收到邮件1个小时内使用，否则该链接将会失效。<br/>";
				$contents .= "<br/>";
				$contents .= "<br/>";
				$contents .= "<a href='WWW.BOYSTYLE.CN'>WWW.BOYSTYLE.CN</a> - 中国最大的导购返利网站，为你优选物美价廉的宝贝，为你省钱省力，省时间。<br/>";
				$contents .= "用户服务支持：<a href='mailto:boystyle_cn@163.com'>boystyle_cn@163.com</a><br/>";

				sendemail($email, '找回您的账户密码', $contents);

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
