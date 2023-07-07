<?php
include './config/config.php';

$id = $_POST["updateid"];
$name = $_POST['fname'];
$email = $_POST['email'];
$number = $_POST['number'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$gender = $_POST['gender'];

$query = "UPDATE `student` SET `fname`='$name',`email`='$email',`number`='$number',`password`='$password',`dob`='$dob', `address` = '$address', `gender` = '$gender' WHERE id = {$id}";
mysqli_query($myConnection,$query);
echo "Data Updated SuccessFully";



?>