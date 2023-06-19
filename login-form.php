<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JoDer - Job Finder - Register</title>
	<link href="assets/stylesheets/form.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
	<?php include("navbar.php"); ?>
	<div class="container w-50 mt-5">
		<?php if (isset($_GET['status'])) : ?>
			<?php if ($_GET['status'] == 'userExists') : ?>
				<h1 class="bg-danger">The user being registered already exists!</h1>
			<?php elseif ($_GET['status'] == 'registFailed') : ?>
				<h1 class="bg-danger">Registration failed due to technical problem!</h1>
			<?php endif; ?>
		<?php endif; ?>
		<form action="login.php" method="post">
			<label for="email">Email</label>
			<input id="email" type="email" name="email" placeholder="user@mail.com" required>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" onkeyup="validate_passwords()" required>
			<button id="btn submitBtn" type="submit">Login</button>
		</form>
		<span id="warning" class="mt-5 text-center"></span>
	</div>
	<script>
		function validate_passwords() {
			let password = document.querySelector('#password').value;
			let cPassword = document.querySelector('#password-confirm').value;
			let warningSpan = document.querySelector('#warning');
			let registerBtn = document.querySelector('#submitBtn');
			if (password !== "") {
				if (password !== cPassword) {
					warningSpan.textContent = "Passwords don't match!";
					warningSpan.style.display = "inline";
					warningSpan.classList.remove('bg-success');
					warningSpan.classList.add('bg-danger');
					registerBtn.style.display = "none";
				} else {
					warningSpan.textContent = "Passwords match!"
					warningSpan.style.display = "inline";
					warningSpan.classList.remove('bg-danger');
					warningSpan.classList.add('bg-success');
					registerBtn.style.display = "inline";
				}
			} else {
				warningSpan.textContent = "";
				warningSpan.style.display = "none";
				registerBtn.style.display = "none";
			}
		}
	</script>
</body>

</html>
