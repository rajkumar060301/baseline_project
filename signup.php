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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
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
		// let male = $("#male").val();
		// let female = $("#female").val();
        // let gender =  $("#gender").val();
		
		
		if(name == ""){
			$("#nameerr").html("Please enter Your Name");
			return false;
		}else if(!name.match(/^[a-zA-Z]+$/)){
			$("#nameerr").html("Only Alphabets are allowed");
				return false;
		}else{
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
        var gender = $('.gender').val();
        if ($(".gender:checked").length > 1 || $(".gender:checked").length == 0){
        $('#gendererr').slideDown().html('<span id="gendererr">Please choose a gender</span>');
        return false;
        }
        else{
        $("#gendererr").hide();
        }


	// Insert Data
$.ajax({
  method: "POST",
  url: "registration.php",
  data: {action:"insert", name:name, email:email,date:date, number:number, jobtype:jobtype , password:password }
})
 
	});	
});
</script> 
<div id="form-div" >
<h3>Welcome to register page</h3>
<h5 style="color: red;"></h5>
 <form id = "basic-form"  action="registration.php" method="post" >
    <label>Full name</label><span id="nameerr" class="error">* </span><br>
    <input id="name" name="fname" minlength="8" type="text" >
    <br>
    <label>Email</label><span id="emailerr" class="error">* </span><br>
    <input id="email" type="email" name="email" >
    <br>
    <label>Phone</label><span id="numbererr" class="error">* </span><br>
    <input id="number" type="text" name="number" >
    <br>
    <label>Password</label><span id="passworderr" class="error">* </span><br>
    <input id="password" type="password" name="password" >
    <br>
    <label>Date of Birth</label><span id="dateerr" class="error">* </span><br>
    <input id="date" type="date" name="dob" >
    <br>
    <label>Address</label><span id="addresserr" class="error">* </span><br>
    <input id="address" type="text" name="address" id="address" > 
    <br>
    <label>Gender</label><span id="gendererr" class="error">* </span><br><br>
    <span>Male</span><input type="radio" name="gender" value="male" id="male" class="gender">
    <span>Female</span><input type="radio" name="gender" value="female" id="female" class="gender"> <br>
    <br>
    <input id="submit" type="submit" name="sub" value="Register here">
    <br>
    <div class="text-center" style="color: black;">Already have an account? <a href="login.html">Login here</a></div>
 </form>
</div>

    
</body>
</html>