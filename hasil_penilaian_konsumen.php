<?php
 // Koneksi
include 'aksilogin/config.php';
// mengaktifkan session
  session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }
?>

<?php  include './template_produk/header.php';
?>      


<?php
include './template_produk/navbar.php';
?>

<?php
$page = 'hasil_penilaian_konsumen'; include './template_produk/sidebar.php';
?>
      <div class="main-panel">
      <div class="content">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-12">
              
                <div class="card-header" >
                  <h4 class="card-title">Hasil Perhitungan</h4>
                </div>
                <div class="card">
                <div class="card-body" >

 <?php
// $bobot = array(0.30,0.20,0.30,0.20);



 //Buat fungsi tampilkan nama
 function getNama($id){
  include 'aksilogin/config.php';
  $q =mysqli_query($koneksi, "SELECT * FROm tb_alternatif where id_alternatif = '$id'");
  $d = mysqli_fetch_array($q);
  return $d['nama_alternatif'];
 }
 
 //Setelah bobot terbuat select semua di tabel Matrik


 $qkriteria = mysqli_query($koneksi, "SELECT * from tbl_kriteria");

 $sql = mysqli_query($koneksi,"SELECT * FROM tb_nilai");
 //Buat tabel untuk menampilkan hasil

 $no = 1;
 while ($dt = mysqli_fetch_array($sql)) {
  $jumlah= ($dt['kriteria1'])+($dt['kriteria2'])+($dt['kriteria3'])+($dt['kriteria4'])+($dt['kriteria5'])+($dt['kriteria6'])+($dt['kriteria7'])+($dt['kriteria8'])+($dt['kriteria9']);
 
 $no++;
 }
 
 //Lakukan Normalisasi dengan rumus pada langkah 2
 //Cari Max atau min dari tiap kolom Matrik
 $cr = mysqli_query($koneksi, "SELECT 
      min(kriteria1) as minK1, 
      min(kriteria2) as minK2,
      min(kriteria3) as minK3,
      min(kriteria4) as minK4,
      min(kriteria5) as minK5,
      min(kriteria6) as minK6,
      min(kriteria7) as minK7,
      min(kriteria8) as minK8,
      min(kriteria9) as minK9,
    
     
      
      max(kriteria1) as maxK1,
      max(kriteria2) as maxK2,
      max(kriteria3) as maxK3,
      max(kriteria4) as maxK4,
      max(kriteria5) as maxK5,
      max(kriteria6) as maxK6,
      max(kriteria7) as maxK7,
      max(kriteria8) as maxK8,
      max(kriteria9) as maxK9

   FROM tb_nilai");
 $atribut = mysqli_fetch_array($cr);

 //$kriteria = mysql_query("SELECT (atribute) as atr  FROM kriteria")
 
 //Hitung Normalisasi tiap Elemen
 $sql2 = mysqli_query($koneksi, "SELECT * FROM tb_nilai");
 //Buat tabel untuk menampilkan hasil
$qkriteria = mysqli_query($koneksi, "SELECT * from tbl_kriteria");


$qk = mysqli_query($koneksi, "SELECT * FROM tbl_kriteria");
while ($row = mysqli_fetch_array($qk)) {
    if ($row['atribute'] == "benefit") {
    if ($row['id_kriteria'] == 1) {
        $k1 = "benefit";
      } elseif ($row['id_kriteria'] == 2) {
        $k2 = "benefit";
      } elseif ($row['id_kriteria'] == 3) {
        $k3 = "benefit";
      } elseif ($row['id_kriteria'] == 4) {
        $k4 = "benefit";
      } elseif ($row['id_kriteria'] == 5) {
        $k5 = "benefit";
      } elseif ($row['id_kriteria'] == 6) {
        $k6 = "benefit";
      } elseif ($row['id_kriteria'] == 7) {
        $k7 = "benefit";
      } elseif ($row['id_kriteria'] == 8) {
        $k8 = "benefit";
      } elseif ($row['id_kriteria'] == 9) {
        $k9 = "benefit";
      } 
    } else {
      if ($row['id_kriteria'] == 1) {
        $k1 = "cost";
      } elseif ($row['id_kriteria'] == 2) {
        $k2 = "cost";
      } elseif ($row['id_kriteria'] == 3) {
        $k3 = "cost";
      } elseif ($row['id_kriteria'] == 4) {
        $k4 = "cost";
      } elseif ($row['id_kriteria'] == 5) {
        $k5 = "cost";
      } elseif ($row['id_kriteria'] == 6) {
        $k6 = "cost";
      } elseif ($row['id_kriteria'] == 7) {
        $k7 = "cost";
      } elseif ($row['id_kriteria'] == 8) {
        $k8 = "cost";
      } elseif ($row['id_kriteria'] == 9) {
        $k9 = "cost";
      } 
  }  
}




 //Proses perangkingan dengan rumus langkah 3
 $sql3 = mysqli_query($koneksi,"SELECT * FROM tb_nilai");

 //Buat tabel untuk menampilkan hasil
 echo "<H3>Perangkingan</H3>
 <table class='table table-bordered'>
  <tr>
   <td style='text-align:center;'>No</td>
   <td>Nama</td>
   <td style='text-align:center;'>Jumlah Perhitungan Metode SAW</td>
   <td style='text-align:center;'>Keterangan</td>
  </tr>
  ";


$bobotArray = array('');

$qb = mysqli_query($koneksi, "SELECT * from tbl_kriteria");

while ($b = mysqli_fetch_array($qb)) {
  // $bobotArray = $bobot['bobot'];
  array_push($bobotArray, $b['bobot']);
}

//Kita gunakan rumus (Normalisasi x bobot)
 while ($dt3 = mysqli_fetch_array($sql3)) {
  //$jumlah= ($dt3['kriteria1'])+($dt3['kriteria2'])+($dt3['kriteria3'])+($dt3['kriteria4']);

 $normalisasi1 = 0;
  $normalisasi2 = 0;
  $normalisasi3 = 0;
  $normalisasi4 = 0;
  $normalisasi5 = 0;
  $normalisasi6 = 0;
  $normalisasi7 = 0;
  $normalisasi8 = 0;
  $normalisasi9 = 0;

 

if ($k1 == "benefit") {
    $normalisasi1 = $dt3['kriteria1']/$atribut['maxK1'];
} else {
  $normalisasi1 = $atribut['minK1']/$dt3['kriteria1'];
} 
if ($k2 == "benefit") {
    $normalisasi2 = $dt3['kriteria2']/$atribut['maxK2'];
} else {
  $normalisasi2 = $atribut['minK2']/$dt3['kriteria2'];
}
if ($k3 == "benefit") {
    $normalisasi3 = $dt3['kriteria3']/$atribut['maxK3'];
} else {
  $normalisasi3 = $atribut['minK3']/$dt3['kriteria3'];
}
if ($k4 == "benefit") {
    $normalisasi4 = $dt3['kriteria4']/$atribut['maxK4'];
} else {
  $normalisasi4 = $atribut['minK4']/$dt3['kriteria4'];
}
if ($k5 == "benefit") {
    $normalisasi5 = $dt3['kriteria5']/$atribut['maxK5'];
} else {
  $normalisasi5 = $atribut['minK5']/$dt3['kriteria5'];
}
if ($k6 == "benefit") {
    $normalisasi6 = $dt3['kriteria6']/$atribut['maxK6'];
} else {
  $normalisasi6 = $atribut['minK6']/$dt3['kriteria6'];
}
if ($k7 == "benefit") {
    $normalisasi7 = $dt3['kriteria7']/$atribut['maxK7'];
} else {
  $normalisasi7 = $atribut['minK7']/$dt3['kriteria7'];
}
if ($k8 == "benefit") {
    $normalisasi8 = $dt3['kriteria8']/$atribut['maxK8'];
} else {
  $normalisasi8 = $atribut['minK8']/$dt3['kriteria8'];
}
if ($k9 == "benefit") {
    $normalisasi9 = $dt3['kriteria9']/$atribut['maxK9'];
} else {
  $normalisasi9 = $atribut['minK9']/$dt3['kriteria9'];
}



$poin = round(
   ($normalisasi1*$bobotArray[1])+
   ($normalisasi2*$bobotArray[2])+
   ($normalisasi3*$bobotArray[3])+
   ($normalisasi4*$bobotArray[4])+
   ($normalisasi5*$bobotArray[5])+
   ($normalisasi6*$bobotArray[6])+
   ($normalisasi7*$bobotArray[7])+
   ($normalisasi8*$bobotArray[8])+
   ($normalisasi9*$bobotArray[9]),2);
   
  // $poin= round(
  //  (($dt3['kriteria1']/$atribut['minK1'])*$bobotArray[1])+
  //  (($dt3['kriteria2']/$atribut['minK2'])*$bobotArray[2])+
  //  (($dt3['kriteria3']/$atribut['maxK3'])*$bobotArray[3])+
  //  (($dt3['kriteria4']/$atribut['maxK4'])*$bobotArray[4]),3);

  $data[]=array('nama_alternatif'=>getNama($dt3['id_alternatif']),
      'poin'=>$poin);

 }
 //mengurutkan data
   foreach ($data as $key => $isi) {
    $nama[$key]=$isi['nama_alternatif'];
    
    $poin1[$key]=$isi['poin'];
   }
   array_multisort($poin1,SORT_DESC,$data);
   $no=1;
   $h="peringkat";
   $peringkat=1;
   $hr=1;

   foreach ($data as $item) { ?>
   <tr>
   <td style='text-align:center;'><?php echo $no ?></td>
   <td><?php echo$item['nama_alternatif'] ?></td>
   
   <td style='text-align:center;'><?php echo$item['poin'] ?></td>
   <td style='text-align:center;'><?php echo"$h $peringkat" ?></td>
   </tr>
   <?php
   $no++;
   if ($no>=100) {
    $h="  ";
    $peringkat=" ";
   }else{
    $peringkat++;
   }

   }
   echo "</table>";


?>



 </div>
  </div>
   </div>
    </div>
      </div>
<?php
include './template_produk/footer.php';
?>