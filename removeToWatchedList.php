<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" type="text/css" href="allbacks.css">
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


//returns all movie ids of the current user
$sql = "SELECT `MovieID` FROM `Watch_List` WHERE `Email_Address` LIKE '$email'";
$result = $mysqli->query($sql);
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
    //look up the ID's into movies to display
    echo "Here are the current movies that are on your watch list: </h3>" . "<br>";
    while($row = $result->fetch_assoc()) {
       $idd = $row["MovieID"];
       if($idd != 0)
       {
       //echo $idd . " ";
       
       //returning the movie title from Movies table given MovieID
        $sql2 = "SELECT * FROM `Movies` WHERE `Movie_ID` LIKE '$idd'";
        $result2 = $mysqli->query($sql2);
        echo "<form action='removeFromWatchList.php' method='post'>";
         while($row2 = $result2->fetch_assoc()) 
         {
             echo " <input type='checkbox' value='".$row2['Movie_ID']."' name='checkedBoxes[]'/> ".$row2['Title']. "<br>";
             //$titlee = $row2["Title"];
             //echo $titlee. "<br>";
         }

       }
    }
    echo "<input type='submit' name = 'submit' value='Remove'>";
        echo "</form>"; 
}

//echo "</form>";

//echo "<br> <br>";
//echo "Now please enter the title of the movie in your watch list that you wish to remove. *Your watch list is above*";

$mysqli->close();
?>


<!--<HTML>
    <body>
        <form action="removeFromWatchList.php" method="post">
        <p>Movie Title: <input type="Title" name="Title"></p>
        <p> <input type="submit" name="submit" value="Submit"></p>
        
        </form>
    </body>-->
</html>



