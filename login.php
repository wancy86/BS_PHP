<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = isset($_POST[email]) ? $_POST[email] : "";
	$autologin = isset($_POST[autologin]) ? $_POST[autologin] : 0;
	$validatecode = isset($_POST[validatecode]) ? $_POST[validatecode] : "";
	$accountCheck = "";
	$accountMsg = "";
	$validateCheck = "";
	$validateMsg = "";

	if (!(isset($_SESSION['verify']) && $_SESSION['verify'] == $validatecode)) {
		$validateCheck = "has-error";
		$validateMsg = "验证码输入有误";
	} else {
		$pwd = isset($_POST[pwd]) ? $_POST[pwd] : "";
		$pwd = strtoupper(substr(md5($pwd), 8, 16));

		$query = "select uid, account, pwd from BS_User where email='$email' limit 1";
		$result = mysqli_query(connect(), $query);
		if ($result && $row = mysqli_fetch_assoc($result)) {

			if ($row['pwd'] == $pwd) {
				//login, keep the session
				if ($autologin) {
					setcookie("uid", $row['uid'], time() + 30 * 24 * 3600);
					setcookie("account", $row['account'], time() + 30 * 24 * 3600);
				}
				$_SESSION['account'] = $row['account'];
				$_SESSION['uid'] = $row['uid'];

				// $msg = "登录成功";
				// $page = "index.php";
				// AlertMessage($page, $msg, "");
				echo "<script>window.location='index.php';</script>";
			} else {
				//用户名密码不对
				$accountMsg = "用户名密码不对";
				$accountCheck = "has-error";
			}
		} else {
			//用户不存在
			$accountMsg = "用户名密码不对";
			$accountCheck = "has-error";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>登录</title>
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
						<form role="form" class="form-horizontal" action="login.php" method="POST">
							<div class="form-group <?php echo $accountCheck; ?>">
								<label class="col-sm-2 control-label text-danger" for="email">邮箱 : </label>
								<div class="col-sm-4">
									<input value="<?php echo $email; ?>" type="email" class="form-control" id="email" name="email" placeholder="邮箱"/>
								</div>
								<div class="col-sm-4 text-danger" style="margin-top:8px;">
									<span style=""><?php echo $accountMsg; ?></span>
								</div>
							</div>
							<div class="form-group <?php echo $accountCheck; ?>">
								<label class="col-sm-2 control-label text-danger" for="pwd">密码 : </label>
								<div class="col-sm-4">
									<input type="password" class="form-control" id="pwd" name="pwd" placeholder="密码"/>
								</div>
								<div class="col-sm-4 text-danger" style="margin-top:8px;">
									<span style=""><?php echo $accountMsg; ?></span>
								</div>
							</div>
							<div class="form-group <?php echo $validateCheck; ?>">
								<label class="col-sm-2 control-label text-danger" for="validatecode">验证码 : </label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="validatecode" name="validatecode" placeholder="验证码"/>
								</div>
								<div class="col-sm-2" style="margin-left: 0px;margin-top: 3px;">
									<img src="./validate_img.php" style="width:100px;hight:40px;" onclick="RefreshValidImg(this)"/>
								</div>
								<div class="col-sm-3 text-danger" style="margin-top:8px;margin-left:-20px;">
									<span style=""><?php echo $validateMsg; ?></span>
								</div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-4">
							      <div class="checkbox">
							        <label>
							          <input type="checkbox" id="autologin" name="autologin" value="1"> 30天自动登录
							        </label>
							      </div>
							    </div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-4">
							      <button type="submit" class="btn btn-success">登录</button>
							      <a href="reg.php" style="float:right" class="btn btn-default"> 注册>> </a>
							    </div>
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
    <script>
    $(":input").each(function() {
    	$(this).change(function() {
    		$(".has-error").removeClass("has-error");
    		$(".text-danger span").text('');
    	});
    });
    </script>

  </body>
</html>