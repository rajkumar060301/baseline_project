<?php
        include './config/config.php';
        if($_POST["action"] == "registration"){
        $name = $_POST['fname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $query = "SELECT * FROM `student` WHERE `email` = '$email'";
        $result = mysqli_query($myConnection,$query);
        if (mysqli_num_rows($result) > 0) {
                    // echo "<script>alert('Email ID Already Exists !!')</script>";
                    echo 'Email ID Already Exists !!';
                }
                else{
                    $insert = "INSERT INTO `student`(`fname`,`email`,`number`,`password`,`dob`,`address`,`gender`) 
                    VALUES('$name','$email','$number','$password','$dob','$address','$gender')";
                    
                    if(mysqli_query($myConnection,$insert)){
                        // echo "<script>alert('Data inserted successfully !!')</script>";
                        echo 'Data inserted successfully !!';

                    }
                    else{
                    // echo "<script>alert('Data noy inserted successfully !!')</script>";
                    echo 'Data noy inserted successfully !!';

                    }

                }

            }
         
        
?>