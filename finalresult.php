<?php
include('./includes/config.php');
include('./session.php');

if (!isset($_SESSION['teacherId'])) {
  header("Location: login.php");
}
$teacherId = $_SESSION['teacherId'];
$classId = $_SESSION['classId'];

$sql = "SELECT * FROM classes WHERE teacherId = '$teacherId' AND id = '$classId'";
$result = $conn->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
  $section = $row['section'];
  $subject = $row['subject'];
}
?>

<?php include('includes/header.php') ?>

<style>
  body {
    background-image: url('img/bg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }

  .final-results-text {
    font-size: 48px;
    margin-top: 0px;
    font-weight: bold;
    color: white;
    padding: 0px;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
  }

  #scoreboard {
    background-color: #0a2b0069;
    border-radius: 20px;
  }

  .shadowed-text {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
  }

  .back-to-menu-button {
    background-color: #002900;
    box-shadow: 0 0 10px rgb(91 255 0);
    font-weight: bold;
    /* Dark green button */
    color: white;
    position: fixed;
    bottom: 80px;
    /* Adjusted to move above the footer */
    right: 20px;
    padding: 15px 30px;
    /* Increased padding for a larger button */
  }

  .back-to-menu-button:hover {
    border: 2px solid #002702;
    font-weight: bold;
    color: #002702;
    background-color: lime;
  }
</style>

<body>
  <audio src="sfx/endgame.mp3" autoplay loop></audio>
  <div class="container">
    <div class="row m-0">
      <div class="col-12">
        <h2 class="m-0 text-white">
          Draw Me Luck
          <small class="float-right">Date: <?php echo date("Y-m-d") ?></small>
        </h2>
      </div>
    </div>
    <div class="final-results-text text-center">
      Final Results
      <h4><?php echo $section . ' | ' . $subject ?></h4>
    </div>

    <div id="scoreboard" class="row justify-content-center">
      <table class="table table-striped no-border">
        <thead class="text-white" style="background-color: #002900;">
          <tr>
            <th>PLACEMENT</th>
            <th>GROUP</th>
            <th class="text-center">SCORE</th>
          </tr>
        </thead>
        <tbody class="text-white " style="font-size: 40px;text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">
          <?php
          $sql = "SELECT * FROM scoreboard WHERE classId = '$classId' AND teacherId = '$teacherId' ORDER BY game_points DESC";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $count = 0;
            foreach ($result as $row) {
              $count++;
              switch ($count) {
                case '1':
                  $place = '1st Place';
                  $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:lime;">' . $row['game_points'] . '</span>';
                  break;
                case '2':
                  $place = '2nd Place';
                  $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:yellow;">' . $row['game_points'] . '</span>';
                  break;
                case '3':
                  $place = '3rd Place';
                  $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:orange;">' . $row['game_points'] . '</span>';
                  break;

                default:
                  $place = $count . 'th Place';
                  $score = '<span class="p-1 shadowed-text" style="border-radius: 10px;background-color:gray;">' . $row['game_points'] . '</span>';
                  break;
              }

              echo '<tr>
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
    <button class="btn back-to-menu-button" id="mainmenu">Back to Main Menu</button>
  </div>

  <?php include('includes/scripts.php') ?>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.12.0/tsparticles.confetti.bundle.min.js"></script>
  <script src="includes/confeti.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $('#mainmenu').on('click', function() {
        if (confirm('Export final result data and return to main menu?')) {
          var action = 'main_menu';
          $.ajax({
            type: "post",
            url: "resetscore.php",
            data: {
              action: action
            },
            success: function(response) {
              window.location.href = 'welcome.php';
            }
          });
          window.open('export.php', '_blank');
        }
      })
    })
  </script>
</body>
