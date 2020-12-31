<?php
require_once '../config/library.php';
require_once '../config/authentication.php';

$lib = new Library();
$auth = new Authentication();

if (isset($_POST['daftar'])) {
	$username = htmlentities($_POST['username']);
	$password = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);
 	$nama_user = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
	$level = "student";
	$id_materi = 1;
	
	$simpan = $lib->register_std($username, $password, $nama_user,$email, $level, $id_materi);
	if ($simpan == "SUCCESS") {
		echo "
		<script>
		alert('Data berhasil di simpan!');
		window.location.href='.';
		</script>
        ";
        echo "<script>window.location.href = 'register.php';</script>";
	} elseif ($simpan == "UNIQUE") {
		echo "
		<script>
		alert('Username sudah digunakan!');
		</script>
        ";
        echo "<script>window.location.href = 'register.php';</script>";
	} else {
		echo "
		<script>
		alert('Data gagal di simpan!');
		</script>
        ";
        echo "<script>window.location.href = 'register.php';</script>";
	}
}
?>