<?php
// echo 123;

$arr = array(
	'a' => 1,
	'b' => 2,
	'c' => 3,
	'd' => 4,
	'e' => 5,
);

echo json_encode($arr);

$obj->body = 'another post';
$obj->id = 21;
$obj->approved = true;
$obj->favorite_count = 1;
$obj->status = NULL;
echo json_encode($obj);
