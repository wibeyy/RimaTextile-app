<?php 
include './aksilogin/config.php'; 

?>

<?php $page = 'data_siswa'; include './template/header.php';
?>

<?php include './template/navbar.php';
?>
<?php
$page = 'produk'; include './template/sidebar.php';
?>
<div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Produk</h4>
                                </div>
								<div class="card-body">
									<div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <form action="./produk/input_produk.php" method="post">
                                      
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control" name="nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control" name="status" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe</label>
                                                <input type="text" class="form-control" name="alamat" required>
                                            </div>
                                            
                                
                                    <td><button class="btn btn-primary" type="submit" value="Simpan"><i class="far fa-check-circle"> Simpan</i></td>
                            </tr>
                       
                    </form>


<?php
include './template/footer.php';
?>