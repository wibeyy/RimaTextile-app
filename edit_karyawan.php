
<?php 

  session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }
?>

<?php $page = 'data_karyawan'; include  './template/header.php';
?>

<?php
 include './template/navbar.php';
?>
<?php
$page = 'karyawan'; include './template/sidebar.php';
?>

<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Edit Karyawan Lapangan</h4>
								</div>
<div class="card-body">
									<div class="row">
										  <?php 
										  include 'aksilogin/config.php';
										  $id = $_GET['id'];
										  $data = mysqli_query($koneksi, "SELECT * FROM tbl_karyawan WHERE id='$id'");
										  $nomor = 1;
										  while($d = mysqli_fetch_array($data)){
										  ?>
										<div class="col-md-6 pr-1">
											<form action="./karyawan/update_karyawan.php" method="post">
											<div class="form-group">
												<label>Nama</label>
												<input type="hidden" name="id" value="<?php echo $d['id'] ?>">
                        						<input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>">
											</div> 
											<div class="form-group">
												<label>Status</label>
												<input type="text" class="form-control" name="status" value="<?php echo $d['status'] ?>">
											</div>
											<div class="form-group">
												<label>Alamat</label>
												<input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>">
											</div>
											
								
									<td><button class="btn btn-primary" type="submit" value="Simpan"><i class="far fa-check-circle"> Simpan</i></td>
							
							</form>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
					</div>
					</div>
				</div>
			</div>

<?php
include './template/footer.php';
?>