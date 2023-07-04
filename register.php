<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="styleseet" type="text/css" href="./css/css/bootstrap.min.css"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="styles.css">

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
    else{
      echo "wrong id";
    }
    }


    ?>
    <script>

      var id = "<?php echo $id;?>";
      var type = "<?php echo $type;?>";
      
    </script>
</head>
<body>
<?php 
if(!isset($_GET['update'])){
$id = ""; $name=""; $email=""; $number=""; $password=""; $date=""; $address =""; $gender="";

}

?>
<div id="form-div"  style="border:1px solid black;background-color:whitesmoke;margin-top: 20px;">
<h3 style="text-align: center;">Welcome to register page</h3>


<h5 id="show-error"  style="color: red;"> </h5>
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
    <span>Male</span><input type="radio" name="gender" value="Male" id="male" class="gender" <?php if('Male'==$gender) echo 'checked'; ?>>
    <span>Female</span><input type="radio" name="gender" value="Female" id="female" class="gender" <?php if('Female'==$gender) echo 'checked'; ?>> <br>
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

<!-- <div id="table-container"></div> -->
<div id="data-container"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){

$("#submit").click(function(event) {
    event.preventDefault();

        let name = $("#name").val();
        let email = $("#email").val();
        let number = $("#number").val();
        let password = $("#password").val();
        let date = $("#date").val();
        let address = $("#address").val();
        var gender = $(".gender").val();

        var ele = document.getElementsByName('gender');
        var gen_value = "";

        for (i = 0; i < ele.length; i++) {
                ele[i].checked ? gen_value=ele[i].value : "error";
        } 

  $.ajax({
  method: "POST",
  url: "insert.php",
  data: {
        action:"insert", 
        fname:name,
        email:email,
        number:number,
        password:password,
        dob:date,
        address : address,
        gender:gen_value 
    }

    ,
    success: function(data){
    $('#data-container').html(data);
    location.reload();
    }
});

	});	
    $.ajax({
    method: "GET",
    url: "retrive.php",
    data: {action:"retrive"}
})
  .done( function( msg ) {

       $("#data-container").html(msg); 
	  
  });


    //delete data
						
    if( type == "delete"){
					$.ajax({
					  method: "POST",
                      url: "delete.php",
                      data: {action:"delete",deleteid:id}
})
  .done(function( msg ) {
      // alert(msg);
	  
	    if(msg != ""){
	  window.location.href = "register.php";
	  
  }
	
  });
}
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
                          gender:gen_value},
                          // success : function(){
                          //   location.reload(true)
                          // }

					  })

            .done(function( msg) {
                alert(msg);
                // location.reload(true);
                // window.location.href = "register.php";

                
                    if(msg != ""){
                window.location.href = "register.php";
                // location.reload(true);

                
            }
            });
  
	
}).done(function(){
  location.reload();
})


});

</script>

</body>
</html>