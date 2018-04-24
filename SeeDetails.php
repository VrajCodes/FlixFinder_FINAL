<?php
session_start();
$email=$_SESSION['login'];

$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
} 

//$str="         hello"; 
//echo str_replace(" ", "&nbsp;", $str);  

$sql = "SELECT * FROM  Movies";
$result = $mysqli->query($sql);
if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
    $num_rows = $result->num_rows;
    $print = 0;
    $numspaces = 0;
     if($num_rows > 0) 
     {
         while($row = $result->fetch_assoc()) 
         {
             $print = $print + 1;
             $titlee = $row["Title"];
             echo $titlee;
             $numspaces = 68 - strlen($titlee);
             //echo strlen($titlee) . " ";
             //echo $numspaces;
             
             if($print == 3)
             {
                 echo "<br>";
                 $print = 0;
             }
             else
             {
                 if($numspaces > 52)
                 {$i = -10;}
                 else if ($numspaces >25 && $numspaces < 50)
                 {$i = 5;}
                 else
                 {$i = 0;}
                 while($i != $numspaces)
                 {
                    $str=" ";
                    echo str_replace(" ", "&nbsp;", $str);
                    $i = $i + 1;
                 }
             }
         }
     }
}
echo "<br><br>";
echo "Please enter a movie from the list shown above that you want to learn more information about" .  "<br>";

$mysqli->close();
?>

<!DOCTYPE html>
<HTML>
     <BODY>
         <link rel="stylesheet" type="text/css" href="allbacks.css">
    <form action="seedetails2.php" method="post">
    <p>Movie Name: <input type="MovieName" name="MovieName"></p>
    <p> <input type="submit" name="submit" value="Check Movie"></p>
    </form>
     </BODY>
</HTML>
