<?php //filename: proses_login.php
session_start();

// Ambil data dari form :
$username = $_POST['username'];
$pass = $_POST['password'];

// buat koneksi
$koneksi = mysqli_connect("localhost", "root", "","web_video");

//query data yang usernamenya sama
$query = "SELECT * FROM users WHERE username = '$_POST[username]'";
if(mysqli_connect_errno()){
	die("Database connection failed: " .
	mysqli_connect_error() .
	" (". mysqli_connect_errno() . ")"
);
}

$hasil = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($hasil);

// Periksa apakah querynya ada
 if($row && password_verify($pass, $row['password'])){
	 $_SESSION['login'] = 1;
	header('location:adminMenu.php');
	 // Kalau ada, maka cek passwordnya
	//echo "ADA GAN";


}

else{
	echo "DITOLAK YEE KASIHAN JOMBLO!";
	//Jika tidak ada, maka username ditolak
	
}
?>