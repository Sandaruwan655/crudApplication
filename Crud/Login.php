<?php
    session_start();

    //Aleady logged in
    if (isset($_SESSION['loggedIN'])) {
      header('Location: Table.php');
      exit();

    }

if (isset($_POST['Login'])){
  $conn = new mysqli("localhost","root","","crud");

  $Email = $conn->real_escape_string($_POST['EmailPHP']);
  $Password = $conn->real_escape_string($_POST['PasswordPHP']);

  $data = $conn->query("SELECT id FROM users WHERE Email='$Email' AND Password='$Password'");
  if ($data->num_rows > 0){

    //Lets login
    $_SESSION['loggedIN'] = '1';
    $_SESSION['Email'] = $Email;
    $_SESSION['Password'] = $Password;

    exit('<font color="green">Login Success..!</font>');
  }else
  exit('<font color="red">Please check your inputs..!</font>');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  width: 25%;
	border-radius: 20px;
	box-shadow: 0 5px 5px rgba(0,0,0,.4);
	margin: 10em auto;
  padding: 1.5em;
  background-color: rgb(201, 253, 253);
}

</style>

    <title>LogIn</title>
</head>

<body>

    <form>
      <h2 class="text-primary">Member Login</h2>
      <div class="mb-3">
        <label for="Email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="Email" placeholder="Email">
        
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" class="form-control" id="Password" placeholder="Password">
      </div>
      <button type="button" id="Login" value="Log In" class="btn btn-primary">LogIn</button>
      <a href="SignUp.php"><button type="button" id="Signup"  class="btn btn-primary">Sign Up</button></a>
      <br><br>
      <p id="response"></p>
      
    </form>
    

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).ready(function () {
$("#Login").on('click', function (){
        var Email = $("#Email").val();
        var Password = $("#Password").val();
        
        if(Email == "" || Password == "")
        alert('Please check your inputs.!');
        else {
          $.ajax(
          {
            url: 'Login.php',
            method: 'POST',
            data: {
              Login: 1,
              EmailPHP: Email,
              PasswordPHP: Password
            },
            success: function (response) {
              $("#response").html(response);

              if (response.indexOf('success') >= 0)
              window.location = 'Table.php';
            },
            dataType: 'text'
          }
        );
        }  
    });
   });

</script>
</body>
</html>