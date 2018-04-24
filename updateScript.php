<?php

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

session_start();
$email = $_SESSION['login'];
$worked = 0;
$items =0;
print_r($_POST['checkedboxes']);
foreach($_POST['checkedBoxes'] as $box){
    $MovieID = $box;
    $sql = "INSERT INTO `Watch_List` (`Email_Address`, `MovieID`, `Occurances`) VALUES ('$email', '$MovieID', '1')";
    
    if ($mysqli->query($sql) === TRUE) {
        $worked = $worked+1;
    } else {
        echo "MovieID: ". $MovieID ."<br>Error: " . $sql . "<br>" . $mysqli->error;
    }
    $items = $items+1;
    // execute your query
}
if($worked===$items)
{
    echo "Watchlist updated successfully";
}
// foreach($MovieID in $_POST['data']) {
//     $sql = "INSERT INTO `Watch_List` (`Email_Address`, `MovieID`) VALUES ('$email', '$MovieID')";
//     if ($mysqli->query($sql) === TRUE) {
//         echo "New  record created successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $mysqli->error;
//     }
//     // execute your query
// }
$mysqli->close(); 
?>