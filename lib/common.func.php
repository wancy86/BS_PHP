<?php
function alertMes($mes, $url) {
	echo "<script>alert('{$mes}');</script>";
	echo "<script>window.location='{$url}';</script>";
}

function AlertMessage($page, $msg, $script = '') {
	// 1.redirect
	// header('Location: /admin_data.php');
	// exit();
	// 2.redirect
	// echo "<script>alert('JSON数据文件生成完成');window.location.href='/admin_data.php';</script>";
	if ($msg != "") {
		echo "<script>alert('$msg');</script>";
	}
	if ($script != "") {
		echo "<script>$script</script>";
	}
	if ($page != "") {
		echo "<script>window.location.href='/$page';</script>";
	}

}