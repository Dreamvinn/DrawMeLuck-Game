<?php
include('session.php');

function logout()
{
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired location
    header("Location: login.php");
    exit;
}

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    logout();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <title>Welcome</title>

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

        .container {
            width: 80%;
            margin: 0 auto;
            margin-top: 3%;
        }

        @media only screen and (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0 10px;
            }
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

        .imgcontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            margin-right: 20%;
        }

        .btncontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 13vh;
        }

        img {
            max-width: 400%;
            max-height: 80%;
        }

        .playbtn {
            display: inline-block;
            /* height: 10vh; */
            background-color: white;
            color: #002D04;
            border: none;
            border-radius: 2vh !important;
            font-family: 'Trebuchet MS';
            font-weight: 1000;
            font-size: 350%;
            padding: 10px 80px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .playbtn:hover {
            background-color: #00FF17;
        }

        .mechbtn {
            display: inline-block;
            margin-top: 50px;
            /* height: 10vh; */
            background-color: white;
            color: #002D04;
            border: none;
            border-radius: 2vh !important;
            font-family: 'Trebuchet MS';
            font-weight: 1000;
            font-size: 350%;
            padding: 10px 80px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mechbtn:hover {
            background-color: yellow;
        }

        .signout {
            float: right;
            background-color: #BF0000;
            color: white;
            border: none;
            border-radius: 1vh !important;
            font-family: 'Trebuchet MS';
            font-weight: 1000;
            font-size: 220%;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 2%;
            text-decoration: none;
            line-height: 1;
        }

        .signout:hover {
            background-color: #CE3E3E;
        }

        #user {
            position: fixed;
            top: 0;
            left: 0;
            display: inline-block;
            margin-left: 5%;
            margin-top: 1.5%;
            color: gray;
            font-family: 'Trebuchet MS';
        }

        .circle {
            position: fixed;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            display: inline-block;
            margin-left: 3%;
            margin-top: 3%;
            background-color: #00FF17;
            border-radius: 50%;
            display: inline-block;
        }
    </style>

</head>

<body class="a">
    <audio id="myAudio" autoplay loop>
        <source src="sfx/mainbg.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
    <!-- <audio src="sfx/mainbg.mp3" autoplay loop></audio> -->
    <div class="top">
        <center>
            <hr>
        </center>
    </div>
    <div class="circle"></div>
    <div id="user">
        <h1>&nbsp;&nbsp;<?php echo $_SESSION['teacherName']; ?></h1>
    </div>
    <form method="post" action="">
        <input type="submit" class="signout" name="logout" value="Sign Out">
    </form>
    <table class="container">
        <tr>
            <td>
                <div class="imgcontainer">
                    <img src="./img/Draw Me Luck.png">
                </div>
            </td>
            <td>
                <div class="btncontainer">
                    <button class="playbtn" onclick="window.location.href = 'class.php';">Play</button><br>
                </div>
                <div class="btncontainer">
                    <button class="mechbtn" onclick="window.location.href = 'mechanics.php';">Mechanics</button>
                </div>
            </td>
        </tr>
    </table>

    <div class="bot">
        <center>
            <hr>
        </center>
    </div>
</body>

</html>