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

$query = "select * from student";
$result = mysqli_query($myConnection,$query);
		if(mysqli_num_rows($result)>0){
            // $number = 1;

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
            <td ><button id="<?php echo $row['id']; ?>" class="btn btn-danger delbutton">Delete</button></td>
            <!-- <td><button type="button" class="btn btn-danger" ><a href="register.php?id=<?php  echo $row["id"];?>&type=delete">Delete</a></button></td> -->
            <td><button id="update" type="button" class="btn btn-success" onclick="getUserDetails(<?php echo $row['id']; ?>)" data-toggle="modal" data-target="#myModal">Update</button></td>
            <!-- <td><button type="button" class="btn btn-success"><a href="register.php?id=<?php  echo $row["id"];?>&type=update&update=updateid">Update</a></button></td> -->

            <?php
     echo   "</tr>";
			}
    echo "</tbody>";
 echo "</table>";
//  $number++;
		}
		?>
        <script type="text/javascript" >

        $(function() {

            $(".delbutton").click(function() {
                var del_id = $(this).attr("id");
                var info = 'id=' + del_id;
                    $.ajax({
                        type : "POST",
                        url : "delete.php", //URL to the delete php script
                        data : info,
                        success : function() {
                            location.reload();
                        }
                    });
                   
                return false;
            });
        });
        
 </script>

<script>
    function getUserDetails(data) {
        // console.log(data);



        // document.getElementById('hide.btn').value = data;
        // document.cookie = "id=" + data;
        var myValue = data; // The JavaScript value you want to pass to PHP

        // var xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        // if (this.readyState == 4 && this.status == 200) {
        //     console.log("Value stored in PHP variable successfully!");
        // }
        // };
        // xhttp.open("POST", "register.php", true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhttp.send("myValue=" + encodeURIComponent(myValue));
        // window.location.href = "register.php?myValue=" + encodeURIComponent(myValue);



    }
</script>

<?php 
    // echo $row['id'];
    // $id = 236;
    // $myValue = $_POST['myValue']; // Retrieve the value from the AJAX request

    // Store the value in a PHP variable or perform any other desired operations
    $id = $_COOKIE['id']; // Retrieve the
    if(isset($id)){
    $id = $id;
    // $type = 'updateid';

    $query = "select * from `student` where `id` = {$id}";
    $result = mysqli_query($myConnection,$query);
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      $name = $row["fname"];
      $email= $row["email"];
      $number = $row["number"];
      $password = $row["password"];
      $date = $row["dob"];
      $address = $row["address"];
      $gender = $row["gender"];

    }
    else{
      echo "wrong id";
    }
    }

if(!isset($id)){
$id = ""; $name=""; $email=""; $number=""; $password=""; $date=""; $address =""; $gender="";

}

?>
    <!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-target="#myModal">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Modal Header</h4> -->
      </div>
      <div class="modal-body">
        <!-- <p>Some text in the modal.</p> -->
        <form id = "basic-form"  action="" method="post" >
    <label>Full name</label><span id="nameerr" class="error">* </span><br>
    <input id="update_name" name="fname" minlength="8" type="text" value="<?php if($name !=""){ echo $name; }?>">
    <br>
    <label>Email</label><span id="emailerr" class="error">* </span><br>
    <input id="update_email" type="email" name="email" value="<?php if($email !=""){ echo $email; }?>">
    <br>
    <label>Phone</label><span id="numbererr" class="error">* </span><br>
    <input id="update_number" type="text" name="number"  value="<?php if($number !=""){ echo $number; }?>">
    <br>
    <label>Password</label><span id="passworderr" class="error">* </span><br>
    <input id="update_password" type="password" name="password" value="<?php if($password !=""){ echo $password; }?>">
    <br>
    <label>Date of Birth</label><span id="dateerr" class="error">* </span><br>
    <input id="update_date" type="date" name="dob" value="<?php if($date !=""){ echo $date; }?>">
    <br>
    <label>Address</label><span id="addresserr" class="error">* </span><br>
    <input id="update_address" type="text" name="address" id="address" value="<?php if($address != ""){ echo $address;} ?>"> 
    <br>
    <label>Gender</label><span id="gendererr" class="error">* </span><br>
    <span>Male</span><input type="radio" name="gender" value="Male" id="male" class="gender" <?php if('Male'==$gender) echo 'checked'; ?>>
    <span>Female</span><input type="radio" name="gender" value="Female" id="female" class="gender" <?php if('Female'==$gender) echo 'checked'; ?>> <br>
    <br>
            
    <div class="form-group">
        <button type="button" id="update"  class="btn btn-primary btn-block" onclick="updateUserDetail()"> Update</button>
    </div>   
    <br>
    <!-- <div class="text-center" style="color: black;">Already have an account? <a href="login.html" style="color:blue">Login here</a></div> -->
<!-- <input id="hide.btn" type="hidden" name="btn_value" value="" />   -->

</form>


      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal"  >Close</button>
      </div>
      <!-- <?php echo $id; ?> -->

      <?php 
        echo $id; ?>
    </div>
    <div id="show_id" ></div>


  </div>
</div>
</body>
</html>