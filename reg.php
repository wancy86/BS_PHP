<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册</title>
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
                                <label class="col-sm-2 control-label" for="emailcell">邮箱/手机号 : </label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="emailcell" placeholder="请输入邮箱或手机号" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="account">用户名 : </label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="account" placeholder="用户名必须是纯字母和数组的组成" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="pwd">密码 : </label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="pwd" placeholder="密码必须是6-25位数字、字母、符号" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="pdw2">确认密码 : </label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="pdw2" placeholder="请重新输入" />
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-5">
                                <button type="submit" class="btn btn-success"> 注册 </button>
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
