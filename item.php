<?php
require_once 'lib/mysql.func.php';

$pro_id = $_GET['pid'];
// echo $pro_id;
?>
    <html>
    <head>
        <title>BoyStyle</title>
        <?php require_once 'style.php';?>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="thumbnail">
                                <a class="pro" href="javascript:void(0);" pro_id="43879806728" url="http://s.click.taobao.com/t?e=m%3D2%26s%3DH5Z1C22R4PscQipKwQzePOeEDrYVVa64LKpWJ%2Bin0XLjf2vlNIV67hWF63xfljJaoAgJVlbS%2FO9Og2r8NdThQAD%2F0NtdZ9kyH9QiDT32gnJJPVbpKpZHQey%2FMwu8z29MQ%2FmkFCs8mWpbDveG3Yq1UMYMXU3NNCg%2F&amp;pvid=12_61.141.137.74_6271_1456553661065" target="_blank"><img alt="包邮春夏新款女装高腰短裙裤半身裙韩版蓬蓬裙大摆红色伞裙防走光" src="http://img01.taobaocdn.com/bao/uploaded/i1/1826393730/TB2jklakpXXXXXvXXXXXXXXXXXX_!!1826393730.jpg"></a>
                                <div class="caption">
                                    <h3>包邮春夏新款女装高腰短裙裤半身裙韩版蓬蓬裙大摆红色伞裙防走光</h3>
                                    <p> 价格: ￥58 / 返利: 5.8 BB / 月销量:118 </p>
                                    <p> <a class="btn btn-danger pro" href="javascript:void(0);" pro_id="43879806728" url="http://s.click.taobao.com/t?e=m%3D2%26s%3DH5Z1C22R4PscQipKwQzePOeEDrYVVa64LKpWJ%2Bin0XLjf2vlNIV67hWF63xfljJaoAgJVlbS%2FO9Og2r8NdThQAD%2F0NtdZ9kyH9QiDT32gnJJPVbpKpZHQey%2FMwu8z29MQ%2FmkFCs8mWpbDveG3Yq1UMYMXU3NNCg%2F&amp;pvid=12_61.141.137.74_6271_1456553661065" target="_blank">去看看</a>
                                        <button tabindex="0" onclick="AddFavorite(this, 43879806728)" class="btn"><span class="glyphicon glyphicon-heart-empty"></span> 添加收藏</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once 'script.php';?>
    </body>

    </html>
