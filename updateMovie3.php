<?php
session_start();
$email=$_SESSION['login'];
$movieID=$_SESSION['movieID'];

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

$title=$_POST["Title"];
$isPlaying = $_POST["isPlaying"];
$genre=$_POST["Genre"];
$rating=$_POST["Rating"];

if($title !== '')
{
    //update title
    $sqlUpdateTitle = "UPDATE `Movies` SET `Title` = '$title' WHERE `Movies`.`Movie_ID` = $movieID";
    
    if ($mysqli->query($sqlUpdateTitle) === TRUE) 
    {
        //echo "updated title" . "<br>";
        $titleSuccess = 1;
        $_SESSION['TitleSuccess'] = $titleSuccess;
    } else {
        $titleSuccess = 0;
        $_SESSION['TitleSuccess'] = $titleSuccess;
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
else
{
    $titleSuccess = 2;
    $_SESSION['TitleSuccess'] = $titleSuccess;
}

if($isPlaying !== '')
{
    //update isPlaying
    $sqlUpdatePlaying = "UPDATE `Movies` SET `Now_Playing` = $isPlaying WHERE `Movies`.`Movie_ID` =  $movieID";
    
    if ($mysqli->query($sqlUpdatePlaying) === TRUE) 
    {
        //echo "updated is playing" . "<br>";
        $isPlaySuccess = 1;
        $_SESSION['isPlaySuccess'] = $isPlaySuccess;
    } else {
        $isPlaySuccess = 0;
        $_SESSION['isPlaySuccess'] = $isPlaySuccess;
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
else
{
    $isPlaySuccess = 2;
    $_SESSION['isPlaySuccess'] = $isPlaySuccess;
}

if($genre !== '')
{
    //update genre
    //update isPlaying
    //echo $genre;
    $sqlUpdateGenre = "UPDATE `Movies` SET `Genre` = '$genre' WHERE `Movies`.`Movie_ID` = $movieID";
    
    if ($mysqli->query($sqlUpdateGenre) === TRUE) 
    {
        //echo "updated genre" . "<br>";
        $GenreSuccess = 1;
        $_SESSION['GenreSuccess'] = $GenreSuccess;
    } else {
        $GenreSuccess = 0;
        $_SESSION['GenreSuccess'] = $GenreSuccess;
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
else
{
    $GenreSuccess = 2;
    $_SESSION['GenreSuccess'] = $GenreSuccess;
}

if($rating !== '')
{
    //update rating
    $sqlUpdateRating = "UPDATE `Movies` SET `Rating` = $rating WHERE `Movies`.`Movie_ID` = $movieID ";
    
    if ($mysqli->query($sqlUpdateRating) === TRUE) 
    {
        //echo "updated rating" . "<br>";
        $ratingSuccess = 1;
        $_SESSION['ratingSuccess'] = $ratingSuccess;
    } else {
        $ratingSuccess = 0;
        $_SESSION['ratingSuccess'] = $ratingSuccess;
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
else
{
    $ratingSuccess = 2;
    $_SESSION['ratingSuccess'] = $ratingSuccess;
}

$url='updateMovie4.php';
redirect($url);
        
$mysqli->close();
?>