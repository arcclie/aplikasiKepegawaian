<?php include 'comp/header.php'; ?>
<?php 

if (isset($_POST['simpan'])) {
  simpan_admin();
}

if (isset($_POST['hapus'])) {
  hapus_admin();
}

if (isset($_POST['update'])) {
  update_admin();
}

?>
<div class="main-content">
  <div class="section__content section__content--p30">
  </div>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="col-sm-6">Data Admin</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12"><br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#exampleModal">
              Tambah Data Admin
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah data admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password">
                      </div>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama">
                      </div>
                      <div class="form-group">
                        <label>Kontak</label>
                        <input type="text" class="form-control" name="kontak">
                      </div>
                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabel -->
            <div class="row">
              <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Kontak</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <?php 
                  $no = 1;
                  foreach (select_admin() as $row):
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $row['nama']; ?></td>
                      <td><?php echo $row['kontak']; ?></td>
                      <td>
                        <?php 
                        if ($row['foto'] != "") {
                          echo '<img src="img/'.$row['foto'].'" width="150">';
                        } else {
                          echo '<img src="img/user_logo.png" width="150">';
                        }
                        ?>
                      </td>
                      <td>
                        <!-- Trigger Modal Update -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update-admin<?= $row['id'] ?>" data-toggle="tooltip" title="Edit">
                          <i class="fa fa-edit"></i>
                        </button>

                        <!-- Modal Update -->
                        <div class="modal fade" id="update-admin<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="update-admin<?= $row['id'] ?>">Edit data admin</h5>
                              </div>
                              <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= $row['username']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" value="<?= $row['password']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $row['nama']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Kontak</label>
                                    <input type="text" class="form-control" name="kontak" value="<?= $row['kontak']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                  <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Trigger Modal Hapus -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-admin<?= $row['id'] ?>" data-toggle="tooltip" title="Hapus">
                          <i class="fa fa-trash"></i>
                        </button>

                        <!-- Modal Hapus -->
                        <form action="" method="POST">
                          <div class="modal fade" id="hapus-admin<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <p class="modal-title" id="hapus-admin<?= $row['id'] ?>" style="text-align: center; font-size: 18px;">Apakah anda yakin?</p>
                                </div>
                                <div class="modal-body">
                                  <p>Nama User</p>
                                  <p><?= $row['nama']; ?></p>
                                  <p>Level User</p>
                                  <p><?= $row['kontak']; ?></p>
                                  <p>Foto Admin</p>
                                  <?php 
                                  if ($row['foto'] != '') {
                                    echo '<img src="img/'.$row['foto'].'" width="150">';
                                  } else {
                                    echo '<img src="img/user_logo.png" width="150">';
                                  }
                                  ?>
                                  <input type="hidden" name="id" value="<?= $row['id'] ?>" class="form-control">
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </td>
                    </tr>
                    <?php 
                    endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- end table -->
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<?php include 'comp/footer.php'; ?>

<?php
// Include the file that contains the database connection


// Function to update admin data
function update_admin() {
  global $koneksi; // Use the global variable $koneksi

  $id = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nama = $_POST['nama'];
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

      // Query to update data
      $query = "UPDATE admin SET username = '$username', password = '$password', nama = '$nama', kontak = '$kontak', foto = '$nama_gambar_baru' WHERE id = '$id'";
      $result = mysqli_query($koneksi, $query);

      if (!$result) {
        die("Query gagal dijalankan: ".mysqli_error($koneksi)." - ".mysqli_error($koneksi));
      }
    } else {
      echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='index.php';</script>";
    }
  } else {
    $query = "UPDATE admin SET username = '$username', password = '$password', nama = '$nama', kontak = '$kontak' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
      die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
  }

  echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
}
?>