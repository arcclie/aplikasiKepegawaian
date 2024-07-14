<?php 

$koneksi = mysqli_connect('localhost', 'root', '', 'absenkaryawan');

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$nip = $_POST['nip'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$nama = $_POST['nama'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$alamat = $_POST['alamat'];
	$kontak = $_POST['kontak'];
	$foto = $_FILES['foto']['name'];

	// unlink 
	$select = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id='$id'");
	$row = mysqli_fetch_array($select);

	$hapus_foto = $row['foto'];

	if(isset($_POST['ubahfoto']))
	{
		if ($row['foto']=="") 
		{
			if ($foto != "") {
				$allowed_ext = array('png','jpg');
				$x = explode(".", $foto);
				$ekstensi = strtolower(end($x));
				$file_tmp = $_FILES['foto']['tmp_name'];
				$angka_acak = rand(1,999);
		   		$nama_file_baru = $angka_acak.'-'.$foto;
		   		if (in_array($ekstensi, $allowed_ext) === true) {
		      		move_uploaded_file($file_tmp, 'img/karyawan/'.$nama_file_baru);
		      		$result =  mysqli_query($koneksi, "UPDATE tb_karyawan SET nip='$nip', username='$username', password='$password', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', kontak='$kontak', foto='$nama_file_baru' WHERE id='$id'");
		      		if ($result) {
		      			echo '<script>window.history.back()</script>';
		      			echo "<meta http-equiv='refresh' content='0'>";
		      		}
		   		}
			}
		} else if ($row['foto']!="") {
			if ($foto != "") {
				$allowed_ext = array('png','jpg');
				$x = explode(".", $foto);
				$ekstensi = strtolower(end($x));
				$file_tmp = $_FILES['foto']['tmp_name'];
				$angka_acak = rand(1,999);
		   		$nama_file_baru = $angka_acak.'-'.$foto;
		   		if (in_array($ekstensi, $allowed_ext) === true) {
		      		move_uploaded_file($file_tmp, 'img/karyawan/'.$nama_file_baru);
		      		$result =  mysqli_query($koneksi, "UPDATE tb_karyawan SET nip='$nip', username='$username', password='$password', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', kontak='$kontak', foto='$nama_file_baru' WHERE id='$id'");
		      		if ($result) {
		      			unlink("img/karyawan/$hapus_foto");
		      			echo '<script>window.history.back()</script>';
		      			echo "<meta http-equiv='refresh' content='0'>";
		      		}
		   		}
			}
		}	
	}

	if (empty($_POST['foto'])) {
		$result = mysqli_query($koneksi, "UPDATE tb_karyawan SET nip='$nip', username='$username', password='$password', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', kontak='$kontak' WHERE id='$id'");
		if ($result) {
			echo '<script>window.history.back()</script>';
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}
}

?>
