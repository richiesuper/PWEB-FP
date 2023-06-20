<?php
include("database.php");

$e = $_POST['email'];
$n = $_POST['name'];
$p = $_POST['password'];
$t = $_POST['type'];

$check_prior_registration_sql = "SELECT id FROM Users WHERE email = '$e'";
$res = mysqli_query($conn, $check_prior_registration_sql);

if ($res) {
	if (mysqli_num_rows($res) > 0) {
		header("Location: register-form.php?status=userExists");
	} else {
        try{
            $register_sql = "INSERT INTO Users (email, name, password, type) VALUES ('$e', '{$n}', MD5('{$p}'), {$t})";
            $res = mysqli_query($conn, $register_sql);
        } catch(mysqli_sql_exception) {
            die("Error while inserting");
        }

		if ($res) {
			header("Location: login-form.php?status=registSuccessful");
		} else {
			header("Location: register-form.php?status=registFailed");
		}
	}
} else {
    die("Error while fetching query");
}
