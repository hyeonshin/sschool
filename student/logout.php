<?php
require_once '../config/authentication.php';
$auth = new Authentication();
$auth->logout_std();
header("Location: ../login/login.php");
?>