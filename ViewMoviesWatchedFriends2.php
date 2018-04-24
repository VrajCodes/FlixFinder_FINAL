<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

$friendemail =$_POST["friendEmail"];

//check if in users
$sqlCheck = "SELECT * FROM `User` WHERE `Email_Address` LIKE '$friendemail'";
$result = $mysqli->query($sqlCheck);
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
    if ($result->num_rows > 0) 
    { //user in database so check if he is your friend
        $sqlCheckIfFriend = "SELECT * FROM `Friends_List` WHERE `email_user` LIKE '$email' AND `email_friend` LIKE '$friendemail'";
        $result2 = $mysqli->query($sqlCheckIfFriend);
        if ($result2->num_rows > 0) 
        { //user is friend
            //run query
            $sqlrun = "
            SELECT T.MovieID AS MovieID FROM
            
            (SELECT Email_Address, MovieID FROM Watch_List WHERE Watch_List.Email_Address LIKE '$friendemail') AS T
            LEFT JOIN 
            (SELECT Email_Address, MovieID FROM Watch_List WHERE Watch_List.Email_Address LIKE '$email') As T2
            USING (MovieID)
            WHERE T2.MovieID is NULL
            
            GROUP BY MovieID";
            $result3 = $mysqli->query($sqlrun);
            if ($result3->num_rows > 0)
            {
                echo "These are the following movies not in your watched list but is in $friendemail" . "'s " . " watched list:" . "<br><br>";
                while($row3 = $result3->fetch_assoc()) 
                {
                    $movieIDD = $row3["MovieID"];
                    //return title
                    $sqlGetTitle = "SELECT Title FROM `Movies` WHERE `Movie_ID` = $movieIDD";
                    $result4 = $mysqli->query($sqlGetTitle);
                    if ($result4->num_rows > 0)
                    {
                        while($row4 = $result4->fetch_assoc()) 
                        {
                            echo $row4["Title"] . "<br>";
                        }
                    }
                }
            }
            else
            {
                echo "There are 0 movies that differ from your friend list and " . "$friendemail" . "'s" . " list" . "<br>";
            }
        }
        else
        {
            echo "This user is not your friend, please enter your friends email";
        }
        
    }
    else
    {
        echo "User does not exist. Please try again!";
    }
}
$mysqli->close();
?>