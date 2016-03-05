<?php
function alertMes($mes, $url) {
	echo "<script>alert('{$mes}');</script>";
	echo "<script>window.location='{$url}';</script>";
}

function AlertMessage($msg, $page) {
	echo "<script>alert('$msg');</script>";
	echo "<script>window.location.href='http://localhost/boystyle/$page';</script>";
}