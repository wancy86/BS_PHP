<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
$query = "select cat_id,category from BS_Category";
$result = mysqli_query(connect(), $query);
$rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

// var_dump($rows);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>添加宝贝</title>

<meta name="description"
	content="Source code generated using layoutit.com">
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

				<!--从excel导入数据-->
				<div class="row">
					<div class="col-md-12">
						<h2>导入数据</h2>
						<hr>
						<form action="admin_import.php" method="post" role="form"
							class="form-inline" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1"> 类别 </label> 
								<select id="category" name="category" class="form-control" style="width: 200px;">
									<?php
                                        foreach ($rows as $cat) {
                                            echo "<option value='" . $cat["cat_id"] . "'>" . $cat["category"] . "</option>";
                                        }
                                    ?>
								</select>
							</div>
							<div class="form-group" style="margin-left: 20px;">
								<label for="exampleInputFile"> 导入文件 </label> <input type="file"
									id="file" name="file" />
								<p class="help-block">选择从淘宝客导出的Excel文件.</p>
							</div>
							<button type="submit" class="btn btn-default">导入</button>

						</form>
					</div>
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