<?php
session_start();
include("database.php");

$e = $_POST['email'];
$p = $_POST['password'];

$check_prior_registration_sql = "SELECT * FROM Users WHERE email = '$e'";
$res = mysqli_query($conn, $check_prior_registration_sql);

if ($res) {
    $row = mysqli_fetch_assoc($res);
    $password = md5($p);
    if($password == $row['password']) {
        $_SESSION['email'] = $e;
	} else {
       die("Error password or email doesn't match");
	}

    header("Location: index.php");
} else {
    die("Error while fetching query");
}
?>
