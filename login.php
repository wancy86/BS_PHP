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
						<form role="form" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="emailcell">账号 : </label>
								<div class="col-sm-4">
									<input type="email" class="form-control" id="emailcell" placeholder="用户名 / 邮箱"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="pwd">密码 : </label>
								<div class="col-sm-4">
									<input type="password" class="form-control" id="pwd" placeholder="密码"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="emailcell">验证码 : </label>
								<div class="col-sm-4">
									<input type="email" class="form-control" id="emailcell" placeholder="验证码"/>
								</div>
								<div class="col-sm-4">
									<img src="./validate_img.php" style="width:100px;hight:40px;" onclick="RefreshValidImg(this)"/>
								</div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <div class="checkbox">
							        <label>
							          <input type="checkbox"> 30天自动登录
							        </label>
							      </div>
							    </div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
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

  </body>
</html>