<?php
	// Membuat variabel
	$nama="";
	$username="";
	$pass = "";
	$pass_komfrim = "";
	$namaErr = "";
	$usernameErr = "";
	$passErr = "";
	$username_valid = true;
	$username_valid_msg = "";
	$name_valid = true;
	$name_valid_msg = "";
	$valid_panjang_pass = true;
	$valid_pass_konfirm = true;
	$valid_panjang_pass_msg = "";
	$valid_pass_konfirm_msg = "";
	
	// Cek form sudah di klik submit/belum
	if(isset($_POST['submit'])){
		$nama = trim($_POST['nama']);
		$username = trim($_POST['username']);
		$pass = trim($_POST['pass']);
		$pass_komfrim = trim($_POST['passKonfrim']);
		
		// Cek input kosong
		if(empty($nama)){
			$namaErr = "Nama masih kosong.<br>";
		}
		if(empty($username)){
			$usernameErr = "Username masih kosong.<br>";
		}
		if(empty($pass)){
			$passErr = "Password masih kosong.<br>";
		}
		
		// Kode cek username hanya boleh huruf a-z dan A-Z
		if(!preg_match("/^[a-zA-Z]*$/",$username)){
			$username_valid = false;
			$username_valid_msg = "Hanya huruf yang diijinkan, dan tidak boleh menggunakan spasi.<br>";
		}
		
		// Kode validasi nama hanya boleh huruf a-z, A-Z, dan spasi
		if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
			$name_valid = false;
			$name_valid_msg = "Hanya huruf dan spasi yang diijinkan.<br>";
		}
		
		// Cek minimal karakter password (minimal 8 digit)
		if(strlen($pass) <= 8){
			$valid_panjang_pass = false;
			$valid_panjang_pass_msg = "Password minimal 8 digit.<br>";
		}
		
		// cek konfirmasi password sama atau tidak
		if($pass != $pass_komfrim){
			$valid_pass_konfirm = false;
			$valid_pass_konfirm_msg = "Password konfirmasi tidak sama.<br>";
		}
		
		// Cek semua input sudah diisi apa belum
		if( !empty($nama) and !empty($username) and !empty($pass) and $username_valid and $name_valid and $valid_panjang_pass and $valid_pass_konfirm){
			// Disini tempat menulis kode (semua syarat sudah input terpenuhi).
			// Misalnya menulis kode query ke database
			echo "Selamat semua input sudah diisi dengan benar.<br>";
		}
		
	}
?>

<h3>From Register</h3>

<form action="validasi-password.php" method="post">
	Nama : <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
		<?php echo $namaErr.$name_valid_msg; ?>
	Username : <input type="text" name="username" value="<?php echo $username; ?>"><br>
		<?php echo $usernameErr.$username_valid_msg; ?>
	Password : <input type="password" name="pass" value="<?php echo $pass; ?>"><br>
		<?php echo $passErr.$valid_panjang_pass_msg; ?>
	Konfirm Pass : <input type="password" name="passKonfrim" value="<?php echo $pass_komfrim; ?>"><br>
		<?php echo $valid_pass_konfirm_msg; ?>
	<input type="submit" name="submit" value="Register">
</form>
