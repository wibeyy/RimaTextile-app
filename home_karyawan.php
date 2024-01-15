<?php 
include 'aksilogin/config.php';
  session_start();
   if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>

<?php include  './template_karyawan/header.php';
?>

<?php
include './template_karyawan/navbar.php';
?>

<?php
$page = 'home'; include './template_karyawan/sidebar.php';
?>
     
    <div class="main-panel">
      <div class="content">
        <div class="panel-header bg-secondary-gradient">
          <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
              <div>
                                      
                <h2 class="text-white pb-2 fw-bold">Home</h2>
                <h5 class="text-white op-7 mb-2" >Selamat Datang <i><?php echo $_SESSION['username']; ?></i>  di SPK Pemilihan Karyawan pada PT. Alinia dengan Metode SAW</h5>
                
              </div>
              </div>
          </div>
        </div>

        

         
<?php
include './template_karyawan/footer.php';
?>