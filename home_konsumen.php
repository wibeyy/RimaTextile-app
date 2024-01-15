<?php 
include 'aksilogin/config.php';
  session_start();
   if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>

<?php include  './template_produk/header.php';
?>

<?php
include './template_produk/navbar.php';
?>

<?php
$page = 'home'; include './template_produk/sidebar.php';
?>
     
    <div class="main-panel">
      <div class="content">
        <div class="panel-header bg-secondary-gradient">
          <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
              <div>
                                      
                <h2 class="text-white pb-2 fw-bold">Home</h2>
                <h5 class="text-white op-7 mb-2" >Selamat Datang <i><?php echo $_SESSION['username']; ?></i>  di SPK Pemilihan Produk Terbaik pada Toko Rima Textile dengan Metode SAW</h5>
                
              </div>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Tentang Kami</h4>

                </div>
                <div class="card-body">

                    <p class="text-justify"> Kami bangga menyediakan kain-kain terbaik yang dipilih dengan teliti untuk menghadirkan pesona dalam proyek Anda. Inspirasi baru setiap saat dengan koleksi kami yang diperbarui secara berkala.Kepuasan Anda adalah prioritas kami. Tim kami siap membantu Anda dengan panduan ahli dan rekomendasi produk yang tepat.Kami percaya pada kualitas, keberlanjutan, dan harga terjangkau. Dukung kreasi lokal dan industri tekstil dengan berbelanja di toko kami.

Terima kasih atas dukungan Anda! Selamat berkreasi dengan kain dari Toko Rima Textile.
                  
                </div>
              </div>
            </div>
          </div>
          </div>

        

         
<?php
include './template_produk/footer.php';
?>