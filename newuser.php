<?php
session_start();

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

$name = $_POST["name"];
$password = $_POST["Password"];
$email = $_POST["Email_Address"];
$zipcode = $_POST["Zipcode"];

//IF EMAIL IS ALREADY IN DATABASE, HAVE THEM TYPE A NEW EMAIL
//check if email in database
$sqlcheck = "SELECT * FROM `User` WHERE `Email_Address` LIKE '$email'";
$result = $mysqli->query($sqlcheck);
if ($result->num_rows > 0) //email already in so try again
   { 
        echo "The email " . $email . " is already registered. Please enter a different email." . "<br>";
   }
else
{


$sql = "INSERT INTO `User` (`Name`, `Email_Address`, `Password`, `Zipcode`) VALUES ('$name', '$email', '$password', '$zipcode')";

if ($mysqli->query($sql) === TRUE) {
    //echo "New  record created successfully";
    $mysqli->close();
    
    $url='afterlogin.php';
    $_SESSION['login'] = $email;
    redirect($url);
    
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

//$result = $mysqli->query("INSERT INTO User VALUES ($name, $email, $password, //$zipcode)");
}
$mysqli->close(); 
?>
