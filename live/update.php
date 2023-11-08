<?php
include('db.php');
//$sqlRes = mysqli_query($conn, "SELECT * FROM employee");
$name = $dob = $doj = "";
//echo "ok";
if (!isset($status)) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $doj = mysqli_real_escape_string($conn, $_POST['doj']);
    if (isset($_POST['id']) && isset($_POST['id']) > 0) {
        if (mysqli_query($conn, "update  student set student_name = '$name', student_dob = '$dob', student_doj = '$doj' where student_no = '$id'")) {
            $status = 'true';
            $data  = "Data updated";
            $code  = '10';
        } else {
            $status = 'true';
            $data  = "Data not inserted";
            $code  = '9';
        }
    }
}

echo  json_encode(['status' => $status, 'data' => $data, 'code' => $code]);
