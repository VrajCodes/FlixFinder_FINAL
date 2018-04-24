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

$login=$_POST["login"];
$password=$_POST["password"];

$sql = "SELECT * FROM `User` WHERE `Email_Address` LIKE '$login'";
$result = $mysqli->query($sql);
//
if ($result->num_rows > 0) 
{ //good
    $sql2 = "SELECT * FROM  `User` WHERE `Email_Address` LIKE '$login' AND `Password` LIKE '$password'";
    $result2 = $mysqli->query($sql2);
    if ($result2->num_rows > 0) //good
   { 
        $mysqli->close();
        
        $url='afterlogin.php';
        $_SESSION['login'] = $login;
        redirect($url);
    }
    else
    {
        echo "Your UserName and/or Password is Incorrect! Please try again";
        
        #<a href="login.html"> <button>Go To Login</button></a>
       
        
    }
} else {
    echo "Your UserName and/or Password is Incorrect! Please try again";
        
        #<a href="login.html"> <button>Go To Login</button></a>
}

$mysqli->close();
?>
<!--<html-->
<!--    <body>-->
<!--    <br>-->
<!--    <a href="login.html"> <button>Go Back To Login</button></a>-->
    
<!--</body>-->
<!--</html>-->
    

