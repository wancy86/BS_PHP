<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>宝贝列表</title>

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

					<!-- title -->
					<div class="row">
						<div class="col-md-12">
							<h3>
								宝贝列表
							</h3>
						</div>
					</div>

					<!-- List -->
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
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
										<th>
											操作
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
										<td>
											Default
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
										<td>
											Default
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
										<td>
											Default
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
										<td>
											Default
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
	
				

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