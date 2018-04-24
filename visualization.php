<?php
     //Including FusionCharts’ PHP Wrapper
    include("includes/fusioncharts.php");
    
    $mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
      die("Connection failed: " . $mysqli->connect_error);
    }
    
    

?>
<html

    <head>
        <title>Watch List</title>
    </head>
    
     <body> <link rel="stylesheet" type="text/css" href="allbacks.css">
            <?php
                session_start();
                $login=$_SESSION['login'];
                
                // $sql = "SELECT `MovieID` FROM `Watch_List` WHERE `Email_Address` LIKE '$login'";
                // $result = $mysqli->query($sql); 
                
                // while($row = $result2->fetch_assoc()) {
              
                //     echo "<h1><center>Movie Name:" .$row["Title"] . " !</center></h1>";
                // }
                // $sql2 = "SELECT Movie_ID AS MovieID, Title, Genre From tempMovieList";

                // $result2 = $mysqli->query($sql2);
                
                 // while($row = $result2->fetch_assoc()) {
              
                //     echo "<h1>Movie Name:" .$row["Genre"] . " !</h1>";
                // }
            $sql = "SELECT `MovieID` FROM `Watch_List` WHERE `Email_Address` LIKE '$login'";
            $result = $mysqli->query($sql);
            if($result === FALSE)
            {
                echo "EROR: " . $sql . "<br>" .$mysqli->error;
            }
            else
            {
                //look up the ID's into movies to display
                echo "Here are the current movies that are on your watch list: " . "<br>";
                while($row = $result->fetch_assoc()) {
                   $idd = $row["MovieID"];
                   if ($idd != 0)
                   {
                   #echo $idd . " ";
                   
                   //returning the movie title from Movies table given MovieID
                    $sql2 = "SELECT `Title` FROM `Movies` WHERE `Movie_ID` LIKE '$idd'";
                    $result2 = $mysqli->query($sql2);
                    
                     while($row2 = $result2->fetch_assoc()) 
                     {
                         $titlee = $row2["Title"];
                         echo $titlee. "<br>";
                     }
                   }
                }
            }

                
                $sql1 = "CREATE VIEW `tempMovieList` AS
                        SELECT * FROM `Movies` ";
                $result1 = $mysqli->query($sql1);  

                
                $sql2 = "SELECT Genre, SUM(Occurances) FROM (SELECT Movie_ID AS MovieID, Title, Genre From tempMovieList) AS T NATURAL JOIN (SELECT `MovieID`, `Occurances` FROM `Watch_List` WHERE `Email_Address` LIKE '$login') AS T2 GROUP BY Genre";
                
                
                
                $result2 = $mysqli->query($sql2);
                
                while($row = $result2->fetch_assoc()) {
                // echo $row["Genre"];
                    echo "<h1> You have seen " .$row["SUM(Occurances)"] ." " .$row["Genre"].  " movie(s) </h1>";
                }
                
                // $sql2 = "SELECT Genre, SUM(Occurances) FROM (SELECT Movie_ID AS MovieID, Title, Genre From tempMovieList) AS T NATURAL JOIN (SELECT `MovieID`, `Occurances` FROM `Watch_List` WHERE `Email_Address` LIKE '$login') AS T2 GROUP BY Genre";
                
                
                
                // $result2 = $mysqli->query($sql2);
                // $stack=[];
                // $stack1=[];
                
                // while($row = $result2->fetch_assoc()) {
                //   #echo $row["Genre"];
                //   $stack[] = $row["Genre"];
                 
                //   $stack1[] = $row["SUM(Occurances)"];
                  
                //     // echo "<h1>Genre: " .$row["Genre"] ." Occurances: " .$row["SUM(Occurances)"].  "  </h1>";
                // }
                
                //print_r($stack1[1]);
                // $data="dsda";
                
                // $output=shell_exec("python visualization.py " .$login);
                
                // echo $output;

                // $fruits = array (
                //     "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
                //     "numbers" => array(1, 2, 3, 4, 5, 6),
                    
                // );
                
                // $stack = array("orange", "banana");
                // array_push($stack, "apple", "raspberry");
                // print_r($stack);
                //$data = array('as', 'df', 'gh');

                // // Execute the python script with the JSON data
                // $result = shell_exec('python visualization.py ' . escapeshellarg(json_encode($stack1)));
                
                // // Decode the result
                // $resultData = json_decode($result, true);
                
                // // This will contain: array('status' => 'Yes!')
                // var_dump($resultData);

            ?>
         
     </body>
        
   
</html>

<?php
    $mysqli->close();

?>
