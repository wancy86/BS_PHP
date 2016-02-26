<?php
require_once "configs/configs.php";
// connect();
// echo "hello";

/**
 * 连接数据库
 *
 * @return resource
 */
$conn = null;

function connect()
{
    if ($GLOBALS['conn'] == null) {
        $GLOBALS['conn'] = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DBNAME) or die("数据库连接失败Error:" . mysql_errno() . ":" . mysql_error());
        // $link=mysqli_connect("127.0.0.1","root","111222","BoyStyle",'3306') or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
        // mysqli_set_charset($conn,DB_CHARSET);
        mysqli_set_charset($GLOBALS['conn'], "utf8");
        mysqli_select_db($GLOBALS['conn'], DB_DBNAME) or die("指定数据库打开失败");
    }
    return $GLOBALS['conn'];
}

/**
 * 完成记录插入的操作
 *
 * @param string $table            
 * @param array $array            
 * @return number
 */
function insert($table, $array)
{
    $keys = join(",", array_keys($array));
    $vals = "'" . join("','", array_values($array)) . "'";
    $sql = "insert {$table}($keys) values({$vals})";
    $link = connect();
    mysqli_query($link, $sql);
    return mysqli_insert_id($link);
}
// update imooc_admin set username='king' where id=1
/**
 * 记录的更新操作
 *
 * @param string $table            
 * @param array $array            
 * @param string $where            
 * @return number
 */
function update($table, $array, $where = null)
{
    foreach ($array as $key => $val) {
        if ($str == null) {
            $sep = "";
        } else {
            $sep = ",";
        }
        $str .= $sep . $key . "='" . $val . "'";
    }
    $sql = "update {$table} set {$str} " . ($where == null ? null : " where " . $where);
    $link = connect();
    $result = mysqli_query(connect(), $sql);
    // var_dump($result);
    // var_dump(mysql_affected_rows());exit;
    if ($result) {
        return mysqli_affected_rows(connect());
    } else {
        return false;
    }
}

/**
 * 删除记录
 *
 * @param string $table            
 * @param string $where            
 * @return number
 */
function delete($table, $where = null)
{
    $where = $where == null ? null : " where " . $where;
    $sql = "delete from {$table} {$where}";
    $link = connect();
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}

/**
 * 得到指定一条记录
 *
 * @param string $sql            
 * @param string $result_type            
 * @return multitype:
 */
function fetchOne($sql, $result_type = MYSQL_ASSOC)
{
    $result = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_array($result, $result_type);
    return $row;
}

/**
 * 得到结果集中所有记录 .
 *
 *
 * ..
 *
 * @param string $sql            
 * @param string $result_type            
 * @return multitype:
 */
function fetchAll($sql, $result_type = MYSQL_ASSOC)
{
    $result = mysqli_query(connect(), $sql);
    $rows = array();
    while (@$row = mysqli_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    
    // 测试
    // foreach ($rows as $row){
    // echo $row["id"] . $row["cName"];
    // echo "编码";
    // }
    
    return $rows;
}

/**
 * 得到结果集中的记录条数
 *
 * @param unknown_type $sql            
 * @return number
 */
function getResultNum($sql)
{
    $result = mysqli_query(connect(), $sql);
    return mysqli_num_rows($result);
}

/**
 * 得到上一步插入记录的ID号
 *
 * @return number
 */
function getInsertId()
{
    return mysqli_insert_id(connect());
}

