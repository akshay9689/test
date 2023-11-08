<?php
session_start();
$url = "http://localhost/aaa/live/index.php";
//$url = "https://www.google.co.in/";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);

// echo '<pre>';
// print_r($result);
// echo '</pre>';


// die();

?>


<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PHP API CRUD opearation</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <div class="container">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-md-12">

              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php if (isset($_SESSION['success_mg'])) {
                  echo  $_SESSION['success_mg'];
                } ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="col-sm-8">
              <h2>Student <b>Details</b></h2>
            </div>
            <div class="col-sm-4">
              <a href="add.php" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New</a>
            </div>
          </div>
        </div>
        <?php
        if (isset($result['status']) && isset($result['code']) && isset($result['code']) == 5) {
        ?>

          <form action="" method="POST" id="myform">

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Student dob</th>
                  <th>Student doj</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($result['data'] as $list) {

                ?>
                  <tr>
                    <td><?php echo $list['student_name'] ?></td>
                    <td><?php echo $list['student_dob'] ?></td>
                    <td><?php echo $list['student_doj'] ?></td>
                    <td>
                      <a href="edit.php?id=<?php echo $list['student_no'] ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                      <a href="delete.php?id=<?php echo $list['student_no'] ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                    </td>
                  </tr>

                <?php

                } ?>


              </tbody>
            </table>
          </form>

        <?php

        } else {
          //echo $result['data'];
        }

        ?>

      </div>
    </div>
  </div>


  
</body>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</html>