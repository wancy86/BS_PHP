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

//get all JSON file list
$query2 = "select * from bs_json order by fid";
$result2 = mysqli_query(connect(), $query2);
$json_files = array();
while (@$row = mysqli_fetch_assoc($result2)) {
    $json_files[] = $row;
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
                    <form class="form-inline" action="admin_gen_json.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputName2">类别</label>
                            <select id="category" name="category[]" class="form-control" style="width:200px;" multiple='multiple' size="3">
                                <option value="ALL">ALL</option>
                                <?php foreach ($cat_rows as $cat) {
	echo "<option value='" . $cat["category"] . "'>" . $cat["category"] . "</option>";
}
?>
                            </select>
                        </div>
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
                                                                                                             类别
                                </th>
                                <th>
                                                                                                            加载顺序
                                </th>
                                <th>
                                                                                                            数据行数
                                </th>
                                <th>
                                                                                                            文件路径
                                </th>
                                <th>
                                                                                                            修改时间
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rownum =1; 
                        foreach ($json_files as $filerow) {
                        echo <<<JSON_EOD
                        <tr>
                            <td>
                                $rownum
                            </td>
                            <td>
                                $filerow[category]
                            </td>
                            <td>
                                $filerow[load_order]
                            </td>
                            <td>
                                $filerow[data_rows]
                            </td>
                            <td>
                                $filerow[file_name]
                            </td>
                            <td>
                                $filerow[entry_date]
                            </td>
                        </tr>
JSON_EOD;
                        $rownum++;
                        }?>

                            
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
