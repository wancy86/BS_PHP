<?php
require_once './lib/image.func.php';
session_start();
?>
<div class="page-header">
	<h1>
		BoyStyle! <small>-- 爱生活，爱自己!</small>
	</h1>
</div>
<nav class="navbar navbar-default navbar-inverse" role="navigation">
	<div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="/boystyle/index.php/0.html">BoyStyle</a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'潮装',1)">男神潮装</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'男鞋',1)">男鞋</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'电子产品',1)">电子产品</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'靓装',1)">女神靓装</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'女鞋',1)">女鞋</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'精美配饰',1)">精美配饰</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'美容护肤',1)">美容护肤</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'美食',1)">美食</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'童装',1)">童装</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'玩具',1)">玩具</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'创意趣玩',1)">创意趣玩</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'品质生活',1)">品质生活</a>
			</li>
			<li>
				<a href="/boystyle/about.php">About</a>
			</li>
			<li>
				<a href="/boystyle/phpinfo.php">PHPInfo</a>
			</li>
		</ul>
<!-- 未登录 -->
<?php if (!isset($_SESSION['uid'])) {
	echo <<<unloged
       <ul class="nav navbar-nav navbar-right">
			<li>
				<a href="/boystyle/login.php">登录</a>
			</li>
	        <li>
				<a href="#">/</a>
			</li>
            <li>
				<a href="/boystyle/reg.php">免费注册</a>
			</li>
		</ul>
unloged;
}
?>
<!-- 登陆后 -->
<?php if (isset($_SESSION['uid'])) {
	echo <<<Loged1
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="#">欢迎</a>
			</li>
			<li class="dropdown">
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown">$_SESSION[account]<strong class="caret"></strong></a>
				<ul class="dropdown-menu">
					<li>
						<a href="user_collect.php">收藏</a>
					</li>
					<li>
						<a href="user_profile.php">资料</a>
					</li>
					<li>
						<a href="user_order.php">订单</a>
					</li>
Loged1;
	if ($_SESSION['account'] == 'admin') {
		echo <<<Loged2
					<li class="divider">
					</li>
					<li>
						<a href="admin_add.php">数据管理</a>
					</li>
Loged2;
	}
	echo <<<Loged3
					<li class="divider">
					</li>
					<li>
						<a href="logout.php">退出</a>
					</li>
				</ul>
			</li>
		</ul>
Loged3;
}
?>
		<form class="navbar-form navbar-right" role="search">
			<div class="form-group">
				<input type="text" class="form-control">
			</div>
			<button type="submit" class="btn btn-default">
				Search
			</button>
		</form>
	</div>
</nav>
<script>
$('li.dropdown').mouseover(function() {
     $(this).addClass('open');    }).mouseout(function() {        $(this).removeClass('open');    });
</script>
