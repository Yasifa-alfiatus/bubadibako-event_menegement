<?php
ob_start();

include '.includes/header.php';

$id = $_GET['id'];
$sql = "DELETE FROM events WHERE event_id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: posts.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>