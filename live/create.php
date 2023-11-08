<?php
include('db.php');
$student_name = $student_dob = $student_doj = "";
//echo "ok"; exit();
if (!isset($status)) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $doj = mysqli_real_escape_string($conn, $_POST['doj']);
    if (isset($_POST['name'])) {
        if (mysqli_query($conn, "insert into student (student_name, student_dob, student_doj) values ('$name', '$dob', '$doj')")) {
            $status = 'true';
            $data  = "Data inseted";
            $code  = '10';
        } else {
            $status = 'true';
            $data  = "Data not inserted";
            $code  = '9';
        }
    }
}

echo  json_encode(['status' => $status, 'data' => $data, 'code' => $code]);
