<html>
<head>
<style>
a{text-decoration:none; color:white}
a:hover{text-decoration:none; color:white}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<script>

$(document).ready(function () {
    $('#example').DataTable();
	
});
</script>

</head>
<body>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Password</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Delete Data</th>
            <th>Update Data</th>
        </tr>
    </thead>
    <tbody>

<?php
include './config/config.php';
if($_POST["action"] == "insert"){
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
                echo 'Email ID Already Exists !!';
                $query = "select * from student";
                $result = mysqli_query($myConnection,$query);
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
				?>
			
	
        <tr>
            <td><?php echo $row["id"];?></td>
            <td><?php echo $row["fname"];?></td>
            <td><?php echo $row["email"];?></td>
            <td><?php echo $row["number"];?></td>
            <td><?php echo $row["password"];?></td>
            <td><?php echo $row["dob"];?></td>
            <td><?php echo $row["address"];?></td>
            <td><?php echo $row["gender"];?></td>
            <td><button type="button" class="btn btn-danger" ><a href="register.php?id=<?php  echo $row["id"];?>&type=delete">Delete</a></button></td>
            <td><button type="button" class="btn btn-success"><a href="register.php?id=<?php  echo $row["id"];?>&type=update&update=updateid">Update</a></button></td>
			<?php
            echo   "</tr>";
                                    }

            echo "</tbody>";
            echo "</table>";
                                        


                        }

            }
            else{

                $insert = "INSERT INTO `student`(`fname`,`email`,`number`,`password`,`dob`,`address`,`gender`) 
                VALUES('$name','$email','$number','$password','$dob','$address','$gender')";
                
                if(mysqli_query($myConnection,$insert)){

                $query = "select * from student";
                $result = mysqli_query($myConnection,$query);
                        if(mysqli_num_rows($result)>0){
                            echo 'Data inserted successfully !!';
                            while($row = mysqli_fetch_assoc($result)){
				?>
			
	
        <tr>
            <td><?php echo $row["id"];?></td>
            <td><?php echo $row["fname"];?></td>
            <td><?php echo $row["email"];?></td>
            <td><?php echo $row["number"];?></td>
            <td><?php echo $row["password"];?></td>
            <td><?php echo $row["dob"];?></td>
            <td><?php echo $row["address"];?></td>
            <td><?php echo $row["gender"];?></td>
            <td><button type="button" class="btn btn-danger" ><a href="register.php?id=<?php  echo $row["id"];?>&type=delete">Delete</a></button></td>
            <td><button type="button" class="btn btn-success"><a href="register.php?id=<?php  echo $row["id"];?>&type=update&update=updateid">Update</a></button></td>
			<?php
            echo   "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
                            


                        }
    else{
    echo 'Data not inserted successfully !!';

    }

}
}

}
		?>
</body>
</html>