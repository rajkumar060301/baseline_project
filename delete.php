<?php
include './config/config.php';
$id = $_POST["deleteid"];
$query = "delete from student where id = {$id}";
mysqli_query($myConnection,$query);
echo "Data Deleted Successfully";

?>