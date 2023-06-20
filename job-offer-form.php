<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JoDer - Job Finder - Offers</title>
	<link href="assets/stylesheets/form.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
	<?php include("navbar.php"); ?>
	<div class="container w-50 mt-5">
		<?php if (isset($_GET['status'])) : ?>
			<?php if ($_GET['status'] == 'offerFailed') : ?>
				<h1 class="bg-danger">Offer failed due to technical problem!</h1>
			<?php endif; ?>
		<?php endif; ?>
		<form action="job-offer-post.php" method="post" enctype="multipart/form-data">
			<label for="title">Job Title</label>
			<input id="title" type="text" name="title" placeholder="Job Offer Title" required>
			<label for="descr">Job Description</label>
			<input id="descr" type="text" name="descr" placeholder="Describe Your Job Offer" required>
			<label for="banner">Banner Image</label>
			<input id="banner" type="file" name="banner" required>
			<button id="submitBtn" type="submit" name="post">Post</button>
		</form>
        <!-- <input type="submit" value="Post" name="post" /> -->
	</div>
</body>

</html>
