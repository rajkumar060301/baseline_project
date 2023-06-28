<?php
include './config/config.php';
// $name = $_POST['fname'];
// $email = $_POST['email'];
// $number = $_POST['number'];
// $password = $_POST['password'];
// $dob = $_POST['dob'];
// $address = $_POST['address'];
// $gender = $_POST['gender'];

$nameErr = $emailErr= $numberErr= $passwordErr= $dobErr=$addressErr=$genderErr ='';
$name = $email= $number= $password=$address=$gender ='';
$dob = '0000-00-00';
$message ='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['fname'])){
        $nameErr = "Name is requred";
    }
    else{
        $name = test_input($_POST['fname']);
    }
    if(empty($_POST['email'])){
        $emailErr = "email is requred";
    }
    else{
        $email = $_POST['email'];
        }
    if(empty($_POST['number'])){
        $numberErr = "number is requred";
    }
    else{
        $number = $_POST['number'];
    }
    if(empty($_POST['password'])){
        $passwordErr = "password is requred";
    }
    else{
        $password = $_POST['password'];
    }
    if(empty($_POST['dob'])){
        $dobErr = "dob is requred";
    }
    else{
        $dob = $_POST['dob'];
    }
    if(empty($_POST['address'])){
        $addressErr = "address is requred";
    }
    else{
        $address = $_POST['address'];
    }
    if(empty($_POST['gender'])){
        $genderErr = "gender is requred";
    }
    else{
        $gender = $_POST['gender'];
    }

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


    if($name != '' && $email != '' && $number != '' && $password != '' && $dob != '0000-00-00' && $address != '' && $gender != ''){
        $query = "SELECT * FROM `student` WHERE `email` = '$email'";
        $result = mysqli_query($myConnection,$query);
        if (mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         if($email==isset($row['email'])){
                $message = "Email ID Already Exists !!";
                // echo "<script>alert('Email ID Already Exists !!')</script>)";
                // echo "<script>location.href='register.php'</script>";
         }
         else{
            echo "Data not found";
         }
        }
    
        else{
            $insert = "INSERT INTO `student`(`fname`,`email`,`number`,`password`,`dob`,`address`,`gender`) 
            VALUES('$name','$email','$number','$password','$dob','$address','$gender')";
            
            if(mysqli_query($myConnection,$insert)){
                echo "<script>alert('Data inserted successfully !!')</script>";
                // $message = "Data Inserted";
                echo "<script>location.href='login.html'</script>";
            
            }
            else{
            echo "Data Not Inserted";
            }
        }
    

      }
      

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src='javascript/script.js'></script>
</head>
<body>
<div id="form-div" >
<h3>Welcome to register page</h3>
<h5 style="color: red;"><?php echo $message; ?></h5>
 <form  action="" method="post" >
    <label>Full name</label><span class="error">* <?php echo $nameErr;?></span><br>
    <input type="text" name="fname">
    <br>
    <label>Email</label><span class="error">* <?php echo $emailErr;?></span><br>
    <input type="email" name="email">
    <br>
    <label>Phone</label><span class="error">* <?php echo $numberErr;?></span><br>
    <input type="text" name="number">
    <br>
    <label>Password</label><span class="error">* <?php echo $passwordErr;?></span><br>
    <input type="password" name="password">
    <br>
    <label>Date of Birth</label><span class="error">* <?php echo $dobErr;?></span><br>
    <input type="date" name="dob">
    <br>
    <label>Address</label><span class="error">* <?php echo $addressErr;?></span><br>
    <input type="text" name="address">
    <br>
    <label>Gender</label><span class="error">* <?php echo $genderErr;?></span><br><br>
    <span>Male</span><input type="radio" name="gender" value="male">
    <span>Female</span><input type="radio" name="gender" value="female"><br>
    <br>
    <input type="submit" name="sub" value="Register here">
    <br>
    <div class="text-center" style="color: black;">Already have an account? <a href="login.html">Login here</a></div>
 </form>
</div>



    
</body>
</html>