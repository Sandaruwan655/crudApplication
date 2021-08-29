<?php
$conn = new mysqli("localhost","root","","crud");
if($conn->connect_error){
  die("Connection Failed.!".conn->connect_error);
}

$result = array('error'=>false);
$action = '';

if(isset($_GET['action'])){
  $action = $_GET['action'];
}

if($action == 'read'){
  $sql = $conn->query("SELECT * FROM users");
  $users = array();
  while($row = $sql->fetch_assoc()){
    array_push($users, $row);
  }
  $result['users'] = $users;
}

if($action == 'create'){
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $PhoneNumber = $_POST['PhoneNumber'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];

  $sql = $conn->query("INSERT INTO users (FirstName,LastName,PhoneNumber,Email,Password)
  VALUES ('$FirstName','$LastName','$PhoneNumber','$Email','$Password')");

  if($sql){
    $result['message'] = "User added successfully..!!";
  }
  else{
    $result['error'] = true;
    $result['message'] = "Failed to add user..!";
  }
}

if($action == 'update'){
  $ID = $_POST['ID'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $PhoneNumber = $_POST['PhoneNumber'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];


  $sql = $conn->query("UPDATE users SET FirstName='$FirstName',LastName='$LastName',
  PhoneNumber='$PhoneNumber',Email='$Email',Password='$Password' WHERE ID='$ID'");

  if($sql){
    $result['message'] = "User updated successfully..!!";
  }
  else{
    $result['error'] = true;
    $result['message'] = "Failed to update user..!";
  }
}

if($action == 'delete'){
  $ID = $_POST['ID'];

  $sql = $conn->query("DELETE FROM users WHERE ID='$ID'");

  if($sql){
    $result['message'] = "User deleted successfully..!!";
  }
  else{
    $result['error'] = true;
    $result['message'] = "Failed to delete user..!";
  }
}

$conn->close();
echo json_encode($result);
?>