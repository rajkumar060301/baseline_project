<?php
session_start();
$id = $_SESSION['teamID'];
include "config/config.php";


if(isset($_SESSION['teamID'])){
    
    $fetch_query = "SELECT * FROM `student` where id=".$id;

    $data = mysqli_query($myConnection, $fetch_query);


}
else{
    echo "server error";
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
    </head>
    <body>
    <h3>Welcome to Home Page page</h3>
    <a href="logout.php"><button>LOG OUT</button></a>
    <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          ID
                      </th>
                      <th style="width: 5%">
                          Full name
                      </th>
                      <th style="width: 5%">
                          Email
                      </th>
                      <th style="width: 5%">
                          Phone
                      </th>
                      <th style="width: 5%">
                        Password
                      </th>
                      <th style="width: 5%">
                      DOB
                      </th>
                      <th style="width: 5%">
                      Address
                      </th>
                      <th style="width: 5%">
                      Gender
                      </th>
                      <th style="width: 5%">
                      Edit
                      </th>
                      <th style="width: 5%">
                      Delete
                      </th>
                  </tr>
              </thead>

  <?php
if(mysqli_num_rows($data)>0){

    while($row = mysqli_fetch_array($data)){
        echo"<tr style='text-align:center'>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['fname']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['number']."</td>";
        echo "<td>".$row['password']."</td>";
        echo "<td>".$row['dob']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo '<td><a href="#">Edit</a></td>';
        echo '<td><a href="#">Delete</a></td>';
        echo "</tr>";
    }
} else {
    echo "Record Not found";
}


?>
          </table>

    
        
    </body>
    </html>
