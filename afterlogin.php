<?php
    session_start();
    $mysqli = new mysqli("localhost", "flixfinder_Connect", "On#XWN&kKa]t", "flixfinder_Users");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
      die("Connection failed: " . $mysqli->connect_error);
    } 



?>
<html

    <head>
    <link rel="stylesheet" type="text/css" href="afterlogin.css">
    
        <title>Welcome!</title>
    </head>
        <body>
            <img src="http://cdn-webimages.wimages.net/05150d210ac2c566477344e1dccd062adc5b5f-wm.jpg?v=3">
            <?php
               
                $login=$_SESSION['login'];
                $sql = "SELECT `Name` FROM `User` WHERE `Email_Address` LIKE '$login'";
                $result = $mysqli->query($sql); 
                while($row = $result->fetch_assoc()) {
                    echo "<h1><center>Welcome " .$row["Name"] . " !</center></h1>";
                }
            ?>
            <p>Welcome to FlixFinder!</p>
            <a href="movieSurvey.php"><button>Take Movies Survey</button></a>
            
            <p>Want to know which movies you have previously seen? Click here for a visualization!</p>
            <a href="visualization.php"><button>Visulizations</button></a>
          
            <p>Click here to see the full details about a movie!</p>
            <a href="SeeDetails.php"><button>See details about a movie</button></a>
            
            <p>Seen a new movie recently that you enjoyed? Make sure to add it to your watched list here!</p>
            <a href="addAMovieToWatchedList.php"><button>Add a movie to your watched list</button></a>
            
            <p>Know Someone else that uses our services! Add them here to your friends list!</p>
            <a href="addfriends.php"><button>Add a Friend</button></a>
            
            <p>Click here to remove a movie from your watched list. Note: Your watched list is what helps determine what movie you may enjoy</p>
            <a href="removeToWatchedList.php"><button>Remove a movie from your watched list</button></a>
            
            <!--<p>Bored and want to go watch a movie right now? Click here and we'll generate a list of movies you can go watch right now!</p>-->
            <!--<a href="ReccommendMovies.php"><button>I want to go watch a movie</button></a>-->
            
            <p>Click here if information about a movie has changed and you wish to edit it</p>
            <a href="updateMovie.php"><button>Update a Movie</button></a>
            
            <p>Want to know which movies you have not yet seen but your friends have?</p>
            <a href="ViewMoviesWatchedByFriendsnew.php"><button>List of Movies seen by your friends</button></a>
            
            <p>Want to recommend a Movie for your friends?</p>
            <a href="recommendToFriendsnew.php"><button>Recommend movie to friends</button></a>
            
            <p>Want to get Recommended a Movie based on your watchlist?</p>
            <a href="ReccommendMovies.php"><button>Get Some Movie Recommendations</button></a>
            
            <p>Want to see the Must See movies, popular movies, movies to avoid at all costs, as well as moviest trending within your friend group?</p>
            <a href="socialNew.php"><button>Social Page</button></a>
        </body>
        
        <br>
        <br>
        <br>
</html>

<?php
    $mysqli->close();
?>