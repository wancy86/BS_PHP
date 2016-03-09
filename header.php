<?php
require_once './lib/image.func.php';
session_start();
?>
<div class="page-header">
	<h1>
		BoyStyle! <small>-- 男人，爱生活，爱自己!</small>
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
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'E1140E7CF9C2305D',1)">男神潮装</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'E0DC46B5A5B998BE',1)">鞋子</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'BFF7A6473FF23C3C',1)">女神靓装</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'BFF7A6473FF23C3C',1)">精美配饰</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'FD0F2BA821918F4E',1)">美食</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'BFF7A6473FF23C3C',1)">趣玩</a>
			</li>
			<li>
				<a href="javascript:void(0);" onclick="ShowByCategory(this,'BFF7A6473FF23C3C',1)">品质生活</a>
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
						<a href="user_collect.php?uid=$_SESSION[uid]">收藏</a>
					</li>
					<li>
						<a href="user_profile.php?uid=$_SESSION[uid]">资料</a>
					</li>
					<li>
						<a href="user_order.php?uid=$_SESSION[uid]">订单</a>
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
