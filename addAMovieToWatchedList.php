<?php
session_start();
$email=$_SESSION['login'];
$sql = "SELECT `Name` FROM `User` WHERE `Email_Address` LIKE '$login'";

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
}
?> 

<!-- <!DOCTYPE html>
<html lang="en"> -->
<?php

//returns all movie ids of the current user
$sql = "SELECT `MovieID` FROM `Watch_List` WHERE `Email_Address` LIKE '$email'";
$result = $mysqli->query($sql);
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{    //look up the ID's into movies to display
    echo "Here are the current movies that are on your watch list: " . "<br>";
    while($row = $result->fetch_assoc()) {
       $idd = $row["MovieID"];
       if ($idd != 0)
       {
       #echo $idd . " ";
       
       //returning the movie title from Movies table given MovieID
        $sql2 = "SELECT `Title` FROM `Movies` WHERE `Movie_ID` LIKE '$idd'";
        $result2 = $mysqli->query($sql2);
        
         while($row2 = $result2->fetch_assoc()) 
         {
             $titlee = $row2["Title"];
             echo $titlee. "<br>";
         }
       }
    }
}
       
//       //returning the movie title from Movies table given MovieID
//         $sql2 = "SELECT `Title` FROM `Movies` WHERE `Movie_ID` LIKE '$idd'";
//         $result2 = $mysqli->query($sql2);
        
//          while($row2 = $result2->fetch_assoc()) 
//          {
//              $titlee = $row2["Title"];
//              echo $titlee. "<br>";
//          }
//       }
//     }
// }

echo "</form>";

echo "<br> <br>";
echo "Now please enter the the following information of the movie you have seen and wish to put in your watched list. If you do not know the information, please insert N/A";

$mysqli->close();
?>

<!DOCTYPE html>
<HTML>
    <body>
        <form action="add.php" method="post">
        <p>Movie Title: <input type="Title" name="Title"></p>
        <p>Year Released: <input type="Year" name="Year"></p>
        <p>Genre: <input type="Genre" name="Genre"></p>
        <p>IMdb rating: <input type="Rating" name="Rating"></p>
        <p> <input type="submit" name="submit" value="Submit"></p>
        
  
  </form>
    </body>
</html>
