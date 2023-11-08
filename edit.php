<?php
if (isset($_GET['id']) && isset($_GET['id']) > 0) {
    
    $url = "http://localhost/aaa/live/edit.php";
    $ch = curl_init();
    $arr['id'] = $_GET['id'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
    $result = curl_exec($ch);
    //print_r($result); die;
    curl_close($ch);

    $result = json_decode($result, true);

    // echo '<pre>';
    // print_r($result); die;
    // echo '</pre>'; exit();

} else {
    echo "id not found";
}

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
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Edid <b>Student</b></h2>
                        </div>
                    </div>
                </div>
                
                    <form action="update.php" method="POST" id="myform">

                        <table class="table table-bordered">

                            <?php foreach ($result['data'] as $list) {

                            ?>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $list['student_no'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>student Name</label>
                                    <input type="text" name="name" value="<?php echo $list['student_name'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>student DOB</label>
                                    <input type="date" name="dob" value="<?php echo $list['student_dob'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>student DOJ</label>
                                    <input type="date" name="doj" value="<?php echo $list['student_doj'] ?>" class="form-control">
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Save</button>

                            <?php

                            } ?>

                    </form>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-4">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1190033123418031" crossorigin="anonymous"></script>
                <!-- live_demo_page -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1190033123418031" data-ad-slot="5335471635" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



</html>