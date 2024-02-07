<?php
session_start();
include('./includes/config.php');
$teacherId = $_SESSION['teacherId'];
$classId = $_SESSION['classId'];


function gameId(){
    $id = '';
    for ($i = 0; $i < 5; $i++) {
        $id .= rand(0, 9);
    }
    return $id;
}

if(!isset($_POST['action'])){
    header('location:' . $_SESSION['page']);
}else{
    if ($_POST['action'] == 'main_menu') {
        // SEND SCORES TO FINAL SCORE IN DATA BASE
        $gameId = gameId();
        $sql = "SELECT * FROM scoreboard WHERE classId = '$classId' AND teacherId = '$teacherId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            foreach ($result as $row) {
                $groupId = $row['groupId'];
                $gamepoints = $row['game_points'];
                $sql = "INSERT finalscore (groupId,final_score,classId,teachersId,gameId) VALUES ('$groupId','$gamepoints','$classId','$teacherId','$gameId')";
                $conn->query($sql);
            }
        }

        $sql = "DELETE FROM scoreboard WHERE classId = '$classId' AND teacherId = '$teacherId'";
        $conn->query($sql);
        $_SESSION['gameId'] = $gameId;
        echo 'success';
    }
}

?>