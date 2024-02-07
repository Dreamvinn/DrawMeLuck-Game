<?php
include('./session.php');
include('./includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacherId = $_SESSION['teacherId'];
    $classId = $_POST['class_id'];

    $sql = "SELECT classId, teacherId FROM scoreboard WHERE classId = '$classId' AND teacherId = '$teacherId'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        // UPDATE EXISTING CLASS SCORE
        foreach ($_POST as $key => $value) {
            if ($key == 'g_points_1') {
                $groupId = '1';
                $gamepoints = $_POST['g_points_1'];
                $perkpoints = $_POST['p_points_1'];
                $sql = "UPDATE scoreboard SET game_points = '$gamepoints', perk_points = '$perkpoints' WHERE classId = '$classId' AND teacherId = '$teacherId' AND groupId = '$groupId'";
                $conn->query($sql);
            }
            if ($key == 'g_points_2') {
                $groupId = '2';
                $gamepoints = $_POST['g_points_2'];
                $perkpoints = $_POST['p_points_2'];
                $sql = "UPDATE scoreboard SET game_points = '$gamepoints', perk_points = '$perkpoints' WHERE classId = '$classId' AND teacherId = '$teacherId' AND groupId = '$groupId'";
                $conn->query($sql);
            }
            if ($key == 'g_points_3') {
                $groupId = '3';
                $gamepoints = $_POST['g_points_3'];
                $perkpoints = $_POST['p_points_3'];
                $sql = "UPDATE scoreboard SET game_points = '$gamepoints', perk_points = '$perkpoints' WHERE classId = '$classId' AND teacherId = '$teacherId' AND groupId = '$groupId'";
                $conn->query($sql);
            }
            if ($key == 'g_points_4') {
                $groupId = '4';
                $gamepoints = $_POST['g_points_4'];
                $perkpoints = $_POST['p_points_4'];
                $sql = "UPDATE scoreboard SET game_points = '$gamepoints', perk_points = '$perkpoints' WHERE classId = '$classId' AND teacherId = '$teacherId' AND groupId = '$groupId'";
                $conn->query($sql);
            }
            if ($key == 'g_points_5') {
                $groupId = '5';
                $gamepoints = $_POST['g_points_5'];
                $perkpoints = $_POST['p_points_5'];
                $sql = "UPDATE scoreboard SET game_points = '$gamepoints', perk_points = '$perkpoints' WHERE classId = '$classId' AND teacherId = '$teacherId' AND groupId = '$groupId'";
                $conn->query($sql);
            }
        }
    }else{
        // INSERT NEW SETS OF SCORE DATA
        foreach ($_POST as $key => $value) {
            if ($key == 'g_points_1') {
                $groupId = '1';
                $gamepoints = $_POST['g_points_1'];
                $perkpoints = $_POST['p_points_1'];
                $sql = "INSERT scoreboard (groupId,game_points,perk_points,classId,teacherId) VALUES ('$groupId','$gamepoints','$perkpoints','$classId','$teacherId')";
                $conn->query($sql);
            }
            if ($key == 'g_points_2') {
                $groupId = '2';
                $gamepoints = $_POST['g_points_2'];
                $perkpoints = $_POST['p_points_2'];
                $sql = "INSERT scoreboard (groupId,game_points,perk_points,classId,teacherId) VALUES ('$groupId','$gamepoints','$perkpoints','$classId','$teacherId')";
                $conn->query($sql);
            }
            if ($key == 'g_points_3') {
                $groupId = '3';
                $gamepoints = $_POST['g_points_3'];
                $perkpoints = $_POST['p_points_3'];
                $sql = "INSERT scoreboard (groupId,game_points,perk_points,classId,teacherId) VALUES ('$groupId','$gamepoints','$perkpoints','$classId','$teacherId')";
                $conn->query($sql);
            }
            if ($key == 'g_points_4') {
                $groupId = '4';
                $gamepoints = $_POST['g_points_4'];
                $perkpoints = $_POST['p_points_4'];
                $sql = "INSERT scoreboard (groupId,game_points,perk_points,classId,teacherId) VALUES ('$groupId','$gamepoints','$perkpoints','$classId','$teacherId')";
                $conn->query($sql);
            }
            if ($key == 'g_points_5') {
                $groupId = '5';
                $gamepoints = $_POST['g_points_5'];
                $perkpoints = $_POST['p_points_5'];
                $sql = "INSERT scoreboard (groupId,game_points,perk_points,classId,teacherId) VALUES ('$groupId','$gamepoints','$perkpoints','$classId','$teacherId')";
                $conn->query($sql);
            }
        }
    }

    
}
?>