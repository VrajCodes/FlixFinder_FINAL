<?php
session_start();
$email=$_SESSION['login'];


$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

echo "Welcome to the social tab! Below you will be able to see the Top 3 Must see movies, good movies, as well as the movies you must avoid at all costs. Factors that are taken into consideration when ranking these movies are the imbD rating as well as the number of occurrences in other users watched list.";

echo "<br>" . "<br>";

echo "TOP 3 Movies" . "<br>";
$sqlTop3 = "SELECT T4.Title, T4.Rating FROM
(SELECT Title, Rating FROM Movies WHERE Rating > 8.0 AND Rating < 10.0) AS T4 , 
(SELECT * FROM 
(SELECT Title, SUM(Occurances) AS NumSeen FROM
`Watch_List`
NATURAL JOIN 
(SELECT Movie_ID AS MovieID, Title FROM `Movies`) AS T2
GROUP BY MovieID) AS T 
ORDER BY NumSeen DESC
LIMIT 5) AS T3
WHERE T4.Title =T3.Title OR (Rating > 8.0 AND Rating < 10.0)
GROUP BY Title
ORDER BY Rating DESC
LIMIT 3";

$sqlGood = "SELECT T4.Title, T4.Rating FROM 
(SELECT Title, Rating FROM Movies WHERE Rating > 5 AND Rating <= 7.80) AS T4 , 
(SELECT * FROM 
(SELECT Title, SUM(Occurances) AS NumSeen FROM
`Watch_List`
NATURAL JOIN 
(SELECT Movie_ID AS MovieID, Title FROM `Movies`) AS T2
GROUP BY MovieID) AS T 
ORDER BY NumSeen DESC
LIMIT 5) AS T3
WHERE T4.Title =T3.Title OR (Rating > 5 AND Rating <= 7.80)
GROUP BY Title
ORDER BY Rating DESC
LIMIT 3";

$sqlWorst = "SELECT T4.Title, T4.Rating FROM 
(SELECT Title, Rating FROM Movies WHERE Rating > 0 AND Rating <= 4.50) AS T4 , 
(SELECT * FROM 
(SELECT Title, SUM(Occurances) AS NumSeen FROM
`Watch_List`
NATURAL JOIN 
(SELECT Movie_ID AS MovieID, Title FROM `Movies`) AS T2
GROUP BY MovieID) AS T 
ORDER BY NumSeen ASC
LIMIT 5) AS T3
WHERE T4.Title = T3.Title OR (Rating > 0 AND Rating <= 4.50)
GROUP BY Title
ORDER BY Rating DESC
LIMIT 3";

$print = 1;
$result = $mysqli->query($sqlTop3);
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
	$num_rows = $result->num_rows;
	if($num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
        	echo $print . ". " . $row["Title"] . " | rating: " . $row["Rating"];
        	echo "<br>";
        	$print = $print + 1;
        }
    }
}

echo "<br>" . "<br>";
echo "Good Movies" . "<br>";
$result = $mysqli->query($sqlGood);
$print = 1;
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
	$num_rows = $result->num_rows;
	if($num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
        	echo $print . ". " . $row["Title"] . " | " . "rating: " . $row["Rating"] . "<br>"; 
        	$print = $print + 1;
        }
    }
}
echo "<br>" . "<br>";
echo "Movies To Avoid" . "<br>";

$result = $mysqli->query($sqlWorst);
$print = 1;
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
	$num_rows = $result->num_rows;
	if($num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
        	echo $print . ". " . $row["Title"] . " | " . "rating: " . $row["Rating"] . "<br>"; 
        	$print = $print + 1;
        }
    }
}

echo "<br>" . "Social Feed". "<br>" . "Below you can see posts made by your friends. These are movies that your friends highly recommend you go see!" . "<br><br>";

//go through your friends list
$sqlGoThruFriends = "SELECT * FROM `Friends_List` WHERE email_user LIKE '$email'";
$result = $mysqli->query($sqlGoThruFriends);
if($result === FALSE)
{ echo "EROR: " . $sql . "<br>" .$mysqli->error; }
else
{
    while($row = $result->fetch_assoc()) {
        $friend = $row["email_friend"];
        
        //for each friend print out the friend name and recommend this...
        $sqlFriend = "SELECT * FROM `FriendsRecommend` WHERE email_address LIKE '$friend'";
        $result2 = $mysqli->query($sqlFriend);
        if($result2 === FALSE)
        { echo "EROR: " . $sql . "<br>" .$mysqli->error; }
        else
        {
            if($result2->num_rows > 0)
            {
                echo $friend . " posted on their wall to go see:" . "<br>";
            }
            while($row2 = $result2->fetch_assoc()) 
            {
                $movieID = $row2["movieIDRecom"];
                //echo "Movie ID: " . $movieID;
                
                //get title
                $sqlGetTitle = "SELECT Title FROM `Movies` WHERE Movie_ID = $movieID";
                $result3 = $mysqli->query($sqlGetTitle);
                if($result3 === FALSE)
                { echo "EROR: " . $sql . "<br>" .$mysqli->error; }
                else
                {
                    while($row3 = $result3->fetch_assoc()) 
                    {
                        echo $row3["Title"] . "<br>";
                    }
                }
            }
            echo "<br>";
        }
    }
}

$mysqli->close();        
?>

<!DOCTYPE html>
<HTML>
    <body>
        <link rel="stylesheet" type="text/css" href="allbacks.css">
        <p>Click here to get redirected to where you can learn more information about any movie</p>
            <a href="SeeDetails.php"><button>Learn More Info</button></a>
            
            <a href="afterlogin.php"><button>Home</button></a>
            
        </body>
</html>
