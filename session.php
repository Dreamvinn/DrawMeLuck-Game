<?php
session_start();

// Check if the session variable is not set
if (!isset($_SESSION['teacherId'])) {
    // Redirect the user back to the login page
    header("Location: login.php");
    exit();
}
// Retrieve the Teacher ID from the session
$teacherId = $_SESSION['teacherId'];
$currentPage = basename($_SERVER['PHP_SELF']);
$_SESSION['page'] = $currentPage;

if($_SESSION['page'] == 'finalresult.php'){
    $audiofile = 'sfx/finalresult.mp3';
}else{
    $audiofile = 'sfx/Main Background Music.mp3';
}

?>