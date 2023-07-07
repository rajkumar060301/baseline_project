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
            <td class="stud_id"><?php echo $row["id"];?></td>
            <td><?php echo $row["fname"];?></td>
            <td><?php echo $row["email"];?></td>
            <td><?php echo $row["number"];?></td>
            <td><?php echo $row["password"];?></td>
            <td><?php echo $row["dob"];?></td>
            <td><?php echo $row["address"];?></td>
            <td><?php echo $row["gender"];?></td>
            <td ><button id="<?php echo $row['id']; ?>" class="btn btn-danger delbutton">Delete</button></td>
            <td><button type="button" class="btn btn-success edit_btn" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#updateModalCenter">Update</button></td>

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
            $("tbody").on("click",".edit_btn", function (){
            let id = $(this).attr("data-id");
            var stud_id = id;
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'checking_edit': true,
                        'stud_id': stud_id,
                    },
                    success: function (response) {
                        $.each(response, function (key, studedit) { 
                            $('#id_edit').val(studedit['id']);
                            $('#update_name').val(studedit['fname']);
                            $('#update_email').val(studedit['email']);
                            $('#update_number').val(studedit['number']);
                            $('#update_password').val(studedit['password']);
                            $('#update_date').val(studedit['dob']);
                            $('#update_address').val(studedit['address']);
                            $('#gender').val(studedit['gender']);
                            var gender = document.getElementById('gender').value;
                            if(gender == "Male"){
                                document.getElementById('update_male').checked = true;

                            }
                            else{
                                document.getElementById('update_female').checked = true;

                            }
                            
                        });
                        $('#updateModalCenter').modal('show');
                    }
                });
                $("#update").click(function(e){
         e.preventDefault();
 
        let name = $("#update_name").val();
		let email = $("#update_email").val();
        let number = $("#update_number").val();
        let password = $("#update_password").val();
		let date = $("#update_date").val();
		let address = $("#update_address").val();
        var gender = $('.update_gender').val();
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
   

					  })

            .done(function(data) {
                alert(data);
                location.reload();
                // window.location.href = "register.php";

                    if(msg != ""){
                window.location.href = "register.php";

                
            }
            });

});


            });
            

        });

 </script>

  </div>
</div>
</body>
</html>