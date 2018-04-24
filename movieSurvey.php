<?php
session_start();

echo $email;
$mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
  die("Connection failed: " . $mysqli->connect_error);
}
?> 
<!-- <!DOCTYPE html>
<html lang="en"> -->
<?php
$sql = "SELECT * FROM Movies WHERE Movie_ID not in (SELECT MovieID FROM Watch_List WHERE Email_Address LIKE '$email')";
$result = $mysqli->query($sql);


if($result === FALSE)
{
    echo "EROR: " . $sql . "<br>" .$mysqli->error;
}
else
{
    // echo "Success";
    // $num_rows = $result->num_rows;
    // if($num_rows > 0) {
    //     print("<p>" . $num_rows . "results found.</p.");
    //     while($row = $result->fetch_assoc()) {
    //         print("Movie Title: {$row['Title']}<br/>");
    //     }
    //     $result->free();
    // }
    // else
    // {
    //     print("Nothing");
    // }
}
// echo "Please select the movies you have seen and enjoyed. These will be added into your watched list</h3>";
echo "<form action='updateScript.php' method='post'>";
// echo "<form id='myForm'>";
while($row = $result->fetch_assoc())
{
    // echo "<div id='".$row['Movie_ID']."'><input type='checkbox' value='".$row['MovieID']."' /> ".$row['Title']." </div>";
    echo " <input type='checkbox' value='".$row['Movie_ID']."' name='checkedBoxes[]'/> ".$row['Title']. "<br>";
}
// echo "<a href='#' id='submit'>Submit Movies</a>";
echo "<input type='submit' name = 'submit' value='Submit'>";
echo "</form>"; 
$email = $_SESSION['login'];
$mysqli->close();
?>


    <!-- <head>
        <style type="text/css">
        select {
            height: 200px;
              width: 200px;
              display: block;
}
.select-multiple {
  border: 1px solid grey;
  width: 75px;
}
.select-multiple label,
.select-multiple label span {
  display: block;
  width: 100%;
}
.select-multiple input[type="checkbox"] {
  opacity: 0;
  position: absolute;
}
.select-multiple :checked + span {
    background: #2727fd;
    color: white;
}
            
        </style>

        <body>
            
            <h3>Please select the movies you have seen and enjoyed. These will be added into your watched list</h3>
        <div class="select-multiple">
            <label><input type="checkbox" name="checkbox" value="1"><span>Movie 1</span></label>
          <label><input type="checkbox" name="checkbox" value="2"><span>Movie 2</span></label>
          <label><input type="checkbox" name="checkbox" value="3"><span>Movie 3</span></label>
          <label><input type="checkbox" name="checkbox" value="4"><span>Movie 4</span></label>
          <label><input type="checkbox" name="checkbox" value="1"><span>Movie 5</span></label>
          <label><input type="checkbox" name="checkbox" value="2"><span>Movie 6</span></label>
          <label><input type="checkbox" name="checkbox" value="3"><span>Movie 7</span></label>
          <label><input type="checkbox" name="checkbox" value="4"><span>Movie 8</span></label>
          
            
        </div>

    </body> -->
        
<!-- </html> -->
<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" type="text/css" href="allbacks.css">
    
</html>