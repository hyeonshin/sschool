<?php
require_once '../config/library.php';
require_once '../config/authentication.php';

$lib = new Library();
$auth = new Authentication();

if (isset($_POST['daftar'])) {
	$id_user = "";
	$username = "";
	$password = "";
    $nama_user = "";
    $email = "";
	$level = "";
	$id_materi = "";
	$simpan = $lib->register_std($id_user, $username, $password, $nama_user,$email, $level, $id_materi);
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