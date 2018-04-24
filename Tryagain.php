<?php
    $mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
      die("Connection failed: " . $mysqli->connect_error);
    } 

?>

        <HTML>
        <a href="login.html"><button>Try again</button></a>
        </html>
        
        
<?php
    $mysqli->close();
?>