<?php
session_start();
$email=$_SESSION['login'];

echo "Enter the email of the friend you wish to compare watch lists to:" . "<br>";

?>

<!DOCTYPE html>
<HTML>
     <BODY>
         <link rel="stylesheet" type="text/css" href="allbacks.css">
    <form action="ViewMoviesWatchedFriends2.php" method="post">
    <p>Friend's email: <input type="friendEmail" name="friendEmail"></p>
    <p> <input type="submit" name="submit" value="List of Movies"></p>
    </form>
     </BODY>
</HTML>