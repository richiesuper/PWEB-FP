<?php

session_start();

if (isset($_SESSION['email'])) {
	unset($_SESSION['email']);
	unset($_SESSION['type']);
	unset($_SESSION['id']);
	header("Location: index.php");
}