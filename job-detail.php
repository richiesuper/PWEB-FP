<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JoDer - Job Finder</title>
	<link href="assets/stylesheets/style.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <style>
    .center-div {
      text-align: center;
    }
  </style>
</head>

<body>
<?php
	include("navbar.php");
    include("database.php");
    if (isset($_GET['offer_id'])) {
        $id = $_GET['offer_id'];
        $fetch_jobs = "SELECT Offers.banner_path, Offers.title, Offers.descr, Users.name, Offers.id FROM Offers INNER JOIN Users_Offers ON Offers.id=Users_Offers.offer_id INNER JOIN Users ON Users_Offers.user_id=Users.id WHERE Offers.id=$id GROUP BY Offers.id";
        $fetch_employer = "SELECT * FROM Users WHERE id=$id";

        $res_jobs = mysqli_query($conn, $fetch_jobs);
        $res_employer = mysqli_query($conn, $fetch_employer);

        if($res_jobs) {
            $row_jobs = mysqli_fetch_assoc($res_jobs);
            echo "<div class=\"card m-3\">";
            echo "    <div class=\"card-body\">";
            echo "        <h5 class=\"card-title\">" . $row_jobs['title'] . "</h5>";
            echo "        <img class=\"card-img-top\" src=\"" . $row_jobs['banner_path'] . "\" alt=\"Banner pekerjaan\">";
            echo "        <br><br>";
            echo "        <h6 class=\"card-subtitle mb-2 text-muted\">Ditawarkan oleh: " . $row_jobs['name'] . "</h6>";
            echo "        <p class=\"card-text\">" . $row_jobs['descr'] . "</p>";
            echo "    </div>";
            echo "</div>";
        } else {
            die("Error on query");
        }
    } else {
        die("Error on fetching variable");
    }
?>
</div>
</body>
</html>
