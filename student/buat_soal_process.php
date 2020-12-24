<?php
require_once '../config/library.php';
require_once '../config/authentication.php';

$lib = new Library();
$auth = new Authentication();

if (isset($_POST['input_soal'])) {
	$id_soal = "";
	$gambar = ""; 
	$soal = ""; 
	$pil_a = ""; 
	$pil_b = ""; 
	$pil_c = "";
	$pil_d = ""; 
	$kj = ""; 
	$date = ""; 
	$aktif = ""; 
	$id_tutorial = "";
	$simpan = $lib->buat_soal($id_soal, $gambar, $soal, $pil_a, $pil_b, $pil_c, $pil_d, $kj, $date, $aktif, $id_tutorial);
	
	if ($simpan == "SUCCESS") {
		echo "
		<script>
		alert('Soal berhasil dibuat!');
		window.location.href='.';
		</script>
        ";
        echo "<script>window.location.href = 'index.php';</script>";
	} else {
		echo "
		<script>
		alert('Soal gagal dibuat!');
		</script>
        ";
        echo "<script>window.location.href = 'buat_soal.php';</script>";
	}
}
?>