<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
$query = "select cat_id,cat_desc from BS_Category";
$result = mysqli_query(connect(), $query);
$rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}

//get distinct category
$query = "select distinct category from BS_Category";
$result = mysqli_query(connect(), $query);
$cat_rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
	$cat_rows[] = $row;
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>添加宝贝</title>
        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--navbar-->
                    <?php require_once 'header.php';?>
                </div>
            </div>
            <!--从excel导入数据-->
            <div class="row">
                <div class="col-md-12">
                    <h2>导入数据</h2>
                    <hr>
                    <form action="admin_import.php" method="post" role="form" class="form-inline" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> 类别 </label>
                            <select id="cat_id" name="cat_id" class="form-control" style="width: 200px;">
                                <?php foreach ($rows as $sub_cat) {
	echo "<option value='" . $sub_cat["cat_id"] . "'>" . $sub_cat["cat_desc"] . "</option>";
}
?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-left: 20px;">
                            <label for="exampleInputFile"> 导入文件 </label>
                            <input type="file" id="file" name="file" />
                            <p class="help-block">选择从淘宝客导出的Excel文件.</p>
                        </div>
                        <button type="submit" class="btn btn-success">导入 >></button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h2>JSON数据文件生成</h2>
                    <hr>
                    <form class="form-inline" action="admin_gen_json.php" method="get">
                        <div class="form-group">
                            <label for="exampleInputName2">类别</label>
                            <select class="form-control" style="width:200px;">
                                <option value="ALL">ALL</option>
                                <?php foreach ($cat_rows as $cat) {
	echo "<option value='" . $cat["category"] . "'>" . $cat["category"] . "</option>";
}
?>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail2">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                        </div> -->
                        <button type="submit" class="btn btn-success">Re-Generate-JSON >></button>
                    </form>
                    <table class="table table-bordered">
                        <caption><b>JSON文件列表</b></caption>
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Payment Taken
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    TB - Monthly
                                </td>
                                <td>
                                    01/04/2012
                                </td>
                                <td>
                                    Default
                                </td>
                            </tr>
                            <tr class="active">
                                <td>
                                    1
                                </td>
                                <td>
                                    TB - Monthly
                                </td>
                                <td>
                                    01/04/2012
                                </td>
                                <td>
                                    Approved
                                </td>
                            </tr>
                            <tr class="success">
                                <td>
                                    2
                                </td>
                                <td>
                                    TB - Monthly
                                </td>
                                <td>
                                    02/04/2012
                                </td>
                                <td>
                                    Declined
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>
                                    3
                                </td>
                                <td>
                                    TB - Monthly
                                </td>
                                <td>
                                    03/04/2012
                                </td>
                                <td>
                                    Pending
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>
                                    4
                                </td>
                                <td>
                                    TB - Monthly
                                </td>
                                <td>
                                    04/04/2012
                                </td>
                                <td>
                                    Call in to confirm
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--footer-->
        <!-- <?php require_once 'footer.php';?> -->
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>

    </html>
