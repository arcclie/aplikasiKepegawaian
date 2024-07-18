<?php 
$koneksi = mysqli_connect('localhost', 'root', '', 'absenkaryawan');

$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi, "SELECT * FROM tb_karyawan");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$nomor = $halaman_awal + 1;

// cari
if (isset($_POST['go'])) {
  $cari = $_POST['cari'];
  $karyawan = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE nama LIKE '%".$cari."%'");
} else {
  $karyawan = mysqli_query($koneksi, "SELECT * FROM tb_karyawan LIMIT $halaman_awal, $batas");
}

foreach ($karyawan as $pro):
  ?>
  <tr>
    <td><?= $i++; ?></td>
    <td><?= $pro['nip']; ?></td>
    <td><?= $pro['nama']; ?></td>
    <td><?= $pro['tempat_lahir']; ?></td>
    <td><?= $pro['tanggal_lahir']; ?></td>
    <td><?= $pro['alamat']; ?></td>
    <td><?= $pro['kontak']; ?></td>
    <td>
      <?php 
      if ($pro['foto'] != '') {
        echo '<img src="img/karyawan/'.$pro['foto'].'" width="250">';
      } else {
        echo '<img src="img/user_logo.png" width="250">';
      }
      ?>
    </td>
    <td>
      <button class="btn btn-success" data-toggle="modal" data-target="#edit_karyawan<?=$pro['id'];?>">Edit</button>
      <button class="btn btn-danger" data-toggle="modal" data-target="#hapus_karyawan<?=$pro['id'];?>">Hapus</button>
      
      <!-- Modal Edit -->
      <div class="modal fade" id="edit_karyawan<?=$pro['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit data karyawan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$pro['id'];?>">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control" name="nip" value="<?=$pro['nip'];?>">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" value="<?=$pro['username'];?>">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control" name="password" value="<?=$pro['password'];?>">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?=$pro['nama'];?>">
                </div>
                <div class="form-group">
                  <label>Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir" value="<?=$pro['tempat_lahir'];?>">
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tanggal_lahir" value="<?=$pro['tanggal_lahir'];?>">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control"><?=$pro['alamat'];?></textarea>
                </div>
                <div class="form-group">
                  <label>Kontak</label>
                  <input type="text" class="form-control" name="kontak" value="<?=$pro['kontak'];?>">
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input type="file" class="form-control" name="foto">
                  <?php 
                  if ($pro['foto'] != '') {
                    echo '<img src="img/karyawan/'.$pro['foto'].'" width="250">';
                  } else {
                    echo '<img src="img/user_logo.png" width="250">';
                  }
                  ?>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="update" class="btn btn-primary">Update</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Hapus -->
      <div class="modal fade" id="hapus_karyawan<?=$pro['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$pro['id'];?>" hidden>
                <label>NIP : </label>
                <b><?=$pro['nip'];?></b><br>
                <label>Nama : </label>
                <b><?=$pro['nama'];?></b><br>
                <label>Tempat Lahir : </label>
                <b><?=$pro['tempat_lahir'];?></b><br>
                <label>Tanggal Lahir : </label>
                <b><?=$pro['tanggal_lahir'];?></b><br>
                <label>Alamat : </label>
                <b><?=$pro['alamat'];?></b><br>
                <label>Kontak : </label>
                <b><?=$pro['kontak'];?></b><br>
                <label>Foto : </label>
                <?php 
                if ($pro['foto'] != "") {
                  echo '<img src="img/karyawan/'.$pro['foto'].'" width="250">';
                } else {
                  echo '<img src="img/user_logo.png" width="250">';
                }
                ?>
                <div class="modal-footer">
                  <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </td>
  </tr>
<?php endforeach; ?>

<script>
function showAlert(message) {
    alert(message);
}

<?php if (isset($_POST['update'])): ?>
    showAlert('Data berhasil diubah.');
<?php endif; ?>
</script>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $foto = $_FILES['foto']['name'];

    if ($foto != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak.'-'.$foto;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, 'img/'.$nama_gambar_baru);

            $query = "UPDATE tb_karyawan SET nip = '$nip', username = '$username', password = '$password', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', kontak = '$kontak', foto = '$nama_gambar_baru' WHERE id = '$id'";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='index.php';</script>";
        }
    } else {
        $query = "UPDATE tb_karyawan SET nip = '$nip', username = '$username', password = '$password', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', kontak = '$kontak' WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
    }

    echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
}
?>
