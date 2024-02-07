<?php
include('./session.php');
include('./includes/config.php');
if (isset($_POST['class_id'])) {
    $_SESSION['classId'] = $_POST['class_id'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/e149b6a313.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <title>Groups</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #002D04;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
        overflow: auto;
        /* Enable scrolling for the entire page */
    }

    .header-line,
    .footer-line {
        background-color: white;
        height: 2vh;
        width: 95%;
        position: fixed;
        z-index: 2;
    }

    .header-line {
        top: 2vh;
    }

    .footer-line {
        bottom: 2vh;
    }

    .container {
        border: 3px solid white;
        width: 40%;
        padding: 2vh 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 1;
        overflow: auto;
        /* Enable scrolling for the container */
    }

    .scrollable-container {
        background-color: #002D04;
        max-height: 60vh;
        overflow-y: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
    }

    .textbox {
        width: 40%;
        background-color: #ffffff;
        border: 1px solid #ccc;
        margin: 1vh;
        padding: 2vh;
        display: flex;
        align-items: center;
    }

    .checkbox-input {
        margin-right: 2vh;
    }

    @media (max-width: 768px) {
        .textbox {
            width: 95%;
        }
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

    h1 {
        margin-top: 1%;
        font-family: 'Trebuchet MS';
        color: white;
        font-size: 400%;
    }

    .back {

        position: fixed;
        top: 0;
        left: 0;
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
        top: 0;
        right: 0;
        display: inline-block;
        position: fixed;
        color: white;
        right: 2%;
        margin-top: 2%;
        border: none;
        font-weight: 1000;
        font-size: 300%;
        cursor: pointer;
        transition: all 0.3s ease;

        background: none;
    }

    .gear:hover {
        color: #009FF5;
    }

    .actions-container {
        position: fixed;
        top: 50%;
        right: 2%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .action-button {
        display: inline-block;
        margin-bottom: 10px;
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
    }

    .action-button:hover {
        background-color: yellow;
    }


    .group-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: fixed;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        padding: 2% 1%;
    }

    .group-title {
        font-family: 'Trebuchet MS';
        /* Apply the font-family */
        font-size: 300%;
        /* Adjust the font size as needed */
        color: white;
        /* Match the color to the "Players" text */
        margin-bottom: 10px;
        /* Add margin */
    }

    .group {
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
        margin-bottom: 5%;
        text-align: left;
        width: 100%;
    }

    .group:hover {
        background-color: yellow;
    }
</style>

<body>
    <audio src="./sfx/mainbg.mp3" autoplay loop></audio>
    <div class="header-line"></div>
    <div class="footer-line"></div>
    <button class="back" onclick="window.location.href = 'players.php';">Back</button>
    <button class="gear"><i class="fa-solid fa-gear"></i></button>
    <div class="topcontainer">
        <h1>Group <?= $_POST['group_id'] ?></h1>
    </div>
    <div class="container">
        <div class="scrollable-container">
            <!-- Text boxes with checkboxes -->
            <?php
            $classId = $_SESSION['classId'];
            $groupId = $_POST['group_id'];

            $sql = "SELECT
                    students.`name` AS s_name,
                    students.classId AS s_cid,
                    students.teacherId AS s_tid,
                    students.id AS s_id,
                    groups.`name` AS g_name,
                    groups.studentId AS g_sid
                    FROM
                    students
                    INNER JOIN groups ON students.id = groups.studentId
                    WHERE
                    groups.`name` = '$groupId' AND
                    students.classId = '$classId' AND
                    students.teacherId = '$teacherId'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $count = 1;
                foreach ($result as $row) {
                    echo '<div class="textbox">&nbsp
                        <span><b>' . $count++ . '.</b> ' . $row['s_name'] . '</span>
                      </div>';
                }
                exit;
            } else {
                echo "<h2 style='color:white;'>NO PLAYERS FOR THIS CLASS</h2>";
                exit;
            }
            ?>
        </div>
    </div>

    <script>
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        const maxAssignments = 10; // Maximum assignments per group

        dropdowns.forEach((dropdown, index) => {
            const groupText = document.getElementById('groupText' + (index + 1));
            const selectedOption = dropdown.options[dropdown.selectedIndex].value;

            dropdown.addEventListener('change', () => {
                const newSelectedOption = dropdown.options[dropdown.selectedIndex].value;
                const groupAssignmentCounts = {};

                // Count existing assignments
                dropdowns.forEach((dropdown, i) => {
                    const option = dropdown.options[dropdown.selectedIndex].value;
                    if (option) {
                        if (!groupAssignmentCounts[option]) {
                            groupAssignmentCounts[option] = 1;
                        } else {
                            groupAssignmentCounts[option]++;
                        }
                    }
                });

                if (selectedOption) {
                    groupAssignmentCounts[selectedOption]--;
                }

                if (newSelectedOption) {
                    if (!groupAssignmentCounts[newSelectedOption] || groupAssignmentCounts[newSelectedOption] < maxAssignments) {
                        groupText.innerHTML = `<i style="color: gray;">In ${newSelectedOption}</i>`;
                    } else {
                        dropdown.selectedIndex = 0; // Reset to "Select Group"
                        alert(`The maximum assignment limit of ${maxAssignments} for ${newSelectedOption} has been reached.`);
                    }
                } else {
                    groupText.textContent = '';
                }
            });
        });
    </script>
</body>

</html>