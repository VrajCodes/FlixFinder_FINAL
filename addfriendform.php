<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

?> 

<?php

$email_form=$_POST["Email_Address"];

 $sqladdfriend1 = "INSERT INTO `Friends_List` (`email_user`, `email_friend`) VALUES ('$email', '$email_form')";
        if ($mysqli->query($sqladdfriend1) === TRUE) 
        {
            echo "Congratulations! Your Friend " . $email_form . " has been added to your friends list";
        
            
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        
 $sqladdfriend2 = "INSERT INTO `Friends_List` (`email_user`, `email_friend`) VALUES ('$email_form', '$email')";
    $mysqli->query($sqladdfriend2)
    
?>

<!DOCTYPE html>
<HTML>
    <body>
          <p>Click here to go back home</p>
            <a href="afterlogin.php"><button>Go Home</button></a>

    </body>
</html>