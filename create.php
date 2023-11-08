<?php
session_start();
//echo "in"; die;
if (isset($_POST['name'])) {
    //C:/xampp/htdocs/aaa\live
    //print_r($_POST);
    $url =  "http://localhost/aaa/live/create.php";
    $ch = curl_init();
    $arr['name'] = $_POST['name'];
    $arr['dob'] = $_POST['dob'];
    $arr['doj'] = $_POST['doj'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
    $result = curl_exec($ch);
    // echo "<pre>";

    // print_r($result);
    // die();

    curl_close($ch);
    $result = json_decode($result, true);


    if (isset($result['status']) && isset($result['code'])  && $result['code'] == 10) {
        $_SESSION['success_mg'] = $result['data'];
        header('location:index.php');
        die();
    } else {
        $result['data'] = "";
        echo $result['data'];
    }
} else {
    header('location:index.php');
}
