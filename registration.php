<?php
        include './config/config.php';
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
                    // $message = "Email ID Already Exists !!";
                    echo "<script>alert('Email ID Already Exists !!')</script>)";
                    echo "<script>location.href='signup.php'</script>";
                }
                else{
                    // echo "Data not found";
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

      
         
        
    



      

?>