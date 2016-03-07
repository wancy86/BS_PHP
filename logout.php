<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
require_once './lib/common.func.php';
session_start();

// echo $_SESSION['uid'];
// echo $_SESSION['account'];

session_unset();

AlertMessage("index.php", "", "");
