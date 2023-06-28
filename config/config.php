<?php
define('LOCALHOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','rajkumar');

$myConnection = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE);

if(!$myConnection) echo "<script>alert('Database not connected')</script>";

$raja = "kamal";
?>