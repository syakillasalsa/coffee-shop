<?php
include('db/config.php');
session_start();

if(!isset($_SESSION['admin_login'])) {
    header("location: login.php");
}

$id = $_GET['id'];

$sql = "DELETE FROM orders WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("location: manage_orders.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
