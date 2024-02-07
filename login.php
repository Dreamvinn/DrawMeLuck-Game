<?php
session_start();
include('./includes/config.php');

if (isset($_SESSION['teacherId'])) {
    if (!isset($_SESSION['page'])) {
        header("Location: welcome.php");
    } else {
        header('location:' . $_SESSION['page']);
    }
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['pword'];

    $stmt = $conn->prepare("SELECT * FROM teachers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching teacher record is found
    if ($result->num_rows === 1) {
        // Fetch the teacher ID
        $row = $result->fetch_assoc();
        $teacherId = $row['id'];

        // Store the teacher ID in the session variable
        $_SESSION['teacherId'] = $teacherId;
        $_SESSION['teacherName'] = $username;

        // Redirect the user to the desired page
        header("Location: welcome.php");
        exit;
    } else {
        $message = '<center>Invalid username or password</center>';
        // echo "<center>Invalid username or password</center>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <title>Login - Draw Me Luck</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<style>
    body {
        background: #002D04;
    }

    .form-container {
        background-color: #fff;
        border-top: 5px solid #fff;
        border-bottom: 5px solid #fff;
    }

    hr {
        background-color: white;
        height: 1vh;
        width: 95%;
        opacity: 1;
        border-style: solid white !important;
    }

    .bot {
        position: fixed;
        bottom: 1.2%;
        left: 0;
        right: 0;
    }

    .top {
        position: fixed;
        top: 1.2%;
        left: 0;
        right: 0;
    }
</style>

<body>
    <div class="top">
        <center>
            <hr>
        </center>
    </div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form class="form-container rounded p-5" method="POST" action="">
            <h2 class="text-center mb-5">Login to Draw Me Luck</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Username" autocomplete="off" required>
                <label for="uname">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="pword" name="pword" placeholder="Password" autocomplete="off" required>
                <label for="pword">Password</label>
            </div>

            <?php echo $message; ?>
            <br>
            <input type="submit" id="login" name="login" value="Log in" class="btn btn-success btn-lg d-block w-100 mb-3">
            <a href="signuppage.php" class="btn btn-primary btn-lg d-block w-100 mb-3">Sign Up</a>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <div class="bot">
        <center>
            <hr>
        </center>
    </div>
</body>

</html>