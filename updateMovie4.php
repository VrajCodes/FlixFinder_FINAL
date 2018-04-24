<?php
session_start();

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

$titleSuccess=$_SESSION['TitleSuccess'];
$isPlaySuccess=$_SESSION['isPlaySuccess'];
$GenreSuccess=$_SESSION['GenreSuccess'];
$ratingSuccess=$_SESSION['ratingSuccess'];

if ($titleSuccess == 1)
{
    echo "Successfully updated Title!" . "<br>";
}
else if($titleSuccess == 0)
{
    echo "unable to update the title, please try again." . "<br>";
}

if ($isPlaySuccess == 1)
{
    echo "Successfully updated isPlaying!" . "<br>";
}
else if ($isPlaySuccess == 0)
{
    echo "unable to update the title, please try again.". "<br>";
}

if ($GenreSuccess == 1)
{
    echo "Successfully updated Genre!". "<br>";
}
else if ($GenreSuccess == 0)
{
    echo "unable to update the Genre, please try again.". "<br>";
}

if ($ratingSuccess == 1)
{
    echo "Successfully updated Rating!". "<br>";
}
else if ($ratingSuccess == 0)
{
    echo "unable to update the Rating, please try again.". "<br>";
}
?>

<html
    <body>
        <a href="afterlogin.php"><button>Return to Home</button></a>
</body>

</html>