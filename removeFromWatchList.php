<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

//print_r($_POST['checkedboxes']);
foreach($_POST['checkedBoxes'] as $box)
{
    $MovieID = $box;
    echo "..." . $MovieID . "....";
 
    //echo $MovieID;
    $sqlRem = "DELETE FROM `Watch_List` WHERE `Watch_List`.`Email_Address` = '$email' AND `Watch_List`.`MovieID` = $MovieID";
    if ($mysqli->query($sqlRem) === TRUE) {
        echo "The movie ". $MovieID . "was successfully removed from your watched list";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
}
//$title=$_POST["Title"];
/*
//look up id from movies given the title
$sqlCheck = "SELECT Movie_ID FROM `Movies` WHERE `Title` LIKE '$title'";
$result = $mysqli->query($sqlCheck);

if ($result->num_rows > 0) 
{ //in movies

    while($row = $result->fetch_assoc()) {
        $movid = $row["Movie_ID"];
    }
    
    //check if in watchlist
    $sqlChckifInUserList = "SELECT * FROM `Watch_List` WHERE `Email_Address` LIKE '$email' AND `MovieID` = $movid ORDER BY `Email_Address` ASC ";
    $result2 = $mysqli->query($sqlChckifInUserList);
    if ($result2->num_rows > 0)
    {
        //in watchd lst so remove it
        $sqlRem = "DELETE FROM `Watch_List` WHERE `Watch_List`.`Email_Address` = '$email' AND `Watch_List`.`MovieID` = $movid ";
        if ($mysqli->query($sqlRem) === TRUE) {
            echo "The movie ". $title . "was successfully removed from your watched list";
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
    }
    else
    {
        //not in watched list
        echo "The movie " . $title . "is not in your watched list" . "<br>";
    }
}
else
{
    echo "The movie " . $title . "is not in your watched list" . "<br>";
}*/
$mysqli->close();
?>