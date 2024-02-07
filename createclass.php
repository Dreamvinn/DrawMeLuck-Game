<?php
include('./includes/config.php');
include('./session.php');

if (!isset($_SESSION['teacherId'])) {
  header("Location: login.php");
}

// Get the currently logged-in TeacherID
$teacher_id = $_SESSION['teacherId'];

if (isset($_POST['submit'])) {
  $section = $_POST['section'];
  $subject = $_POST['subject'];

  $sql = "INSERT INTO classes (section, subject, TeacherID) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $section, $subject, $teacher_id);

  if ($stmt->execute()) {
    $notification = '<div class="notification">Class created successfully!</div>';
  } else {
    $notification = '<div class="notification error">Class creation failed!</div>';
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Class</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="Layout.css">
  <style>
    body {
      background-color: #002D04;
    }

    #settings-button {
      position: absolute;
      top: 0;
      right: 0;
      margin: 5vh;
    }

    #settings-button span {
      font-size: 3vh;
    }

    .fa-gear {
      color: #fff;
    }

    .container {
      height: 90vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      border: 1px solid #ccc;
      border-radius: 2vh;
      padding: 40px;
      margin: 0 auto;
      width: 60%;
      max-width: 600px;
      background-color: #fff;
      margin-bottom: 20%;
    }

    .form-container h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container form button {
      text-align: center;
      display: block;
      margin: 2vh auto;
    }

    .notification {
      color: black;
      font-family: 'Trebuchet MS';
      font-size: 20px;
      text-align: center;
    }

    .formsubmit {
      text-align: center;
      display: block;
      margin: 2vh auto;
      border: none;
      border-radius: 1vh !important;
      background-color: #00a2ed;
      color: white;
      padding: 1vh;
    }

    .formsubmit:hover {
      background-color: #4997d0;
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
      margin-top: 2%;
    }

    .back:hover {
      background-color: yellow;
    }
  </style>
</head>

<body>
  <audio src="./sfx/mainbg.mp3" autoplay loop></audio>
  <div class="line top-line"></div>
  <button class="back" onclick="window.location.href = 'class.php';">Back</button>

  <div class="col-4">
    <button type="button" id="settings-button" class="btn btn-lg float-sm-right" style="background-color: #002D04;color:white" data-toggle="dropdown">
      <span class="material-icons"><i class="fa-solid fa-gear fa-2xl"></i></span>
    </button>
    <div class="dropdown-menu" role="menu">
      <a class="dropdown-item" data-toggle="modal" data-target="#modal_mechanics">Mechanics</a>
      <a class="dropdown-item" href="logout.php">Sign Out</a>
    </div>
  </div>

  <!-- <a href="#" id="settings-button" data-toggle="dropdown">
    <span class="material-icons"><i class="fa-solid fa-gear fa-2xl"></i></span>
  </a>
  <div class="dropdown-menu" role="menu" style="background-color: #002D04;color:white">
    <a class="dropdown-item text-success" data-toggle="modal" data-target="#modal_mechanics">Mechanics</a>
    <a class="dropdown-item text-success" href="logout.php">Sign Out</a>
  </div> -->


  <div class="container">
    <div class="form-container">
      <h1>Create a New Class</h1>
      <form id="createClassForm" action="" method="post">
        <div class="form-group">
          <input type="text" class="form-control" id="class-number" name="section" placeholder="Class/Section #:" required><br>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject:" required>
        </div>
        <input type="submit" name="submit" value="Create Class" class="formsubmit">
        <?php
        if (isset($notification)) {
          echo $notification; // Display the notification here
        }
        ?>
      </form>
    </div>
  </div>
  <div class="line bottom-line"></div>

  <!-- Modal MECHANICS-->
  <div class="modal fade" id="modal_mechanics" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content" style="background-color: #002D04;color:white;">
        <div class="modal-header">
          <h5 class="modal-title">Mechanics</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body m-3">
          <?php include('./mechanics.html'); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">BACK</button>
        </div>
      </div>
    </div>
  </div>
  <?php include('./includes/scripts.php'); ?>
  <script>
    setTimeout(function() {
      document.querySelector('.notification').style.display = 'none';
    }, 5000); // 5 seconds
  </script>
</body>

</html>
