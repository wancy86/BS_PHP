<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
// require_once './lib/common.func.php';

$emailphone = isset($_POST[emailphone]) ? $_POST[emailphone] : "";
$accountCheck = "";
$accountMsg = "";
$validateCheck = "";
$validateMsg = "";

$_SESSION['mark'] = 'mark';

print_r($_SESSION);

//if POST
// echo $_POST[emailphone];
echo isset($_SESSION['validatecode']) ? 123 : 456;

if (isset($_POST[emailphone])) {
	$validatecode = isset($_POST[validatecode]) ? $_POST[validatecode] : "";
	if (!(isset($_SESSION['validatecode']) && $_SESSION['validatecode'] == $validatecode)) {
		$validateCheck = "has-error";
		$validateMsg = "验证码输入有误";
	} else {
		$pwd = isset($_POST[pwd]) ? $_POST[pwd] : "";
		$pwd = strtoupper(substr(md5($pwd), 8, 16));
		$query = "select pwd from BS_User where email='$emailphone' or account ='$emailphone' limit 1";
		// select top 1 pwd from BS_User where emial='$emailphone' or phone ='$emailphone'

		// echo $query;
		$result = mysqli_query(connect(), $query);
		if ($result && $row = mysqli_fetch_assoc($result)) {
			if ($row['pwd'] == $pwd) {
				//login, keep the session
				$msg = "登录成功";
				$page = "index.php";
				AlertMessage($page, $msg, "");
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>登录</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
    <div class="container-fluid">
		<div class="row" style="margin-bottom:100px;">
			<div class="col-md-12">
				<!--navbar-->
				<?php require_once 'header.php';?>

				<!--content-->
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<form role="form" class="form-horizontal" action="login.php" method="POST">
							<div class="form-group <?php echo $accountCheck; ?>">
								<label class="col-sm-2 control-label" for="emailphone">账号 : </label>
								<div class="col-sm-4">
									<input value="<?php echo $emailphone; ?>" type="text" class="form-control" id="emailphone" name="emailphone" placeholder="用户名 / 邮箱"/>
								</div>
								<div class="col-sm-4 text-danger" style="margin-top:8px;">
									<span style=""><?php echo $accountMsg; ?></span>
								</div>
							</div>
							<div class="form-group <?php echo $accountCheck; ?>">
								<label class="col-sm-2 control-label" for="pwd">密码 : </label>
								<div class="col-sm-4">
									<input type="password" class="form-control" id="pwd" name="pwd" placeholder="密码"/>
								</div>
								<div class="col-sm-4 text-danger" style="margin-top:8px;">
									<span style=""><?php echo $accountMsg; ?></span>
								</div>
							</div>
							<div class="form-group <?php echo $validateCheck; ?>">
								<label class="col-sm-2 control-label" for="validatecode">验证码 : </label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="validatecode" name="validatecode" placeholder="验证码"/>
								</div>
								<div class="col-sm-2" style="margin-left: -20px;margin-top: 3px;">
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
							          <input type="checkbox"> 30天自动登录
							        </label>
							      </div>
							    </div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-4">
							      <button type="submit" class="btn btn-success">登录</button>
							    </div>
							</div>
						</form>

					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>
		</div>

		<!--footer-->
		<?php require_once 'footer.php';?>
	</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

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