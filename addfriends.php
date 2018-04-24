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

<?php



$sql = "SELECT `Name` FROM `User`,
(SELECT `email_friend`FROM `Friends_List` WHERE `email_user` LIKE '$email') AS T WHERE Email_Address = T.email_friend";

            $result = $mysqli->query($sql);
            if($result === FALSE)
            {
                echo "EROR: " . $sql . "<br>" .$mysqli->error;
            }
            else
            {
                //look up the ID's into movies to display
                echo "Here are the friend(s) on your current friends list: " . "<br>";
                while($row = $result->fetch_assoc()) {
                        $idd = $row["Name"];
                         echo $idd. "<br>";
                        //echo $row["Name"];
                     }
                   
                
            }



echo "</form>";

echo "<br> <br>";
echo "Now please enter the email address of your friend that also uses FlixFinder services in the box below:";

$mysqli->close();
?>

<!DOCTYPE html>
<HTML>
    <body>
        <link rel="stylesheet" type="text/css" href="allbacks.css">
        <form action="addfriendform.php" method="post">
        <p>Friends Email: <input type="Email_Address" name="Email_Address"></p>
        
        <p> <input type="submit" name="submit" value="Submit"></p>
        
  
  </form>
    </body>
</html>