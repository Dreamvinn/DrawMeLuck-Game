<?php
session_start();
include('./includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from the form
    $id = $_POST['id'];
    $section = $_POST['edit_class'];
    $subject = $_POST['edit_subject'];
    $teacherid = $_SESSION['teacherId'];
    // $teacherid = $_POST['teacherid'];

    $sql = "UPDATE classes SET section = '$section', subject = '$subject' WHERE id = '$id' AND teacherId = '$teacherid'";
    $conn->query($sql);
}

header('location: class.php');

?>