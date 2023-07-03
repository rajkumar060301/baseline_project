<?php
include './config/config.php';
$id = $_POST["id"];
$query = "delete from student where id = {$id}";
mysqli_query($myConnection,$query);
echo "Data Deleted Successfully";

?>