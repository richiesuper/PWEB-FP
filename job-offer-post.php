<?php
include("database.php");

if(isset($_POST['post'])){

    // $title = $_POST['title'];
    // $desc = $_POST['descr'];

    // $check_prior_registration_sql = "SELECT id FROM Offers WHERE title = '$title'";
    // $res = mysqli_query($conn, $check_prior_registration_sql);

    // if ($res) {
    //     try{
    //         $offer_sql = "INSERT INTO Offers (title, descr, pub_datetime) VALUES ('$title', '$desc', CURRENT_TIMESTAMP)";
    //         $res = mysqli_query($conn, $offer_sql);
    //     } catch(mysqli_sql_exception) {
    //         die("Error while inserting");
    //     }

    //     if ($res) {
    //         header("Location: job-listing.php?status=offerSuccessful");
    //     } else {
    //         header("Location: job-offer-form.php?status=offerFailed");
    //     }
    // } else {
    //     die("Error while fetching query");
    // }

    // ambil data dari formulir
    $title = $_POST['title'];
    $desc = $_POST['descr'];

    // buat query
    $sql = "INSERT INTO Offers (title, descr, banner_path, pub_datetime) VALUES ('$title', '$desc', 'assets/img/image.png', CURRENT_TIMESTAMP)";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: job-listing.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: job-offer-form.php?status=gagal');
    }
}

else {
    die("Access denied.");
}