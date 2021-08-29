<?php
$alert="";
     if (isset($_POST["SignUp"])) {
       $conn = new mysqli("localhost", "root", "", "crud");

       $FirstName = $conn->real_escape_string($_POST["FirstName"]);
       $LastName = $conn->real_escape_string($_POST["LastName"]);
       $PhoneNumber = $conn->real_escape_string($_POST["PhoneNumber"]);
       $Email = $conn->real_escape_string($_POST["Email"]);
       $Password = $conn->real_escape_string($_POST["Password"]);

       if($FirstName==""|| $LastName=="" || $PhoneNumber=="" || $Email=="" || $Password==""){
        $alert="<font color='red'>Missing user inputs</font>";
       
      }
      else{
        $data = $conn->query("SELECT ID FROM users WHERE Email='$Email'");
        if($data->num_rows >0){
          $alert="<font color='red'>Email already exist.!</font>";
        }
        else{
          $data = $conn->query("INSERT INTO users (FirstName, LastName, PhoneNumber, Email, Password) 
        VALUES ('$FirstName', '$LastName', '$PhoneNumber', '$Email', '$Password')");{
          $alert="Registation Success, Click to login here";
        }
        }
      }
     
       
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/38693eec21.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <style>
body{
    background-color: rgb(187, 187, 187);
    font-family: 'Open Sans', sans-serif;
}

form{
  width: auto;
	border-radius: 20px;
	box-shadow: 0 5px 5px rgba(0,0,0,.4);
  padding: 2em;
   background-color: rgb(201, 253, 253);
}
#rg-head{
  margin: 10% 10%;
}
    </style>
</head>
<body>

 
<div class="container">

<div id="rg-head">
   <form action="SignUp.php" method="post" class="row g-3">
    <h2 class="text-primary"><i class="fas fa-user"></i>&nbsp;Sign Up</h2><br>
    <div class="col-md-6">
      <input type="text" name="FirstName" class="form-control" placeholder="First Name">
    </div>
    <div class="col-md-6">
      <input type="text" name="LastName" class="form-control"  placeholder="Last Name">
    </div>
    <div class="col-8">
      <input type="tel" name="PhoneNumber" class="form-control" placeholder="Phone Number">
    </div>
    <div class="col-8">
      <input type="email" name="Email" class="form-control" placeholder="Email">
    </div>
    <div class="col-8">
      <input type="password" name="Password" class="form-control" placeholder="Password">
    </div>
    <div class="col-12">
      <button type="submit" name="SignUp" value="SignUp" class="btn btn-primary">Sign Up</button>
    </div>
    <div>
    <?php 
    if ($alert != "") echo $alert . "<br>"

?>
<a href="Login.php">
<button type="button" class="btn btn-success mt-2">Log In</button>
</a>
    </div>
    </div>

   </form>
</div>
    
    
</body>
</html>