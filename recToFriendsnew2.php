<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

$title=$_POST["Title"];
$year=$_POST["Year"];
$genre=$_POST["Genre"];
$rating=$_POST["Rating"];

//check if movie is in movies table, if not insert
$sqlCheck = "SELECT Title FROM `Movies` WHERE `Title` LIKE '$title'";
$result = $mysqli->query($sqlCheck);

if ($result->num_rows > 0) 
{ //in table so add so add to recomm table

    //get movieID of this title
    $sqlGetID = "SELECT Movie_ID FROM Movies WHERE Title LIKE '$title'";
    $res = $mysqli->query($sqlGetID);
    
    if ($res->num_rows > 0) 
    { 
        while($row = $res->fetch_assoc()) {
            $movID = $row["Movie_ID"];
            
        }
    }
    
    
    $sqlAddToRecc = "INSERT INTO `FriendsRecommend` (`email_address`, `movieIDRecom`) VALUES ('$email', '$movID')";
    if ($mysqli->query($sqlAddToRecc) === TRUE) 
        {
            echo "Congratulations! The movie " . $title . " has been posted for your friends to see";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
}
else
{
    $nummovies = 0;
    $sqlGetNumMovies = "SELECT Title FROM Movies";
    $result3 = $mysqli->query($sqlGetNumMovies);
    
    if ($result3->num_rows > 0) 
    { 
        while($row = $result3->fetch_assoc()) {
            $nummovies = $nummovies + 1;
        }
    }
    
    //insert into table with movieId = nummovies +1
    $nummovies = $nummovies + 1;
    $sqlInsert = "INSERT INTO `Movies` (`Movie_ID`, `Title`, `Now_Playing`, `Genre`, `Rating`) VALUES ('$nummovies', '$title', '0', '$genre', '$rating')";
    
    if ($mysqli->query($sqlInsert) === TRUE) 
    {
         $sqlAddToRecc = "INSERT INTO `FriendsRecommend` (`email_address`, `movieIDRecom`) VALUES ('$email', '$nummovies')";
        if ($mysqli->query($sqlAddToRecc) === TRUE) 
        {
            echo "Congratulations! The movie " . $title . " has been posted for your friends to see";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>
