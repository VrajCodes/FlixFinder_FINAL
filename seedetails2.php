<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

$titleToSearch =$_POST["MovieName"];

$sql = "SELECT * FROM  Movies";
$result = $mysqli->query($sql);
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
    $found = 0;
    while($found != 1)
    {
        while($row = $result->fetch_assoc()) 
         {
             if (strcasecmp($row["Title"], $titleToSearch) == 0)
            //if($row["Title"] == $titleToSearch)
            {$found = 1;}
            if($found == 1)
            {
                echo "MovieID: " . $row["Movie_ID"] . "<br>";
                echo "Title: " . $row["Title"] . "<br>";
                echo "isPlaying: " . $row["Now_Playing"] . "<br>";
                echo "Genre: " . $row["Genre"] . "<br>";
                echo "Rating: " . $row["Rating"] . "<br>";
                break;
            }
         }
         break;
    }
    if($found == 0)
         {
             echo "The movie " . $titleToSearch . " does not exist";
         }
}
echo "<br>";
$mysqli->close();
?>

<!DOCTYPE html>
<HTML>
    <body>
            <a href="SeeDetails.php"><button>Get More Info On Another Movie</button></a>
            
            <a href="afterlogin.php"><button>Home</button></a>
            
        </body>
</html>