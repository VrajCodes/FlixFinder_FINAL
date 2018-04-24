<?php
    session_start();
    $mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
      die("Connection failed: " . $mysqli->connect_error);
    } 
?>
<html>
    <body>
        <h1><center>Here's some movies we think you'd like<center></h1>
        <?php
        $login = $_SESSION['login'];
        $sql = "SELECT Title FROM Movies WHERE Movie_ID IN (SELECT MovieID FROM Watch_List WHERE Email_Address LIKE '$login')";
        $result = $mysqli->query($sql);
        $movieArray = [];
        while($row = $result->fetch_assoc())
        {
          $movieArray[] = $row["Title"];
        }
        error_reporting(E_ALL);
        $randCell = rand(0,count($movieArray)-1);
        echo "<h1> Movies like: " .$movieArray[$randCell] . "</h1>";
        $handle = popen("python Recommend.py 'The Godfather' 2>&1", 'r');
        $read = fread($handle, 6096);
        echo($read);

        // $descriptor_spec = array(
        //   0 => array("pipe", "r"),
        //   1 => array("pipe", "w"),
        //   2 => array("file", "./error.log", "a")
        // ) ;
        // $cmd = "Recommend.py 2>&1";
        // $process = proc_open("python $cmd", $descriptor_spec, $pipes);

        // if (is_resource($process)) {
 
        //   $output = nl2br(stream_get_contents($pipes[1]));
      
        //   fclose($pipes[1]);
        //   fclose($pipes[0]);
      
        //   $return = proc_close($process);
        // }      
        ?>
    </body>
</html>
<?php
    $mysqli->close();
?>
