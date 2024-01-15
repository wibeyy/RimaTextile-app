<?php 
include 'aksilogin/config.php';


// mengaktifkan session
  session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php
    if (isset($page_title)) {
        echo $page_title;
    } else {
        echo 'RIMA TEXTILE';
    }
    ?>
  </title>
  
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts dan icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet"   href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


 
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

    <div style="margin_left: 20px">

          <div style="font-size: 21px">Laporan Data Pemilihan Produk Terbaik │ Tahun 2023 </div>
          <div style="font-size: 25px">RIMA TEXTILE </div>
          <div style="font-size: 18px"> </div>
  </div>
				

<hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">

<div style="font-size: 12px; margin-left: 5px;"></div>


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
 $tgl=date('d-m-Y');
 echo "<H3>Tanggal : $tgl</H3>";
 echo "<H3>Matrik Awal </H3>
 <table class='table table-bordered table-striped' >
 <thead>
  <tr>
   <td style='text-align:center;'>No</td>
   <td>Nama</td>";

   while ($qk = mysqli_fetch_array($qkriteria)) {
     echo "<td style='text-align:center;'>".$qk['nama_kriteria']."</td>";
   }
   // <td style='text-align:center;'>C1</td>
   // <td style='text-align:center;'>C2</td>
   // <td style='text-align:center;'>C3</td>
   // <td style='text-align:center;'>C4</td>
   echo "<td style='text-align:center;'>jumlah poin</td>
  </tr>
  </thead>
  <tbody>
  ";
 $no = 1;
 while ($dt = mysqli_fetch_array($sql)) {
  $jumlah= ($dt['kriteria1'])+($dt['kriteria2'])+($dt['kriteria3'])+($dt['kriteria4'])+($dt['kriteria5'])+($dt['kriteria6'])+($dt['kriteria7'])+($dt['kriteria8'])+($dt['kriteria9']);
  echo "<tr>
   <td style='text-align:center;'>$no</td>
   <td>".getNama($dt['id_alternatif'])."</td>
   <td style='text-align:center;'>$dt[kriteria1]</td>
   <td style='text-align:center;'>$dt[kriteria2]</td>
   <td style='text-align:center;'>$dt[kriteria3]</td>
   <td style='text-align:center;'>$dt[kriteria4]</td>
   <td style='text-align:center;'>$dt[kriteria5]</td>
   <td style='text-align:center;'>$dt[kriteria6]</td>
   <td style='text-align:center;'>$dt[kriteria7]</td>
   <td style='text-align:center;'>$dt[kriteria8]</td>
   <td style='text-align:center;'>$dt[kriteria9]</td>
 
   
   <td style='text-align:center;'>$jumlah</td>
  </tr>";
 $no++;
 }
 echo "</tbody></table>";

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
 echo "<br><H3>Matrik Normalisasi</H3>
 <table class='table table-bordered' >
 <thead>
  <tr>
   <td style='text-align:center;'>No</td>
   <td>Nama</td>";

   while ($k = mysqli_fetch_array($qkriteria)) {
     echo "<td style='text-align:center;'>".$k['nama_kriteria']."</td>";
    // var_dump($k['nama_kriteria']);
   }
   // <td style='text-align:center;'>C1</td>
   // <td style='text-align:center;'>C2</td>
   // <td style='text-align:center;'>C3</td>
   // <td style='text-align:center;'>C4</td>
  echo "</tr>
  </thead>
  <tbody>
  ";

$k1 = "";
$k2 = "";
$k3 = "";
$k4 = "";
$k5 = "";
$k6 = "";
$k7 = "";
$k8 = "";
$k9 = "";


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

 $no = 1;
 while ($dt2 = mysqli_fetch_array($sql2)) {
  echo "<tr>
   <td style='text-align:center;'>$no</td>
   <td>".getNama($dt2['id_alternatif'])."</td>
   <td style='text-align:center;'>";
        if ($k1 == "benefit") {
          echo round($dt2['kriteria1']/$atribut['maxK1'],2);
        } else {
          echo round($atribut['minK1']/$dt2['kriteria1'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k2 == "benefit") {
          echo round($dt2['kriteria2']/$atribut['maxK2'],2);
        } else {
          echo round($atribut['minK2']/$dt2['kriteria2'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k3 == "benefit") {
          echo round($dt2['kriteria3']/$atribut['maxK3'],2);
        } else {
          echo round($atribut['minK3']/$dt2['kriteria3'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k4 == "benefit") {
          echo round($dt2['kriteria4']/$atribut['maxK4'],2);
        } else {
          echo round($atribut['minK4']/$dt2['kriteria4'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k5 == "benefit") {
          echo round($dt2['kriteria5']/$atribut['maxK5'],2);
        } else {
          echo round($atribut['minK5']/$dt2['kriteria5'],2);
        }
   echo "</td>
    <td style='text-align:center;'>";
        if ($k6 == "benefit") {
          echo round($dt2['kriteria6']/$atribut['maxK6'],2);
        } else {
          echo round($atribut['minK6']/$dt2['kriteria6'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k7 == "benefit") {
          echo round($dt2['kriteria7']/$atribut['maxK7'],2);
        } else {
          echo round($atribut['minK7']/$dt2['kriteria7'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k8 == "benefit") {
          echo round($dt2['kriteria8']/$atribut['maxK8'],2);
        } else {
          echo round($atribut['minK8']/$dt2['kriteria8'],2);
        }
   echo "</td>
   <td style='text-align:center;'>";
        if ($k9 == "benefit") {
          echo round($dt2['kriteria9']/$atribut['maxK9'],2);
        } else {
          echo round($atribut['minK9']/$dt2['kriteria9'],2);
        }
   echo "</td>
   
  </tr>";
 $no++;
 }
 echo "</tbody></table>";


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
   $h="Peringkat";
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
              </div>
            </div>
          </div>
        </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
  </table><br>
  <div class="kolom">
    <p class="tmp"> Padang, ..... </p>
    <div class="ttd">
      <div class="kiri" style: text-align: right;> 
        <p><u><b> Muhammad Ridha </b></u></p>
        <p>Owner Rima Textile</p>
        
  </div>
    <div class="kanan" >
      <p><u><b> Frandika Maydi </b></u></p>
      <p>Manager Rima Textile</p>
  </div>
  </div>
  </div>     
      

<script>
    window.print();
  </script>








<?php
include './template/footer.php';
?>
