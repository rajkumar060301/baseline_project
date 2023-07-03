<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src='javascript/script.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<?php
include './config/config.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$type = $_GET['type'];

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


?>
<script>

 	var id = "<?php echo $id;?>";
	var type = "<?php echo $type;?>";
	
</script>
<?php
}
?>




</head>
<body>

<?php 
if(!isset($_GET['update'])){
$id = ""; $name=""; $email=""; $number=""; $password=""; $date=""; $address =""; $gender="";

}

?>
<div id="form-div"  style="border:1px solid black;background-color:whitesmoke">
<h3 style="text-align: center;">Welcome to register page</h3>
<h5 style="color: red;"></h5>
 <form id = "basic-form"  action="" method="post" >
    <label>Full name</label><span id="nameerr" class="error">* </span><br>
    <input id="name" name="fname" minlength="8" type="text" value="<?php if($name !=""){ echo $name; }?>">
    <br>
    <label>Email</label><span id="emailerr" class="error">* </span><br>
    <input id="email" type="email" name="email" value="<?php if($email !=""){ echo $email; }?>">
    <br>
    <label>Phone</label><span id="numbererr" class="error">* </span><br>
    <input id="number" type="text" name="number"  value="<?php if($number !=""){ echo $number; }?>">
    <br>
    <label>Password</label><span id="passworderr" class="error">* </span><br>
    <input id="password" type="password" name="password" value="<?php if($password !=""){ echo $password; }?>">
    <br>
    <label>Date of Birth</label><span id="dateerr" class="error">* </span><br>
    <input id="date" type="date" name="dob" value="<?php if($date !=""){ echo $date; }?>">
    <br>
    <label>Address</label><span id="addresserr" class="error">* </span><br>
    <input id="address" type="text" name="address" id="address" value="<?php if($address != ""){ echo $address;} ?>"> 
    <br>
    <label>Gender</label><span id="gendererr" class="error">* </span><br>
    <span>Male</span><input type="radio" name="gender" value="Male" id="male" class="gender">
    <span>Female</span><input type="radio" name="gender" value="Female" id="female" class="gender"> <br>
    <br>
    <!-- <input id="submit" type="submit" name="sub" value="Register here"> -->
			
    <!-- <div class="form-group">
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block"> Register here  </button>
    </div> -->
    <?php if( $id !="" and $type == "update"){  ?>             
    <div class="form-group">
        <button type="submit" id="update" class="btn btn-primary btn-block"> Update</button>
    </div>   
<?php 
					}else{
?>						
            <div class="form-group">
        <button type="submit" id="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div>  
<?php 
					}
?>
    <br>
    <div class="text-center" style="color: black;">Already have an account? <a href="login.html" style="color:blue">Login here</a></div>
 </form>
</div>

<div id="table-container"></div>
<div id="data-container"></div>



<script>  
// $(document).ready (function () {  
//   $("#basic-form").validate ();  
// });


$(document).ready(function(){

$("#submit").click(function() {

		let name = $("#name").val();
		let email = $("#email").val();
        let number = $("#number").val();
        let password = $("#password").val();
		let date = $("#date").val();
		let address = $("#address").val();
        var gender = $(".gender").val();

        var ele = document.getElementsByName('gender');
        var gen_value = "";
        // with apply only conditions
        // if(document.getElementById('male').checked) {
        //         gen_value = document.getElementById("male").value;
        //     }
        //     else {
        //         gen_value = document.getElementById("female").value;
        //     }
        
        // with apply only looping
        for (i = 0; i < ele.length; i++) {
                ele[i].checked ? gen_value=ele[i].value : "error";

        }

        // with apply both conditions and looping
        // for (i = 0; i < ele.length; i++) {
        //     if (ele[i].checked)
        //         gen_value =  ele[i].value;
        // }

        // apply without looping and conditions
        // var gen_value = $('input[type="radio"][name="gender"]:checked');
        // console.log(gen_value.val());
        // console.log(gen_value);


		
		if(name == ""){
			$("#nameerr").html("Please enter Your Name");
			return false;
		}

        else{
			$("#nameerr").hide();
		}
		
		if(email == ""){
			$("#emailerr").html("Please Enter Email");
				return false;
		}else{
			$("#emailerr").hide();
		}
		
        if(number ==""){
			$("#numbererr").html("Please Enter Mobile Number");
				return false;
		}
		else if (number.length != 10){
				$("#numbererr").html(" Mobile Number is not valid");
					return false;
		}
		else{
			$("#numbererr").hide();
		}
        if(password == ""){
			$("#passworderr").html("Please Enter Password")
			return false;
		} else if (!password.match(/[!@#$%^&*]+$/) ){
			$("#passworderr").html("Please enter Strong Password")
			return false;
		}
		else{
			$("#passworderr").hide()
		}
        var selectedDate = new Date($("#date").val());
        var currentDate = new Date();
        var minDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());
		
			if(date == ""){
			$("#dateerr").html("Please Enter DOB");
				return false;
		}
        
        else if (selectedDate > minDate) {
         $("#dateerr").html("You must be 18 years or older.");
		 	return false;
        } else{
			$("#dateerr").hide();
		}
        if(address == ""){
            $("#addresserr").html("Please Enter Address");
            return false;
        }
        else{
            $("#addresserr").hide();
        }
        if ($(".gender:checked").length > 1 || $(".gender:checked").length == 0){
        $('#gendererr').html("Please Enter Gender");
        return false;
        }
        else{
        $("#gendererr").hide();
        }

	// Insert Data
    $.ajax({
  method: "POST",
  url: "registration.php",
  data: {
        action:"registration", 
        fname:name,
        email:email,
        number:number,
        password:password,
        dob:date,
        address : address,
        gender:gen_value 
    },
    success: function(data){
       console.log(data);
    }
}).done(function(data){
    alert(data);
    // document.getElementById('data-container').innerHTML = data;
});
 
	});	
    // Select Data 
		
  $.ajax({
  method: "GET",
  url: "retrive.php",
  data: {action:"retrive"}
})
  .done( function( msg ) {

       $("#table-container").html(msg); 
	  
  });
  //delete data
						
  if( type == "delete"){
					$.ajax({
					  method: "POST",
                      url: "delete.php",
                      data: {action:"delete",deleteid:id}
})
  .done(function( msg ) {
      alert(msg);
	  
	    if(msg != ""){
	  window.location.href = "signup.php";
	  
  }
	
  });
}
					
					
	// Update Data 	

	
$("#update").click(function(e){
    let name = $("#name").val();
		let email = $("#email").val();
        let number = $("#number").val();
        let password = $("#password").val();
		let date = $("#date").val();
		let address = $("#address").val();
        var gender = $('.gender').val();

        var ele = document.getElementsByName('gender');
        var gen_value = "";
        for (i = 0; i < ele.length; i++) {
            if (ele[i].checked)
                gen_value =  ele[i].value;
        }
		
		if(name == ""){
			$("#nameerr").html("Please enter Your Name");
			return false;
		}

        else{
			$("#nameerr").hide();
		}
		
		if(email == ""){
			$("#emailerr").html("Please Enter Email");
				return false;
		}else{
			$("#emailerr").hide();
		}
		
        if(number ==""){
			$("#numbererr").html("Please Enter Mobile Number");
				return false;
		}
		else if (number.length != 10){
				$("#numbererr").html(" Mobile Number is not valid");
					return false;
		}
		else{
			$("#numbererr").hide();
		}
        if(password == ""){
			$("#passworderr").html("Please Enter Password")
			return false;
		} else if (!password.match(/[!@#$%^&*]+$/) ){
			$("#passworderr").html("Please enter Strong Password")
			return false;
		}
		else{
			$("#passworderr").hide()
		}
        var selectedDate = new Date($("#date").val());
        var currentDate = new Date();
        var minDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());
		
			if(date == ""){
			$("#dateerr").html("Please Enter DOB");
				return false;
		}
        
        else if (selectedDate > minDate) {
         $("#dateerr").html("You must be 18 years or older.");
		 	return false;
        } else{
			$("#dateerr").hide();
		}
        if(address == ""){
            $("#addresserr").html("Please Enter Address");
            return false;
        }
        else{
            $("#addresserr").hide();
        }
        if ($(".gender:checked").length > 1 || $(".gender:checked").length == 0){
        $('#gendererr').slideDown().html('<span id="gendererr">Please choose a gender</span>');
        return false;
        }
        else{
        $("#gendererr").hide();
        }
		
		$.ajax({
					  method: "POST",
                      url: "update.php",
                      data: {
                        action:"update",
                        updateid:id, 
                        fname:name,
                         email:email,
                         number:number, 
                         password:password, 
                         dob:date, 
                         address : address,
                          gender:gen_value}
					  })

            .done(function( msg ) {
                alert(msg);
                
                    if(msg != ""){
                window.location.href = "signup.php";
                
            }
            });
  
	
});
});
</script> 
    
</body>
</html>