<?php 
include 'aksilogin/config.php';

 session_start();
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM tbl_user where username='$username' and password='$password'");



// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:home_admin.php");
 
	// cek jika user login sebagai pegawai
	
	}else if($data['level']=="konsumen"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "konsumen";
		// alihkan ke halaman dashboard pegawai
		header("location:home_konsumen.php");	
	}

}else{
	header("location:index.php?pesan=gagal");
}
 
?>