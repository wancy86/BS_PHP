<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About</title>

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

				<!--content-->
				<pre>
				<b>架构设计：</b>	
					1.数据存储：
					  使用数据库存储宝贝信息，定期生成乱序的json文件，这样可以在浏览器端缓存
					2.数据加载：
					  使用异步的json文件加载显示
					  滚动刷新加载	
					3.后台管理页面：
					  表格的方式显示当前的宝贝记录，支持删除操作，排序, 隐藏
					  可以添加新的宝贝
					4.推广模式
					  实现传销推广模式，层级提成
					5.返利方式
					  BB的方式返利
					  前期使用兑换和支付购买的方式消费BB
					  后期实现提现

				<b>任务列表：</b>
					OK 数据导入功能完成,之后可以完成数据的显示 <a href="http://jingyan.baidu.com/article/cd4c2979138007756e6e60fd.html">Demo</a>
					OK 后台数据管理优先完成，现生产后消费
					OK 完成页面的整合，根据参数显示信息
					数据库设计
					登陆注册页面的添加
					添加登录注册按钮

					TODO 实现分页和滚动刷新
					TODO 实现json数据的缓存

				</pre>

			</div>
		</div>

		<hr />
		  <?php phpinfo();?>
		<hr />

		<!--footer-->
		<?php require_once 'footer.php';?>
	</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html>