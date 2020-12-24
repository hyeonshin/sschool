<?php
require_once 'koneksi.php';
class Authentication extends Koneksi
{
	private $koneksi;
	
	function __construct()
	{
		$this->koneksi = new Koneksi();
		session_start();
	}

	public function login($username, $password)
	{
		$password = htmlentities($_POST['password']);

		try {
			$sql = "SELECT * FROM tbl_user WHERE username=:username";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(":username", $username);
			$query->execute();
			$data = $query->fetch();

			if (password_verify($password, $data['password'])) {
                if($data['level'] == "admin"){
                    $_SESSION['admin_session'] = $data['id_user'];
                    return "LOGIN AS ADMIN";
                }
                elseif ($data['level'] == "student") {
                    $_SESSION['std_session'] = $data['id_user'];
                    return "LOGIN AS STUDENT";
                }
			} else {
				return "WRONG";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function logged_admin()
	{
		if (isset($_SESSION['admin_session'])) {
			return TRUE;
		}
	}

	public function logged_std()
	{
		if (isset($_SESSION['std_session'])) {
			return TRUE;
		}
	}

	public function get_data_admin()
	{
		if (!$this->logged_admin()) {
			return FALSE;
		}

		try {
			$sql = "SELECT * FROM tbl_user WHERE id_user=:id_user";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(":id_user", $_SESSION['admin_session']);
			$query->execute();
			return $query->fetch();
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function get_data_std()
	{
		if (!$this->logged_std()) {
			return FALSE;
		}

		try {
			$sql = "SELECT * FROM tbl_user WHERE id_user=:id_user";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(":id_user", $_SESSION['std_session']);
			$query->execute();
			return $query->fetch();
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function logout_admin()
	{
		session_destroy();
		unset($_SESSION['admin_session']);
		return TRUE;
	}

	public function logout_std()
	{
		session_destroy();
		unset($_SESSION['std_session']);
		return TRUE;
	}
}
?>