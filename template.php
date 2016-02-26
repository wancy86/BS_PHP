<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';

$query  =" select pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url";
$query .=" from BS_ProInfo as A ";
$query .=" join BS_Category as B on A.cat_id=B.cat_id ";
$query .=" where A.disabled=0 and B.category='送女友'";
$query .=" order by A.pro_id";
$query .=" limit 0, 9";

$result = mysqli_query(connect(), $query);
$rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
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
				<!--navbar-->
				<?php require_once 'header.php';?>			
				

				<!--content-->
				<?php
				    $index = 1;
                    foreach ($rows as $item) {
                        $item_tbk_url = $item["tbk_url"];
                        $item_title = $item["title"];
                        $item_img_url = $item["img_url"];
                        $item_title = $item["title"];
                        $item_price = $item["price"];
                        $item_comm_percent = $item["comm_percent"];
                        $item_month_sold = $item["month_sold"];
                        $item_tbk_url = $item["tbk_url"];
                        if($index % 4 == 1)
                        {
                            echo '<div class="row">';
                        } 
                        echo <<<theEnd
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <a href="$item_tbk_url" target="_blank"><img alt="$item_title" src="$item_img_url"/></a>
                                    <div class="caption">
                                        <h3>
                                            $item_title
            							</h3>
            							<p>
            								$item_price / $item_comm_percent
            							</p>
            						    <p>
            								月销量:$item_month_sold
            							</p>
            							<p>
            								<a class="btn btn-danger" href="$item_tbk_url" target="_blank">去看看</a> <a class="btn" href="#">收藏</a>
            							</p>
            						</div>
        					   </div>
    					   </div>
theEnd;
//标记好必须顶头写
            		    if($index % 4 == 0)
                        {
                            echo "</div>";                            
                        }
                        $index = $index+1;
                    }
                    if($index % 4 != 0)
                    {
                        echo "</div>";
                    }
                ?>
			    <!-- 
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
				</div>
				-->

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