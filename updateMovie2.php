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
                echo "Here is the current information about this movie." . "<br>";
                $movieID = $row["Movie_ID"];
                $_SESSION['movieID'] = $movieID;
                echo "MovieID: " . $movieID . "<br>";
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
echo "Please type in any of updates to this movie below. Leave boxes you do not wish to update blank.";

$mysqli->close();
?>

<!DOCTYPE html>
<HTML>
    <body>

        <form action="updateMovie3.php" method="post">
        <p>Title: <input type="Title" name="Title"></p>
        <p>is Playing: <input type="isPlaying" name="isPlaying"></p>
        <p>Genre: <input type="Genre" name="Genre"></p>
        <p>IMdb rating: <input type="Rating" name="Rating"></p>
        <p> <input type="submit" name="submit" value="Submit"></p>
        
  
  </form>
    </body>
</html>