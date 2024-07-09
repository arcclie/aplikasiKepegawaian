<?php 

$koneksi = mysqli_connect('localhost', 'root', '', 'absenkaryawan');
$id = $_GET['id'];
$nama_baru = $_POST['nama']; // Assuming the new name is coming from a POST request
$foto_baru = $_FILES['foto']['name']; // Assuming the new photo is coming from a file upload

$select = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id='$id'");
$row = mysqli_fetch_array($select);
$hapus_foto = $row['foto'];

// Upload the new photo if a new one is provided
if ($foto_baru != "") {
    $target_dir = "img/karyawan/";
    $target_file = $target_dir . basename($foto_baru);

    // Check if file upload is successful
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Delete the old photo if it exists
        if ($hapus_foto != "") {
            unlink("img/karyawan/$hapus_foto");
        }
        $foto_baru = $target_file;
    } else {
        $foto_baru = $hapus_foto; // If upload fails, retain the old photo
    }
} else {
    $foto_baru = $hapus_foto; // If no new photo, retain the old photo
}

// Update the record
$query = mysqli_query($koneksi, "UPDATE tb_karyawan SET nama='$nama_baru', foto='$foto_baru' WHERE id='$id'");

if ($query) {
    echo '<script>window.history.back()</script>';
    echo "<meta http-equiv='refresh' content='0'>";
}

?>
i