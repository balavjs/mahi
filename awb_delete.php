<?php
session_start();
include('class/class_awb.php');
$result = new DB_awb();

$id = $_GET['id'];

$sql = $result->delete($id);

if ($sql) {
    $_SESSION['success'] = "Airwaybill deleted successfully";
    header('location:awb_view.php');
} else {
    $_SESSION['error'] = "Airwaybill not deleted!";
    header('location:awb_view.php');
}
