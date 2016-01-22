<?php 
require_once 'include.php';
// $cates=getAllcate();
// if(!($cates && is_array($cates))){
// 	alertMes("不好意思，网站维护中!!!", "boystyle.cn:8888/index.html");
// }
//获取最新最热的产品列表


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BoyStyle</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					BoyStyle! <small>-- 男人，爱生活，爱自己!</small>
				</h1>
			</div>
			<nav class="navbar navbar-default navbar-inverse" role="navigation">
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				    </button> <a class="navbar-brand" href="index.html">BoyStyle</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="clothes.html">潮装</a>
						</li>
						<li>
							<a href="shoes.html">鞋子</a>
						</li>
						<li>
							<a href="live.html">品质生活</a>
						</li>
						<li>
							<a href="fun.html">趣玩</a>
						</li>
						<li>
							<a href="food.html">美食</a>
						</li>
						<li>
							<a href="gift.html">送女友</a>
						</li>						
					</ul>					
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#">欢迎</a>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mark<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="user_collect.html">收藏</a>
								</li>
								<li>
									<a href="user_profile.html">资料</a>
								</li>
								<li>
									<a href="user_order.html">订单</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">退出</a>
								</li>
							</ul>
						</li>
					</ul>
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
			<div class="row">				
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">				
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">				
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
						<div class="caption">
							<h3>
								Thumbnail label
							</h3>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<p>
								<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			
			<ul class="pagination">
				<li>
					<a href="#">Prev</a>
				</li>
				<li>
					<a href="#">1</a>
				</li>
				<li>
					<a href="#">2</a>
				</li>
				<li>
					<a href="#">3</a>
				</li>
				<li>
					<a href="#">4</a>
				</li>
				<li>
					<a href="#">5</a>
				</li>
				<li>
					<a href="#">Next</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<dl>
				<dt>
					Description lists
				</dt>
				<dd>
					A description list is perfect for defining terms.
				</dd>
				<dt>
					Euismod
				</dt>
				<dd>
					Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
				</dd>
				<dd>
					Donec id elit non mi porta gravida at eget metus.
				</dd>
			</dl>
		</div>
		<div class="col-md-3">
			 
			<address>
				 <strong>Twitter, Inc.</strong><br> 795 Folsom Ave, Suite 600<br> San Francisco, CA 94107<br> <abbr title="Phone">P:</abbr> (123) 456-7890
			</address>
		</div>
		<div class="col-md-3">
			<ol>
				<li>
					Lorem ipsum dolor sit amet
				</li>
				<li>
					Consectetur adipiscing elit
				</li>
				<li>
					Integer molestie lorem at massa
				</li>
				<li>
					Facilisis in pretium nisl aliquet
				</li>
				<li>
					Nulla volutpat aliquam velit
				</li>
			</ol>
		</div>
		<div class="col-md-3">
			<blockquote>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
				</p> <small>Someone famous <cite>Source Title</cite></small>
			</blockquote>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>