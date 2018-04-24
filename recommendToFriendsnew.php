<?php
session_start();
$email=$_SESSION['login'];
$sql = "SELECT `Name` FROM `User` WHERE `Email_Address` LIKE '$login'";

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
}

echo "Type in a movie that you wish to recommend to your friends. If you do not know all the information, leave it blank" . "<br>" . "<br>";

$mysqli->close();
?>

<!DOCTYPE html>
<HTML>
    <body>
        <link rel="stylesheet" type="text/css" href="allbacks.css">
        <form action="recToFriendsnew2.php" method="post">
        <p>Movie Title: <input type="Title" name="Title"></p>
        <p>Year Released: <input type="Year" name="Year"></p>
        <p>Genre: <input type="Genre" name="Genre"></p>
        <p>IMdb rating: <input type="Rating" name="Rating"></p>
        <p> <input type="submit" name="submit" value="Submit"></p>
        
  
  </form>
    </body>
</html>
