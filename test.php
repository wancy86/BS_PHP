<?php
// Connect Mysql
$link = mysqli_connect("localhost", "root", "111222", "test", 3306);

if (isset($_GET['act']) && ! empty($_GET['id'])) {
    $act = $_GET['act'];
}
if (isset($_GET['id']) && ! empty($_GET['id'])) {
    $id = $_GET['id'];
}

$rows = array();

// actions:
switch ($act) {
    case 'del':
        $query = "delete from test where id=$id";
        $result = mysqli_query($link, $query);
        $rows = loadPage($link);
        break;
    case 'save':
        if (isset($_POST['edit_id']) && ! empty($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
        }
        if (isset($_POST['name']) && ! empty($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['num']) && ! empty($_POST['num'])) {
            $num = $_POST['num'];
        }
        if (isset($_POST['description']) && ! empty($_POST['description'])) {
            $description = $_POST['description'];
        }
        // Insert Data
        if ($edit_id)
            $query = "update test set name='$name',num=$num,description='$description' where id=$edit_id";
        else 
            if ($name)
                $query = "insert into test(name,num,description) values('$name',$num,'$description')";
        
        echo $query;        
        $result = mysqli_query($link, $query);
        
        echo "<script>window.location='test.php'</script>";
        break;
    case 'edit':
        if (isset($_GET['edit_id']) && ! empty($_GET['edit_id'])) {
            $edit_id = $_GET['edit_id'];
        }
        $query = "select * from test where id=$edit_id";
        $result = mysqli_query($link, $query);
        $edit_row = mysqli_fetch_assoc($result);
        $rows = loadPage($link);
        break;
    default:
        $rows = loadPage($link);
        break;
}

// Show list
function loadPage($link)
{
    $query = "select * from test";
    $result = mysqli_query($link, $query);
    while ($result && ($row = mysqli_fetch_assoc($result))) {
        $rows[] = $row;
    }
    
    return $rows;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>test</title>
<style>
table {
	border-collapse: collapse;
	width: 500px;
}

table td {
	border: 1px solid #ddd;
}
</style>
</head>
<body>
	<form action="test.php?act=save" method="post">
		<table>
			<captipn>Edit and Add</captipn>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name"
					value="<?php if($edit_row)echo $edit_row['name']?>" /> <input
					type="hidden" name="edit_id" value="<?php echo $edit_id?>" /></td>
			</tr>
			<tr>
				<td>Number:</td>
				<td><input type="text" name="num"
					value="<?php if($edit_row)echo $edit_row['num']?>" /></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><input type="text" name="description"
					value="<?php if($edit_row)echo $edit_row['description']?>" /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;"><input type="submit"
					value="Save" /></td>
			</tr>
		</table>
	</form>
	<table>
		<caption>test table</caption>
		<tr>
			<th>name</th>
			<th>num</th>
			<th>description</th>
		</tr>
    	<?php //print_r($rows);?>
        <?php foreach ($rows as $item):?>
        <tr>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['num'];?></td>
			<td><?php echo $item['description'];?></td>
			<td><a href="test.php?act=edit&edit_id=<?php echo $item['id']?>">Edit</a></td>
			<td><a href="test.php?act=del&id=<?php echo $item['id']?>">Delete</a></td>
		</tr>
        <?php endforeach;?>
    </table>
</body>
</html>




