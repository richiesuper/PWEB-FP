<?php
session_start();
include("database.php");

if (isset($_POST['post'])) {

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
    $banner = $_FILES['banner']['name'];
    $banner_tmp_path = $_FILES['banner']['tmp_name'];
    $banner_storage_path = "assets/img/offer_banners/" . date("YmdHis") . $banner;

    // buat query
    $sql = "INSERT INTO Offers (title, descr, banner_path, pub_datetime) VALUES ('$title', '$desc', '$banner_storage_path', CURRENT_TIMESTAMP)";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if ($query) {
        if (move_uploaded_file($banner_tmp_path, $banner_storage_path)) {
            $offerIdSQL = "SELECT id FROM Offers ORDER BY id DESC LIMIT 1";
            $offerIdQuery = mysqli_query($conn, $offerIdSQL);
            if ($offerIdQuery) {
                $row = mysqli_fetch_assoc($offerIdQuery);
                $usersOffersSQL = "INSERT INTO Users_Offers (offer_id, user_id) VALUES ({$row['id']}, {$_SESSION['id']})";
                $usersOffersQuery = mysqli_query($conn, $usersOffersSQL);
                if ($usersOffersQuery) {
                    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
                    header('Location: job-listing.php?status=sukses');
                } else {
                    header('Location: job-offer-form.php?status=gagal');
                }
            } else {
                header('Location: job-offer-form.php?status=gagal');
            }
        } else {
            header('Location: job-offer-form.php?status=gagal');
        }
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: job-offer-form.php?status=gagal');
    }
} else {
    die("Access denied.");
}
