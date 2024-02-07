<?php
include('./session.php');
include('./includes/config.php');

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $newName = $_POST["newName"];
    if (isset($_POST["save"])) {
        $sql = "UPDATE students SET name='$newName' WHERE id=$id";
        $conn->query($sql);
        $message = 'Saved!';
    } else if (isset($_POST["delete"])) {
        $sql = "DELETE FROM students WHERE id=$id";
        $conn->query($sql);
        $message = 'Deleted!';
    }
}

// Fetch data from the database
$sql = "SELECT * FROM students WHERE teacherId = '" . $_SESSION['teacherId'] . "' AND classId = '" . $_SESSION['classId'] . "'";
$result = $conn->query($sql);
$num_rows = $result->num_rows;
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e149b6a313.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <title>Edit Players</title>
    <style>
        @media (min-width: 768px) {
            .a {
                flex: 0 0 50%;
                max-width: 100%;
            }

            .a {
                background-color: #002D04;
            }
        }

        .tbl-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5vh;
            height: 70vh;
            border-collapse: collapse;
            width: 98%;
        }

        .topcontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            margin-top: -5vh;
            border-collapse: collapse;
            width: 95.7%;
            padding: auto;
        }

        table {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 60vh;
            overflow: auto;
            border-collapse: collapse;
            width: 90vh;
            border: 3px solid white;
        }

        td {
            padding: 8px;
            vertical-align: top;
        }

        .form-container {
            display: flex;
            align-items: center;
        }

        .form-container button {
            margin-left: 10px;
        }

        .delete {
            display: inline-block;
            color: red;
            border: none;
            background: none;
            font-family: 'Trebuchet MS';
            font-size: 120%;
            cursor: pointer;
            transition: all 0.3s ease;

        }

        .delete:hover {
            background: yellowgreen;
            border-radius: 30%;
        }

        .save {
            display: inline-block;
            color: #0064ff;
            border: none;
            background: white;
            font-family: 'Trebuchet MS';
            font-size: 120%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save:hover {
            background: #4bff2c;
        }

        .text {
            background-color: white;
            border: none;
            font-family: 'Trebuchet MS';
            font-size: 120%;
            width: 28vh !important;
            padding: 6px 10px;
            box-sizing: border-box;
        }

        hr {
            background-color: white;
            height: 1vh;
            width: 95%;
            border-style: solid white;
        }

        .bot {
            position: fixed;
            bottom: 2%;
            left: 0;
            right: 0;
        }

        .top {
            position: fixed;
            top: 2%;
            left: 0;
            right: 0;
        }

        h1 {
            margin-top: 3%;
            font-family: 'Trebuchet MS';
            color: white;
            font-size: 400%;
        }

        .back {
            display: inline-block;
            background-color: white;
            color: #002D04;
            border: none;
            border-radius: 1vh !important;
            font-family: 'Trebuchet MS';
            font-weight: 1000;
            font-size: 220%;
            padding: 0px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 2%;
            margin-top: 3%;
        }

        .back:hover {
            background-color: yellow;
        }

        .gear {
            display: inline-block;
            position: fixed;
            height: 5vh;
            color: white;
            border: none;
            font-weight: 1000;
            font-size: 300%;
            cursor: pointer;
            transition: all 0.3s ease;
            right: 2%;
            margin-top: 2%;
            background: none;
        }

        .gear:hover {
            color: #009FF5;
        }

        .null {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: white;
            padding: 1vh;
            width: 40vh;
        }
    </style>
</head>

<body class="a">
    <audio src="./sfx/mainbg.mp3" autoplay loop></audio>
    <div class="top">
        <center>
            <hr>
        </center>
    </div>
    <button class="back" onclick="window.location.href = 'players.php';">Back</button>
    <button type="submit" class="gear"><i class="fa-solid fa-gear"></i></button>
    <center>
        <div class="topcontainer">
            <h1>Edit Players</h1>
        </div>
        <div class="tbl-container">
            <table>
                <?php
                if ($num_rows == 0) {
                    echo "<p class=\"null\">No Data</p>";
                }
                $count = 0;
                $n = 1;
                while ($row = $result->fetch_assoc()) {
                    if ($count % 2 == 0) {
                        echo '<tr>';
                    }
                    $num = ($n < 10) ? '0' . $n . '. ' : $n . '. ';

                ?>
                    <td>
                        <form id="form_players" method="post" class="form-container" onsubmit="return showAlert(event);">
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                            <span style="color:whitesmoke;margin-right: 5px;"><?php echo $num; ?></span>
                            <input type="text" class="text" name="newName" value="<?php echo $row["name"]; ?>">

                            <button type="submit" name="save" class="save" value="Save" title="Save" style="margin-left: 0px;padding-top: 6px;padding-bottom: 6px;">
                                <i class="fa-regular fa-floppy-disk"></i>
                            </button>

                            <button type="submit" name="delete" class="delete" value="Delete" title="Delete">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                <?php
                    if ($count % 2 == 1 || $count == $num_rows - 1) {
                        echo '</tr>';
                    }
                    $n++;
                    $count++;
                }
                ?>
            </table>
        </div>
    </center>
    <div class="bot">
        <center>
            <hr>
        </center>
    </div>
    <script>
        function showAlert(event) {
            var action = event.submitter
            if (action.name === 'save') {
                var message = "Save player name?";
            } else if (action.name === 'delete') {
                var message = "Delete player name from list?";
            }
            var confirmation = confirm(message);
            return confirmation;
        }
    </script>
</body>

</html>