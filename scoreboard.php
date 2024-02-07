<?php
include('./session.php');
include('./includes/config.php');

if (isset($_POST['class_id_continue'])) {
  $classId = $_POST['class_id_continue'];
  $_SESSION['classId'] = $classId;
}

?>

<?php $assets = './assets'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="img/icon.ico" />
  <title>Draw Me Luck</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $assets ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= $assets ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $assets ?>/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $assets ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $assets ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<style>
  h3 {
    margin-top: 1%;
    font-family: 'Trebuchet MS';
    color: #002D04;
    font-size: 300%;
  }

  a {
    font-family: 'Trebuchet MS';
    font-weight: 1000;
    font-size: 220%;
    padding: 0px 20px;
  }

  .form-control {
    font-size: 2rem;
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

  /* clock Timer */
  .timer {
    position: relative;
    text-align: center;
    color: white;
    font-size: 130px;
  }

  #timer {
    font-size: 150px;
    font-family: fantasy;
  }

  .centered {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 100px;
  }

  input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
  }
</style>

<body class="hold-transition sidebar-mini">
  <audio src="sfx/mainbg.mp3" autoplay loop></audio>
  <audio src="sfx/earnpoints.mp3" id="sfx_gpoints" type="audio/mp3"></audio>
  <audio src="sfx/perkpoints.mp3" id="sfx_ppoints" type="audio/mp3"></audio>
  <audio src="sfx/times_up.mp3" id="sfx_timesup" type="audio/mp3"></audio>
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content m-3">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">

            <div class="col-4">
              <a href="class.php" type="button" class="btn btn-lg" id="back" style="background-color: #002D04;color:white">RETURN</a>
              <!-- <a href="#" type="button" class="btn btn-lg" id="back" style="background-color: #002D04;color:white">RETURN</a> -->
            </div>

            <div class="col-4">
              <h3 class="text-center"><b>Scoreboard</b></h3>
            </div>

            <div class="col-4">
              <button type="button" class="btn btn-lg float-sm-right" style="background-color: #002D04;color:white" data-toggle="dropdown">
                <i class="fa fa-cog"></i>
              </button>
              <div class="dropdown-menu" role="menu" style="background-color: #002D04;color:white">
                <a class="dropdown-item text-success" data-toggle="modal" data-target="#modal_mechanics">Mechanics</a>
                <a class="dropdown-item text-success" href="logout.php">Sign Out</a>
              </div>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content" style="align-items: center;">
        <div class="card ml-5 mr-5 border-0" style="box-shadow: none;">
          <div class="card-body p-0 border-0">
            <div class="row ml-5 mr-5">
              <table class="table table-bordered table-striped" id="">
                <thead style="background-color: #002D04;color:white;">
                  <tr>
                    <th style="width: 20%;" class="text-center">
                      <h2><b>GROUPS</b></h2>
                    </th>
                    <th style="width: 20%;" class="text-center">
                      <h2><b>GAME POINTS</b></h2>
                    </th>
                    <th style="width: 20%;" class="text-center">
                      <h2><b>PERK POINTS</b></h2>
                    </th>
                    <th style="width: 30%;" class="text-center">
                      <h2><b>PERKS</b></h2>
                    </th>
                  </tr>
                </thead>
                <form action="scoreboard_add.php" method="post" id="form_scoreboard">
                  <input type="hidden" name="class_id" id="class_id" value="<?php echo $_SESSION['classId'] ?>">
                  <tbody style="background-color: #002D04;color:white;">
                    <?php

                    $count = 5;
                    for ($i = 1; $i <= $count; $i++) {
                      $sql = "SELECT * FROM scoreboard WHERE classId = '" . $_SESSION['classId'] . "' AND teacherId = '$teacherId' AND groupId = '$i'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        foreach ($result as $row) {
                          $gpoints = $row['game_points'];
                          $ppoints = $row['perk_points'];
                          if ($ppoints < 3) {
                            $status = 'disabled';
                          } else {
                            $status = '';
                          }
                          echo '<tr class="text-center">
                                  <td><h4> Group ' . $i . '</h4></td>
                                  <td class="text-center">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger minus"><i class="fa fa-minus"></i></button>
                                      </div>
                                      <input type="number" min="0" class="form-control text-center gamepoints" name="g_points_' . $i . '" id="g_points_' . $i . '" value="' . $gpoints . '" style="background-color:white" readonly>
                                      <div class="input-group-append">
                                        <button type="button" class="btn btn-success add"><i class="fa fa-plus"></i></button>
                                      </div>
                                    </div>
                                  </td>
                                  <td class="text-center">
                                    <div class="input-group mb-3">
                                      <input type="number" min="0" class="form-control text-center perkpoints" name="p_points_' . $i . '" id="p_points_' . $i . '" value="' . $ppoints . '" style="background-color:white" readonly>
                                      <input type="hidden" min="0" class="form-control text-center gperks" name="g_perks_' . $i . '" id="g_perks_' . $i . '" value="0">
                                    </div>
                                  </td>
                                  <td class="text-center">
                                    <div class="btn-group">
                                      <button type="button" style="background-color: #002D04;color:white;" class="btn btn-lg btn-success rounded-circle hint" id="perk_hint" title="Hint" ' . $status . '><i class="fa fa-search"></i></button>&nbsp;
                                      <button type="button" style="background-color: #002D04;color:white;" class="btn btn-lg btn-success rounded-circle chances" id="perk_chances" title="Chances"  ' . $status . '>&nbsp;<i class="fa fa-angle-double-up"></i>&nbsp</button>&nbsp;
                                      <button type="button" style="background-color: #002D04;color:white;" class="btn btn-lg btn-success rounded-circle time" id="perk_time" title="Time"  ' . $status . '  data-target="#modal_timer" data-toggle="modal" ><i class="fa fa-clock"></i></button>
                                    </div>
                                  </td>
                                </tr>';
                        }
                      } else {
                        echo '<tr class="text-center">
                                  <td><h4> Group ' . $i . '</h4></td>
                                  <td class="text-center">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger minus"><i class="fa fa-minus"></i></button>
                                      </div>
                                      <input type="number" min="0" class="form-control text-center gamepoints" name="g_points_' . $i . '" id="g_points_' . $i . '" value="0">
                                      <div class="input-group-append">
                                        <button type="button" class="btn btn-success add"><i class="fa fa-plus"></i></button>
                                      </div>
                                    </div>
                                  </td>
                                  <td class="text-center">
                                    <div class="input-group mb-3">
                                      <input type="number" min="0" class="form-control text-center perkpoints" name="p_points_' . $i . '" id="p_points_' . $i . '" value="0" style="background-color:white" readonly>
                                      <input type="hidden" min="0" class="form-control text-center gperks" name="g_perks_' . $i . '" id="g_perks_' . $i . '" value="0">
                                    </div>
                                  </td>
                                  <td class="text-center">
                                    <div class="btn-group">
                                      <button type="button" style="background-color: #002D04;color:white;" id="perk_hint" class="btn btn-success rounded-circle hint" title="Hint" disabled><i class="fa fa-search"></i></button>&nbsp;
                                      <button type="button" style="background-color: #002D04;color:white;" id="perk_chances" class="btn btn-success rounded-circle chances" title="Chances" disabled>&nbsp;<i class="fa fa-angle-double-up"></i>&nbsp</button>&nbsp;
                                      <button type="button" style="background-color: #002D04;color:white;" id="perk_time" class="btn btn-success rounded-circle time" title="Time" disabled><i class="fa fa-clock"></i></button>
                                    </div>
                                  </td>
                                </tr>';
                      }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" class="text-center">
                        <a href="#" type="button" class="btn btn-lg pl-4 pr-5" data-target="#modal_timer" data-toggle="modal" style="background-color: #002D04;color:white"><i class="far fa-clock"></i>&nbsp;&nbsp;Timer</a>
                        <a href="#" type="button" class="btn btn-lg pl-4 pr-4" data-target="#modal_coin" data-toggle="modal" style="background-color: #002D04;color:white"><i class="fa fa-coins"></i> Coin Flip</a>
                      </td>
                    </tr>
                  </tfoot>
                </form>
              </table>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>

  </div>
  <!-- ./wrapper -->
  <a href="finalresult.php" type="button" class="btn btn-success continue" style="font-size: 1.2em;
            position: absolute;
            bottom: 20px;
            right: 20px;">Continue</a>


  <!-- Modal Timer-->
  <div class="modal fade" id="modal_timer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background-color: rgb(0 59  5 / 50%)" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background-color: #002D04;box-shadow: 0 0.5rem 1rem rgb(87 127 2 / 85%);">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" title="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="">
          <div class="modal-body text-center p-0">
            <div class="text-center">
              <div class="timer">
                <img src="./img/clock.png" alt="" class="mx-auto img-responsive" width="400px" height="400px">
                <div class="centered">
                  <span id="timer" class="text-white">0</span>
                </div>
              </div>
            </div>
            <div class="text-center mt-3">
              <div class="mb-2">
                <button class="btn btn-secondary plus-3" style="border-radius: 20px;">+3 seconds</button>
                <button class="btn btn-secondary plus-5" style="border-radius: 20px;">+5 seconds</button>
                <button class="btn btn-secondary plus-10" style="border-radius: 20px;">+10 seconds</button>
              </div>
              <button class="btn btn-secondary plus-15" style="border-radius: 20px;">+15 seconds</button>
              <button class="btn btn-secondary plus-20" style="border-radius: 20px;">+20 seconds</button>
              <button class="btn btn-secondary plus-25" style="border-radius: 20px;">+25 seconds</button>
            </div>
          </div>
          <div class="p-4">
            <div class="row">
              <div class="col-sm-6 col-xs-6">
                <button type="button" id="start" class="btn btn-success btn-block" style="border-radius: 20px;">START</button>
              </div>
              <div class="col-sm-6 col-xs-6">
                <button type="button" id="reset" class="btn btn-danger btn-block" style="border-radius: 20px;">RESET</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Coin-->
  <div class="modal fade" id="modal_coin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background-color: rgb(0 45 4 / 90%)">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h3 class="text-center">Flip a coin!</h3>
          <?php include('coinflip.html') ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">BACK</button>
        </div>
      </div>
    </div>
  </div>
  <?php include('./includes/scripts.php'); ?>
  <!-- SFX SCRIPT -->
  <script>
    function sfxGamePoints() {
      var audio = document.getElementById('sfx_gpoints');
      audio.currentTime = 0;
      audio.play();
    }

    function sfxPerkPoints() {
      var audio = document.getElementById('sfx_ppoints');
      audio.currentTime = 0;
      audio.play();
    }

    function sfxTimesUp() {
      var audio = document.getElementById('sfx_timesup');
      audio.currentTime = 0;
      audio.play();
    }
  </script>
  <!-- SCOREBOARD  -->
  <script>
    $(document).ready(function() {
      // scoreboard table
      $('#dataTable').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
      });

      var gamepoints = parseFloat($('.gamepoints').val());
      var perkpoints = parseFloat($('.perkpoints').val());

      // SAVE SCOREBOARD ON BACK
      $('#back').on('click', function() {
        scoreBoard();
      })
      // SAVE SCOREBOARD ON CONTINUE
      $('.continue').on('click', function() {
        scoreBoard();
      })
      /** GAME POINTS */

      var points_add = 1 //game point per gain
      var points_sub = 1 //game point per deduction
      var perks_gained = 3 //game point per 1 perk point gain
      var perks_used = 3 //points deduction per use
      var perks_time = 5 //Initial time(sec) added for time perk used

      /** ADD GAME POINTS */
      $(document).on('click', '.add', function() {
        //GAME POINTS
        var g_points = $(this).closest('tr').find('.gamepoints').val()
        var total_g_points = parseInt(g_points) + points_add
        $(this).closest('tr').find('.gamepoints').val(total_g_points)
        //GPERKS
        var g_perks = parseInt($(this).closest('tr').find('.gperks').val());
        $(this).closest('tr').find('.gperks').val(g_perks + points_add)
        //POINT PERKS GAINED
        var p_perks = parseInt($(this).closest('tr').find('.gperks').val())

        if (Number.isInteger(p_perks / perks_gained)) {
          var ppoints = parseInt($(this).closest('tr').find('.perkpoints').val())
          $(this).closest('tr').find('.perkpoints').val(ppoints + 1)
          if (parseInt(ppoints) > 1) {
            $(this).closest("tr").find(".hint").prop('disabled', false)
            $(this).closest("tr").find(".chances").prop('disabled', false)
            $(this).closest("tr").find(".time").prop('disabled', false)
          }
          sfxPerkPoints()
        }
        sfxGamePoints();
        scoreBoard()
      })




      /** MINUS GAME POINTS */
      $(document).on('click', '.minus', function() {
        var g_points = $(this).closest('tr').find('.gamepoints').val()
        if (g_points > 0) {
          var total_g_points = parseInt(g_points) - points_sub
          $(this).closest('tr').find('.gamepoints').val(total_g_points)
        }
        sfxGamePoints();
        scoreBoard()
      })
      /** ADD PERK POINTS */
      $(document).on('click', '.add_p', function() {
        var p_points = $(this).closest('tr').find('.perkpoints').val()
        var total_p_points = parseInt(p_points) + points_add
        $(this).closest('tr').find('.perkpoints').val(total_p_points)
        sfxPerkPoints();
        var perkpoint = $(this).closest("tr").find(".perkpoints").val()
        if (parseFloat(perkpoint) > 2) {
          $(this).closest("tr").find(".hint").prop('disabled', false)
          $(this).closest("tr").find(".chances").prop('disabled', false)
          $(this).closest("tr").find(".time").prop('disabled', false)
        } else {
          $(this).closest("tr").find(".hint").prop('disabled', true)
          $(this).closest("tr").find(".chances").prop('disabled', true)
          $(this).closest("tr").find(".time").prop('disabled', true)
        }
        scoreBoard()
      })
      /** MINUS PERK POINTS */
      $(document).on('click', '.minus_p', function() {
        var p_points = $(this).closest('tr').find('.perkpoints').val()
        if (p_points > 0) {
          var total_p_points = parseInt(p_points) - points_sub
          $(this).closest('tr').find('.perkpoints').val(total_p_points)
        }
        sfxPerkPoints();
        var perkpoint = $(this).closest("tr").find(".perkpoints").val()
        if (parseFloat(perkpoint) > 2) {
          $(this).closest("tr").find(".hint").prop('disabled', false)
          $(this).closest("tr").find(".chances").prop('disabled', false)
          $(this).closest("tr").find(".time").prop('disabled', false)
        } else {
          $(this).closest("tr").find(".hint").prop('disabled', true)
          $(this).closest("tr").find(".chances").prop('disabled', true)
          $(this).closest("tr").find(".time").prop('disabled', true)
        }
        scoreBoard()
      })
      $(document).on('input', '.perkpoints', function() {
        sfxPerkPoints();
        scoreBoard()
      })
      /** PERKS BUTTONS */
      $(document).on('click', '#perk_hint', function() {
        var perkpoint = $(this).closest("tr").find(".perkpoints").val()
        if (parseFloat(perkpoint) < 3) {
          $(this).closest("tr").find(".hint").prop('disabled', true)
          $(this).closest("tr").find(".chances").prop('disabled', true)
          $(this).closest("tr").find(".time").prop('disabled', true)
        } else {
          $(this).closest("tr").find(".perkpoints").val(parseFloat(perkpoint) - perks_used);
          if ($(this).closest("tr").find(".perkpoints").val() < 3) {
            $(this).closest("tr").find(".hint").prop('disabled', true)
            $(this).closest("tr").find(".chances").prop('disabled', true)
            $(this).closest("tr").find(".time").prop('disabled', true)
          }
        }
        scoreBoard()
      })
      $(document).on('click', '#perk_chances', function() {
        var perkpoint = $(this).closest("tr").find(".perkpoints").val()
        if (parseFloat(perkpoint) < 3) {
          $(this).closest("tr").find(".hint").prop('disabled', true)
          $(this).closest("tr").find(".chances").prop('disabled', true)
          $(this).closest("tr").find(".time").prop('disabled', true)
        } else {
          $(this).closest("tr").find(".perkpoints").val(parseFloat(perkpoint) - perks_used);
          if ($(this).closest("tr").find(".perkpoints").val() < 3) {
            $(this).closest("tr").find(".hint").prop('disabled', true)
            $(this).closest("tr").find(".chances").prop('disabled', true)
            $(this).closest("tr").find(".time").prop('disabled', true)
          }
        }
        scoreBoard()
      })
      $(document).on('click', '#perk_time', function() {
        var perkpoint = $(this).closest("tr").find(".perkpoints").val()
        if (parseFloat(perkpoint) < 3) {
          $(this).closest("tr").find(".hint").prop('disabled', true)
          $(this).closest("tr").find(".chances").prop('disabled', true)
          $(this).closest("tr").find(".time").prop('disabled', true)
        } else {
          $(this).closest("tr").find(".perkpoints").val(parseFloat(perkpoint) - perks_used);
          if ($(this).closest("tr").find(".perkpoints").val() < 3) {
            $(this).closest("tr").find(".hint").prop('disabled', true)
            $(this).closest("tr").find(".chances").prop('disabled', true)
            $(this).closest("tr").find(".time").prop('disabled', true)
          }
        }
        $('#timer').text(perks_time)
        scoreBoard()
      })




      // SAVE SCORES
      function scoreBoard() {
        var forData = $('#form_scoreboard').serialize();
        $.ajax({
          type: "post",
          url: "scoreboard_add.php",
          data: forData,
          success: function(response) {

          }
        });
      }
    })
  </script>
  <!-- TIMER BUTTONS -->
  <script>
    $(document).ready(function() {

      // TIME BUTTONS SCRIPT
      $('.plus-3').click(function(e) {
        e.preventDefault();
        var timerValue = parseInt($('#timer').text()) + 3
        addTime(timerValue);
      })
      $('.plus-5').click(function(e) {
        e.preventDefault();
        var timerValue = parseInt($('#timer').text()) + 5
        addTime(timerValue);
      })
      $('.plus-10').click(function(e) {
        e.preventDefault();
        var timerValue = parseInt($('#timer').text()) + 10
        addTime(timerValue);
      })
      $('.plus-15').click(function(e) {
        e.preventDefault();
        var timerValue = parseInt($('#timer').text()) + 15
        addTime(timerValue);
      })
      $('.plus-20').click(function(e) {
        e.preventDefault();
        var timerValue = parseInt($('#timer').text()) + 20
        addTime(timerValue);
      })
      $('.plus-25').click(function(e) {
        e.preventDefault();
        var timerValue = parseInt($('#timer').text()) + 25
        addTime(timerValue);
      })

      function addTime(timerValue) {
        $('#timer').text(timerValue)
        sfxGamePoints()
      }

      var timerInterval;

      function startTimer() {
        var timerValue = parseInt($('#timer').text());
        if (timerValue != 0) {
          timerInterval = setInterval(function() {
            timerValue--;
            $('#timer').text(timerValue);
            if (timerValue == 0) {
              // alert("Time's up!");
              sfxTimesUp()
              return stopTimer();
            }
          }, 1000);
        }
      }

      function stopTimer() {
        clearInterval(timerInterval);
        $('#start').prop('disabled', false)
      }

      function resetTimer() {
        stopTimer();
        timerValue = 0;
        $('#timer').text(timerValue);
        $('#start').prop('disabled', false)
      }

      $('#start').click(function() {
        var timerValue = parseInt($('#timer').text());
        startTimer()
        if (timerValue != 0) {
          $(this).prop('disabled', true)
        }

      });
      $('#reset').click(resetTimer);
    });
  </script>
</body>

</html>