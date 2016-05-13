<?php
require_once './lib/image.func.php';
session_start();
?>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header text-primary">
                <h1> BoyStyle! <small>-- 爱生活，爱自己! 想逛一下淘宝？我们帮你挑选出了最好最便的宝贝，为你省心、省力、省钱，还能赚钱！</small> </h1>
            </div>
            <nav class="navbar navbar-default navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/boystyle/index.php"><span class="glyphicon glyphicon-home"></span> BoyStyle</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li></li>
                        <!-- placeholder -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" onclick="ShowByCategory(this,'男装',1)" class="dropdown-toggle" data-toggle="dropdown">男装<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'男装',1)">衣裤</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'男鞋',1)">鞋子</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" onclick="ShowByCategory(this,'女装',1)" class="dropdown-toggle" data-toggle="dropdown">女装<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'女装',1)">衣裙</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'女鞋',1)">鞋子</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'精美配饰',1)">精美配饰</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'美容护肤',1)">美容护肤</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" onclick="ShowByCategory(this,'童装',1)" class="dropdown-toggle" data-toggle="dropdown">童装<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'童装',1)">童装</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'玩具',1)">玩具</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onclick="ShowByCategory(this,'电子产品',1)">电子产品</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onclick="ShowByCategory(this,'美食',1)">美食</a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" onclick="ShowByCategory(this,'品质生活',1)" class="dropdown-toggle" data-toggle="dropdown">其他<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'品质生活',1)">品质生活</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="ShowByCategory(this,'创意趣玩',1)">创意趣玩</a>
                                </li>
                            </ul>
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
			<li class="dropdown">
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> <span class="text-primary">$_SESSION[account]</span></a>
				<ul class="dropdown-menu">
					<li>
						<a href="user_profile.php">我的资料</a>
					</li>
					<li>
						<a href="user_favorite.php">我的收藏</a>
					</li>
					<li>
						<a href="user_commission.php">结算中心</a>
					</li>
Loged1;
	if ($_SESSION['account'] == 'admin') {
		echo <<<Loged2
					<li class="divider">
					</li>
					<li>
						<a href="admin_data.php">数据管理</a>
					</li>
					<li>
						<a href="/boystyle/about.php">About</a>
					</li>
					<li>
						<a href="/boystyle/phpinfo.php">PHPInfo</a>
					</li>
Loged2;
	}
	echo <<<Loged3
					<li class="divider">
					</li>
					<li>
						<a href="logout.php">注销</a>
					</li>
				</ul>
			</li>
		</ul>
Loged3;
}
?>
                    <ul class="nav navbar-nav navbar-right" title="搜索将进入爱淘宝，购物同样有返利" style="padding: 6px;">
                        <li>
                            <input id="keyword" name="keyword" type="text" class="form-control" placeholder="爱淘宝搜索返利">
                        </li>
                        <li style="margin-left:5px;">
                            <button id="search" type="button" class="btn " onclick="GotoAitaobao()">
                                <span class="glyphicon glyphicon-search"></span> 搜索
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
