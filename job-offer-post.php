<?php
include("database.php");

// ambil data dari formulir
$title = $_POST['title'];
$desc = $_POST['descr'];
$banner_path = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('Y-m-d H:i:s');
$extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION); // Get the file extension
$newFileName = $fotobaru . '.' . $extension; // Combine the new filename with the original file extension

// Set path folder tempat menyimpan fotonya
$uploadDirectory = 'assets/img/';
$path = $uploadDirectory . $newFileName;

if(isset($_POST['post'])){
// if(move_uploaded_file($_FILES['foto']['tmp_name'], $path)){ // Cek apakah gambar berhasil diupload atau tidak

    // buat query
    $sql = "INSERT INTO Offers (title, descr, banner_path, pub_datetime) VALUES ('$title', '$desc', '$newFileName', CURRENT_TIMESTAMP)";
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