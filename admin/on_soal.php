<?php
require_once '../config/library.php';
require_once '../config/authentication.php';

$lib = new Library();
$auth = new Authentication();

if (!$auth->logged_admin()) {
    header("Location: ../login/login.php");
}

$get_data = $auth->get_data_admin();


if (isset($_GET['id'])) {
	$id = base64_decode($_GET['id']);
    $edit = $lib->on_soal($id);
    if ($edit == "SUCCESS") {
		echo "
		<script>
		alert('Data berhasil di edit!');
		window.location.href='./materi.php';
		</script>
		";
	} else {
		echo "
		<script>
		alert('Data gagal di edit!');
		</script>
		";
	}
}
?>