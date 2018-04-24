<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
}

$title=$_POST["MovieName"];
echo "You selected " . $title;
echo "<br>";

//check if movie is in movies table, if not insert
$sqlCheck = "SELECT Title, Genre, Movie_ID,Now_Playing, Rating FROM `Movies` WHERE `Title` LIKE '$title' ";
$result = $mysqli->query($sqlCheck);

if ($result->num_rows > 0) 
{ //in table so update
    echo "This is the current information about the movie:" . "<br>";
    echo "MovieID: " . $row["Movie_ID"] . "<br>";
    echo "Title: " . $row["Title"] . "<br>";
    echo "Genre: " . $row["Genre"] . "<br>";
    echo "isPlaying: " . $row["Now_Playing"] . "<br>";
    echo "Rating: " . $row["Rating"] . "<br>";
}
else
//not in table
{
    echo "The movie " . $title . " does not exist. Please try again";
}
