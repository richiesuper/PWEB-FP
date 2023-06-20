<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("database.php");

$comment = $_POST['content'];
$offer_id = $_POST['offer_id'];
$user_id = $_SESSION['id'];
$escaped_comment = mysqli_real_escape_string($conn, $comment);

$sql = "INSERT INTO Comments (user_id, offer_id, content) VALUES ({$user_id}, {$offer_id}, {$escaped_comment})";
$res = mysqli_query($conn, $sql);

if ($res) {
    header("Location: job-detail.php?offer_id={$offer_id}");
} else {
    die("Error while fetching query");
}
