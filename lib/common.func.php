<?php
function alertMes($mes, $url) {
	echo "<script>alert('{$mes}');</script>";
	echo "<script>window.location='{$url}';</script>";
}

function AlertMessage($msg, $page, $script) {
	// 1.redirect
	// header('Location: http://localhost/boystyle/admin_add.php');.
	// exit();
	// 2.redirect
	// echo "<script>alert('JSON数据文件生成完成');window.location.href='http://localhost/boystyle/admin_add.php';</script>";
	if ($msg != "") {
		echo "<script>alert('$msg');</script>";
	}
	if ($page != "") {
		echo "<script>window.location.href='http://localhost/boystyle/$page';</script>";
	}
	if ($script != "") {
		echo "$script";
	}

}