<?php
include('./session.php');
include('./includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get the input data from the form
  $names = $_POST['names'];
  $teacherId = $_SESSION['teacherId'];
  $classId = $_SESSION['classId'];
  // Split the input into an array of names
  $nameArray = preg_split("/\r\n|\n|\r/", $names);

  // Insert each name into the database
  $groupNumber = 0;
  foreach ($nameArray as $name) {
    $groupNumber = $groupNumber + 1;
    $name = mysqli_escape_string($conn, trim($name));

    if ($count < 26) {
      // ADD PLAYERS NAME
      $sql = "INSERT INTO students (name,classId,teacherid) VALUES ('$name','$classId','$teacherId')";
      if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
      } else {
        // GENERATE RANDOM GROUP
        if ($groupNumber <= 5) {
          $groupNumber = $groupNumber;
        } else {
          $groupNumber = 1;
        }

        $studentId = $conn->insert_id;
        $sql = "INSERT INTO groups (name,studentId,classId,teacherId) VALUES ('$groupNumber','$studentId','$classId','$teacherId')";
        $conn->query($sql);
      }
    }
  }

  // Close the database connection
  $conn->close();

  // Redirect to a thank you page or another appropriate page
  header("Location: players.php");
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/e149b6a313.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" href="img/icon.ico" />
  <title>Add Players</title>
  <style>
    @media (min-width: 768px) {
      .container {
        max-width: 100%;
        margin: 0px;
      }

      .container {
        background-color: #002D04;
      }
    }

    .tbl-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: -3vh;
      height: 82vh;
      border-collapse: collapse;
      width: 95.7%;
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
      width: 80vh;
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

    .save {
      display: inline-block;
      color: #009FF5;
      border: none;
      background: none;
      font-family: 'Trebuchet MS';
      font-size: 150%;
      cursor: pointer;
      transition: all 0.3s ease;
      background-color: white;
      height: 3.4vh;
    }

    .text {
      background-color: white;
      border: none;
      font-family: 'Trebuchet MS';
      font-size: 200%;
      /* width: 28vh !important; */
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
      height: 7vh;
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
      height: 5vh;
      background-color: white;
      color: #002D04;
      border: none;
      border-radius: 1vh !important;
      font-family: 'Trebuchet MS';
      font-weight: 1000;
      font-size: 320%;
      padding: 0px 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-bottom: 2%;
      text-align: left;
      width: 100%;
    }

    .group:hover {
      background-color: yellow;
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
      padding: 9px 20px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .action-button:hover {
      background-color: yellow;
    }

    textarea {
      height: 57vh;
      width: 76vh;
    }
  </style>
</head>

<body class="container">
  <audio src="./sfx/mainbg.mp3" autoplay loop></audio>
  <div class="top">
    <center>
      <hr>
    </center>
  </div>
  <button class="back" onclick="window.location.href = 'players.php'">Back</button>
  <button class="gear"><i class="fa-solid fa-gear"></i></button>
  <form action="" method="post" id="">
    <div class="topcontainer">
      <h1>Add Players</h1>
    </div>
    <div class="tbl-container">
      <table>
        <tr>
          <td>
            <textarea id="names" name="names" class="text" rows="10" cols="27" placeholder="Enter Names (one per line, up to 25)" required></textarea>
          </td>
        </tr>
      </table>
    </div>
    <div class="bot">
      <center>
        <hr>
      </center>
    </div>
    <div class="actions-container">
      <button type="submit" class="action-button" value="Submit">Save</button>
    </div>
  </form>

  <script>
    window.onload = function() {
      var textarea = document.getElementById("names");
      var maxTotalines = 25; // Set your desired character limit here.

      textarea.addEventListener("input", function() {
        var lines = textarea.value.split("\n");
        var countperline = 0;

        for (var i = 0; i < lines.length; i++) {
          countperline = lines.length;
        }

        if (countperline > maxTotalines) {
          var remainingCharacters = maxTotalines - countperline;
          if (remainingCharacters < 1) {
            lines.pop(); // Remove the last line if it exceeds the limit.
            alert("You have reached 25 Player's name.");
          }
          textarea.value = lines.join("\n");
        }

      });
    };
  </script>

</body>

</html>