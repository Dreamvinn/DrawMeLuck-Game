<?php
include('./includes/config.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['pword'];
    $confirmPassword = $_POST['cpword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $message = "<p>Passwords do not match.</p>";
    } elseif (strlen($password) < 8 || strlen($username) < 8) {
        // Check if password and username length is at least 8 characters
        $message = "<p>Password and username must be at least 8 characters long.</p>";
    } else {
        // Check if the username already exists in the database
        $stmt = $conn->prepare("SELECT * FROM teachers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "<p>Username already exists.</p>";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO teachers (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashedPassword);
            $stmt->execute();
            // $_SESSION['teacherId'] = $stmt->insert_id;
            $message = "<p>Registration Successful!.</p>";
            // header("Location: signup.php");
            // exit();
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up - Draw Me Luck</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background: #002D04;
            color: #fff;
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 500px;
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        h2 {
            color: #000;
            font-size: 48px;
            margin-bottom: 40px;
        }

        input[type="text"],
        input[type="password"],
        select {
            font-size: 16px;
            border-radius: 5px;
            border: none;
            margin-bottom: 20px;
            padding: 10px;
        }

        input[type="submit"] {
            background-color: #000;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            background-color: white;
            height: 1vh;
            width: 95%;
            border-style: solid white;
        }

        .bot {
            position: fixed;
            bottom: .8%;
            left: 0;
            right: 0;
        }

        .top {
            position: fixed;
            top: .8%;
            left: 0;
            right: 0;
        }

        p {
            color: black;
        }
    </style>
</head>

<body>
    <div class="top">
        <center>
            <hr>
        </center>
    </div>
    <div class="container">
        <div class="box">
            <form class="form-signup" onSubmit="return validatePasswordMatch();" action="" method="POST">
                <h2 class="form-signup-heading">Sign Up</h2>
                <input type="text" id="uname" class="form-control" placeholder="Username (8 characters min.)" name="uname" required autofocus minlength="8">
                <input type="password" class="form-control" placeholder="Password (8 characters min.)" name="pword" id="pword" required minlength="8">
                <input type="password" class="form-control" placeholder="Confirm Password" name="cpword" id="cpword" required minlength="8">
                <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                </p>
                <?php echo $message; ?>
                <br>
                <a href="login.php" class="text-center">Already have an account? Log in here</a>
            </form>
        </div>
    </div>
    <div class="bot">
        <center>
            <hr>
        </center>
    </div>
</body>

</html>