<?php
session_start();
include('./includes/config.php');

$teacherId = $_SESSION['teacherId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from the form
    $id = $_POST['id'];
    $teacherid = $_SESSION['teacherId'];
    $sql = "DELETE FROM classes WHERE id = '$id'";
    if($conn->query($sql)){
        $sql_students = "DELETE FROM students WHERE classId = '$id' AND teacherId = '$teacherId'";
        $conn->query($sql_students);
        $sql_groups = "DELETE FROM groups WHERE classId = '$id' AND teacherId = '$teacherId'";
        $conn->query($sql_groups);
    }
        
}

header('location: class.php');

?>