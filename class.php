<?php
include('./session.php');
include('./includes/config.php');
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
  <link rel="stylesheet" href="<?= $assets ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Von Custom layout -->
  <!-- <link rel="stylesheet" href="Layout.css"> -->

</head>
<style>
  hr {
    border: 5px solid rgb(0 45 4);
  }

  .top {
    position: fixed;
    top: 2%;
    left: 0;
    right: 0;
  }

  .bottom {
    position: fixed;
    bottom: 2%;
    left: 0;
    right: 0;
  }

  h4 b {
    font-family: 'Trebuchet MS';
    font-weight: 1000;
    font-size: 200%;
    color: #002D04;
  }

  a {
    font-family: 'Trebuchet MS';
    font-weight: 1000;
    font-size: 220%;
  }

  .box {
    /* background-color: #dde0e3; */
    transition: box-shadow 0.3s ease;
  }

  .box:focus {
    outline: none;
    box-shadow: 2px 11px 19px 8px rgb(255 246 0), 0 1px 3px rgba(0, 0, 0, .2);
  }

  .box:hover {
    outline: none;
    box-shadow: 2px 11px 19px 8px rgb(255 246 0), 0 1px 3px rgba(0, 0, 0, .2);
  }
</style>

<body class="hold-transition sidebar-mini">
  <audio src="./sfx/mainbg.mp3" autoplay loop></audio>
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content m-4">
      <hr>
      <!-- Content Header (Page header) -->
      <section class="content">

        <div class="container-fluid">
          <div class="row mb-2">

            <div class="col-4">
              <a href="welcome.php" type="button" class="btn btn-lg" style="background-color: #002D04;color:white">Return</a>
            </div>

            <div class="col-4">
              <h4 class="text-center"><b>Select Class</b></h4>
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
      <section class="content">
        <div class="card ml-5 mr-5">
          <div class="card-body p-0">
            <div class="row ml-5 ml-5 mr-5 mt-5">
              <?php
              $class = '<div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="createclass.php">
                              <div class="box card text-center bg-olive ml-3 mr-3 flex-wrap" style="border-radius: 1.25rem;" tabindex="0">
                                <div class="p-3">
                                  <h2>Add Class</h2>
                                </div>
                                <div class="card-body">
                                  <h1><b class="fa fa-plus"></b></h1>
                                </div>
                              </div>
                            </a>
                          </div>';

              $teacher_id = $_SESSION['teacherId'];
              $sql = "SELECT id, section, subject FROM classes WHERE teacherid = '$teacher_id' ORDER BY ID ASC";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                foreach ($result as $row) {
                  $class .= '<div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#"  id="card" class="info" data-id="' . $row['id'] . '" data-class="' . $row['section'] . '" data-subj="' . $row['subject'] . '"">
                                  <div class="box card text-center bg-olive ml-3 mr-3 box" style="border-radius: 1.25rem;" tabindex="0">
                                    <div class="p-3">
                                      <h2>' . $row['section'] . '</h2>
                                    </div>
                                    <div class="card-body" style="background-color: #002D04;color:white;border-radius: 1.25rem;">
                                      <h1><b>' . $row['subject'] . '</b></h1>
                                    </div>
                                  </div>
                                </a>
                              </div>';
                }

                echo $class;
              } else {
                echo '<div class="col-xs-12 col-sm-6 col-md-3">
                          <a href="createclass.php">
                            <div class="box card text-center bg-olive ml-3 mr-3 flex-wrap" style="border-radius: 1.25rem;" tabindex="0">
                              <div class="p-3">
                                <h2>Add Class</h2>
                              </div>
                              <div class="card-body">
                                <h1><b class="fa fa-plus"></b></h1>
                              </div>
                            </div>
                          </a>
                        </div>';
                echo "<h1>No classes and subjects found for this teacher.</h1>";
              }
              ?>

            </div>
          </div>
          <div class="card-footer" style="display: none;">
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="btn-group-lg">
                  <form action="players.php" method="post" id="form_class_id">
                    <input type="hidden" id="selected_card" name="class_id">
                  </form>
                  <a href="players.php" type="button" class="btn btn-lg view p-3 pl-4 pr-4 mr-3" style="background-color: #002D04;color:white">Manage Class</a>
                  <a href="#" type="button" class="btn btn-lg edit p-3 pl-4 pr-4 mr-3" data-toggle="modal" data-target="modal_edit_class" style="background-color: #002D04;color:white">Edit Class</a>
                  <a href="#" type="button" class="btn btn-lg delete p-3 pl-4 pr-4 mr-3" data-toggle="modal" data-target="modal_delete_class" style="background-color: #002D04;color:white">Delete Class</a>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <form action="scoreboard.php" method="post" id="form_class_id_continue">
                  <input type="hidden" id="selected_card_continue" name="class_id_continue">
                </form>
                <a href="scoreboard.php" type="button" class="btn btn-lg float-right p-3 continue" style="background-color: #002D04;color:white">Continue</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>


  </div>
  <!-- ./wrapper -->
  <div class="bottom">
    <hr style="width: 95%;">
  </div>
  <!-- Modal EDIT CLASS-->
  <div class="modal fade" id="modal_edit_class" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background-color: rgb(0 45 4 / 90%)">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Class / Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="class_edit.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="edit_class">Class/Section #</label>
              <input type="text" class="form-control" name="edit_class" id="edit_class" placeholder="Class/Section #:" required>
            </div>
            <div class="form-group">
              <label for="edit_subject">Subject</label>
              <input type="text" class="form-control" name="edit_subject" id="edit_subject" placeholder="Subject:" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="id" id="edit_class_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">BACK</button>
            <button type="submit" class="btn btn-success">SAVE</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal DELETE CLASS-->
  <div class="modal fade" id="modal_delete_class" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background-color: rgb(0 45 4 / 90%)">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa fa-question"></i> Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="class_delete.php" method="post">
          <div class="modal-body">
            <p>Deleting <b id="delete_class"></b> will also delete it's players data. Continue deleting this class?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="id" id="delete_class_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-success">YES</button>
          </div>
        </form>
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
  <script>
    $(document).ready(function() {

      // VIEW PLAYERS ON SELECTED CLASS
      $('.view').on('click', function(e) {
        e.preventDefault();
        $('#form_class_id').submit();
      })

      // VIEW SCOREBOARD ON SELECTED CLASS
      $('.continue').on('click', function(e) {
        e.preventDefault();
        $('#form_class_id_continue').submit();
      })


      // FILLOUT DETAILS ON MODAL
      $('.info').on('click', function(e) {
        e.preventDefault();
        $('#selected_card').val($(this).data('id'))
        $('#selected_card_continue').val($(this).data('id'))
        $('#edit_class').val($(this).data('class'))
        $('#edit_subject').val($(this).data('subj'))
        $('#delete_class').html($(this).data('class'))

        $('.card-footer').attr('style', 'display:block');
      });
      // EDIT CLASS
      $('.edit').on('click', function() {
        $('#modal_edit_class').modal('show')
        $('#edit_class_id').val($('#selected_card').val())
      })
      // DELETE CLASS
      $('.delete').on('click', function() {
        $('#modal_delete_class').modal('show')
        $('#delete_class_id').val($('#selected_card').val())
        $('#delete_class').val($('#selected_card').val())
      })
    })
  </script>
</body>

</html>
