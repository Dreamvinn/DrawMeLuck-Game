<?php
session_start();
include('./includes/config.php');

if (!isset($_SESSION['teacherId'])) {
    header("Location: login.php");
}

$teacherId = $_SESSION['teacherId'];
$classId = $_SESSION['classId'];
$gameId = $_SESSION['gameId'];

$sql = "SELECT * FROM classes WHERE teacherId = '$teacherId' AND id = '$classId'";
$result = $conn->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
    $section = $row['section'];
    $subject = $row['subject'];
}
?>


<?php $assets = './assets'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <title>Export Final Result</title>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $assets ?>/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $assets ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= $assets ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= $assets ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="m-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        Draw Me Luck
                        <small class="float-right">Date: <?php echo date("Y-m-d") ?></small>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <h3 class="text-center">Final Result : <?php echo $section . ' - ' . $subject ?></h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Placement</th>
                                <th>Group Name</th>
                                <th class="text-center">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM finalscore WHERE classId = '$classId' AND teachersId = '$teacherId' AND gameId = '$gameId' ORDER BY final_score DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $count = 0;
                                foreach ($result as $row) {
                                    $count++;
                                    switch ($count) {
                                        case '1':
                                            $place = '1st Place';
                                            $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:lime;">' . $row['final_score'] . '</span>';
                                            break;
                                        case '2':
                                            $place = '2nd Place';
                                            $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:yellow;">' . $row['final_score'] . '</span>';
                                            break;
                                        case '3':
                                            $place = '3rd Place';
                                            $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:orange;">' . $row['final_score'] . '</span>';
                                            break;

                                        default:
                                            $place = $count . 'th Place';
                                            $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:gray;">' . $row['final_score'] . '</span>';
                                            break;
                                    }

                                    echo '<tr>
                                            <td>' . $count . '.' . '</td>
                                            <td>' . $place . '</td>
                                            <td>Group&nbsp;' . $row['groupId'] . '</td>
                                            <td class="text-center">' . $score . '</td>
                                        </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h3 class="text-center">Group Members</h3>
        <div class="row justify-content-center">
            <?php
            for ($i = 1; $i < 6; $i++) {
                $num = $i;
            ?>
                <div class="m-3">
                    <table class="table table-borderless table-sm">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group <?php echo $num ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT
                                    groups.id,
                                    groups.`name`,
                                    groups.studentId,
                                    groups.classId,
                                    groups.teacherId,
                                    students.`name` AS members,
                                    students.id
                                    FROM
                                    groups
                                    INNER JOIN students ON students.id = groups.studentId
                                    WHERE
                                    groups.teacherId = '" . $teacherId . "' AND
                                    groups.classId = '" . $classId . "' AND
                                    groups.`name` = '" . $num . "'";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $count = 1;
                                foreach ($result as $row) {

                                    echo '<tr>
                                            <td>' . $count++ . '.' . '</td>
                                            <td>' . $row['members'] . '</td>
                                        </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php }
            ?>
        </div>
    </div>

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>