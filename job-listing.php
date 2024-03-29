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
	<?php include("navbar.php"); ?>
    <div class="p-3">
        <h2>Available Jobs</h2>
    </div>

    <div class="d-flex container-fluid bg-primary">
        <div>
            <?php
            include("database.php");
            $fetch_jobs = "SELECT Offers.banner_path, Offers.title, Offers.descr, Users.name, Offers.id FROM Offers INNER JOIN Users_Offers ON Offers.id=Users_Offers.offer_id INNER JOIN Users ON Users_Offers.user_id=Users.id";
            if (isset($_GET['search'])) {
                $q = $_GET['search'];
                $fetch_jobs = $fetch_jobs . " WHERE Offers.title LIKE '%{$q}%' OR Offers.descr LIKE '%{$q}%' OR Users.name LIKE '%{$q}%'";
            }
            $res = mysqli_query($conn, $fetch_jobs);

            if ($res) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($counter % 2 == 0) {
                        echo '<div class="row justify-content-center">';
                    }
                    
                    $variableValue = $row['id'];
                    $linkUrl = "job-detail.php?offer_id=" . urlencode($variableValue);

                    echo "<div class=\"card m-3 col-4\">";
                    echo "    <div class=\"card-body\">";
                    echo "        <h5 class=\"card-title\">" . $row['title'] . "</h5>";
                    echo "        <img class=\"card-img-top\" src=\"" . $row['banner_path'] . "\" alt=\"Banner pekerjaan\">";
                    echo "        <br><br>";
                    echo "        <h6 class=\"card-subtitle mb-2 text-muted\">Ditawarkan oleh: " . $row['name'] . "</h6>";
                    echo "        <p class=\"card-text\">" . $row['descr'] . "</p>";
                    echo "        <a href=\"$linkUrl\" class=\"card-link\">Info selengkapnya</a>";
                    echo "    </div>";
                    echo "</div>";
                    
                    $counter++;
                    
                    if ($counter % 2 == 0) {
                        echo '</div>';
                    }
                }

                if ($counter % 2 != 0) {
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
