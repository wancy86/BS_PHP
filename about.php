<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/bs.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="images/bs.ico" type="image/x-icon" />
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
            </div>
        </div>
        <div class="col-md-6">
            <pre>
            <h3>二期</h3>
			<b>架构设计：</b>
			1.淘宝客平台的接入
				获取订单信息
				给会员返还积分

			2.会员中心的设计实现
				用户订单/积分/邀请/佣金

			3.宝贝搜索功能的实现
				高级智能分词搜索

			4.站内统计分析
				销量报表
				热门宝贝排行
				用户喜好分析，智能推荐

			5.移动端的开发
				极大的可能需要原生APP的开发
				接入支付宝和淘宝手机端


			<b>任务列表：</b>
			★★☆优先完成:
			宝贝展示的美化，佣金/收益修改
			根据用户购买记录关联宝贝列表返还积分
			用户中心积分返还进度状态

			从about等其他页面到index的跳转bug，cookie
			admin_add 页面改成tab的方式
			注册用户需要淘宝账号
			用户中心展示礼品兑换目标

			</pre>
        </div>
        <div class="row">
            <div class="col-md-6">
                <pre>
                <h3>一期已完成</h3>
				<b>架构设计：</b>
					1.数据存储：
					  使用数据库存储宝贝信息，定期生成乱序的json文件，在浏览器端缓存
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

					OK 登陆注册页面的添加
					OK 添加登录注册按钮

					OK 验证码的添加
					OK 用户表的设计
					OK 注册实现
					OK 登录实现
					OK 数据管理页面添加功能实现

					数据库设计
					用户收藏的管理
					积分功能实现
					管理员对宝贝的删除 - index页面混合

					OK JS加载数据
					OK tab改为js事件
					OK 滚动加载
					OK 从JSON读取数据，$.getJSON(url,callBack)


					OK JSON文件表的生成设计实现:
					OK 第一次加载一页数据，48条
					OK 以后每个文件加载100条数据
					OK 根据数据条数自动生成文件
					OK 全部使用JSON文件的方式加载数据

					OK 实现分页和滚动刷新
					OK 实现json数据的缓存
					OK 添加按钮滚动到顶部

					OK 站长统计连接的接入
					重新整理分类,数据导入优化

				</pre>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
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
