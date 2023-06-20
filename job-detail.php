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
        $fetch_jobs = "SELECT Offers.banner_path, Offers.title, Offers.descr, Users.name, Users.email, Offers.id FROM Offers INNER JOIN Users_Offers ON Offers.id=Users_Offers.offer_id INNER JOIN Users ON Users_Offers.user_id=Users.id WHERE Offers.id=$id GROUP BY Offers.id";
        $fetch_comment = "SELECT Users.name, Comments.content FROM Comments INNER JOIN Users ON Comments.user_id=Users.id INNER JOIN Offers ON Comments.offer_id=Offers.id WHERE Offers.id=$id";


        $res_jobs = mysqli_query($conn, $fetch_jobs);
        $res_comment = mysqli_query($conn, $fetch_comment);
        $num_comment = mysqli_num_rows($res_comment);
        
        if(!$res_jobs) die("Error on query");

        $row_jobs = mysqli_fetch_assoc($res_jobs);
        echo "<div class=\"card m-3 w-50 mx-auto\">";
        echo "    <div class=\"card-body\">";
        echo "        <h3 class=\"card-title\">" . $row_jobs['title'] . "</h3>";
        echo "        <img class=\"card-img-top\" src=\"" . $row_jobs['banner_path'] . "\" alt=\"Banner pekerjaan\">";
        echo "        <br><br>";
        echo "        <h6 class=\"card-subtitle mb-2 text-muted\">Ditawarkan oleh: " . $row_jobs['name'] . "</h6>";
        echo "        <p class=\"card-text\">" . $row_jobs['descr'] . "</p>";
        echo "        <p class=\"card-text\">Email: " . $row_jobs['email'] . "</p>";
        echo "        <div>";
        echo "            <h5 class=\"card-title\">$num_comment Komentar</h5>";
        echo "            <form class=\"my-2\" action=\"comment.php\" method=\"post\" enctype=\"multipart/form-data\">";
        echo "                <img class=\"card-img-top mx-2\" src=\"assets/img/profilephoto.jpg\" alt=\"Banner pekerjaan\" style=\"width: 30px; border-radius: 50%\">";
        echo "                <input id=\"content\" type=\"text\" name=\"content\" placeholder=\"Add a comment\">";
        echo "                <input name=\"offer_id\" value=\"{$id}\" style=\"display: none;\">";
        echo "                <button id=\"submitBtn\" type=\"submit\" name=\"post\" class=\"btn btn-primary post-button\">Submit</button>";
        echo "            </form>";
        while($row_comment = mysqli_fetch_assoc($res_comment)) {
            echo "<div>";
            echo "    <img class=\"card-img-top mx-2\" src=\"assets/img/profilephoto.jpg\" alt=\"Banner pekerjaan\" style=\"width: 30px; border-radius: 50%;\">";
            echo "    <span>" . $row_comment['name'] . "</span>";
            echo "    <p class=\"mx-5\">" . $row_comment['content'] . "</p>";
            echo "</div>";
        }
        echo "            ";
        echo "        </div>";
        echo "    </div>";
        echo "</div>";

    } else {
        die("Error on fetching variable");
    }
?>
</div>
</body>
</html>
