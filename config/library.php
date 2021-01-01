<?php
require_once 'koneksi.php';
class Library extends Koneksi
{
	private $koneksi;

	function __construct()
	{
		$this->koneksi = new Koneksi();
    }

    //code registrasi student
    public function register_std($username, $password, $nama_user,$email , $level, $id_materi)
	{
		try {
			$sql = "INSERT INTO `tbl_user`( `username`, `password`, `nama_user`,`email`, `level`, `id_materi`) VALUES (?,?,?,?,?,?)";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $username);
			$query->bindParam(2, $password);
			$query->bindParam(3, $nama_user);
			$query->bindParam(4, $email);
            $query->bindParam(5, $level);
			$query->bindParam(6, $id_materi);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			if ($e->errorInfo[0] == 23000) {
				return "UNIQUE";
			} else {
				echo $e->getMessage();
				return FALSE;
			}
		}
	}

	//code buat soal
	public function add_soal($gambar, $soal, $pil_a, $pil_b, $pil_c, $pil_d, $kj, $id_tutorial)
	{
		$date = NULL;
		$aktif = "YES";

		try {
			$sql = "INSERT INTO `tbl_soal`(`gambar`, `soal`, `pil_a`,`pil_b`, `pil_c`, `pil_d`, `kj`, `date`, `aktif`, `id_tutorial`) VALUES (?,?,?,?,?,?,?,?,?,?)";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $gambar);
			$query->bindParam(2, $soal);
			$query->bindParam(3, $pil_a);
			$query->bindParam(4, $pil_b);
            $query->bindParam(5, $pil_c);
			$query->bindParam(6, $pil_d);
			$query->bindParam(7, $kj);
			$query->bindParam(8, $date);
			$query->bindParam(9, $aktif);
			$query->bindParam(10, $id_tutorial);
			
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
			
		}
	}

	//ini tentang soal-soal

	public function view_soal($id_tutorial)
	{
		try {
			$sql = "SELECT * FROM tbl_soal WHERE aktif='YES' AND id_tutorial='$id_tutorial' ORDER BY RAND ()";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function count_soal($id_tutorial)
	{
		try {
			$sql = "SELECT COUNT(*) AS jumlah FROM tbl_soal WHERE aktif='YES' AND id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->query($sql);
			$jum = $query->fetch(PDO::FETCH_ASSOC);
			$jumlah = $jum['jumlah'];
			return $jumlah;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	public function cek_jawaban($nomor,$jawaban)
	{
		try {
			$sql = "SELECT * FROM tbl_soal WHERE id_soal='$nomor' AND kj='$jawaban'";
			$query = $this->koneksi->db->query($sql);
			$cek = $query->fetch(PDO::FETCH_OBJ);
			if($cek){
			$hasil = $cek->kj;
			}
			else {
				$hasil = FALSE;
			}
			return $hasil;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	//code buat soal
	public function input_nilai($id_nilai, $nilai, $id_user, $id_tutorial, $status)
	{
		$id_nilai ="";
		if($nilai >= 70)
		{
			$status = "PASS";
		}
		else {
			$status = "FAILED";
		}

		try {
			$sql = "INSERT INTO `tbl_nilai`(`id_nilai`, `nilai`, `id_user`, `id_tutorial`,`status`) VALUES (?,?,?,?,?)";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $id_nilai);
			$query->bindParam(2, $nilai);
			$query->bindParam(3, $id_user);
			$query->bindParam(4, $id_tutorial);
			$query->bindParam(5, $status);
			
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
			
		}
	}
	public function select_soal($id_tutorial)
	{
		try {
			$sql = "SELECT * FROM `tbl_soal` WHERE id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	//tentang nilai
	public function select_nilai($id_user)
	{
		try {
			$sql = "SELECT * FROM `tbl_nilai`JOIN tbl_tutorial ON tbl_nilai.id_tutorial=tbl_tutorial.id_tutorial WHERE id_user = '$id_user'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	//tentang tutorial
	public function select_tutorial($id_tutorial)
	{
		try {
			$sql = "SELECT * FROM `tbl_tutorial` WHERE id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function view_tutorial()
	{
		try {
			$sql = "SELECT * FROM tbl_tutorial";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	// tentang materi
	public function view_materi()
	{
		try {
			$sql = "SELECT * FROM tbl_materi";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function select_materi($id_materi)
	{
		try {
			$sql = "SELECT * FROM `tbl_materi` WHERE id_materi='$id_materi'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	// ---- LIBRARY ADMIN ------------------------------------------------------------------------------------------------------

	//tentang student
	public function view_student()
	{
		try {
			$sql = "SELECT * FROM tbl_user WHERE level='student'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function view_tutorial_id($id_materi)
	{
		try {
			$sql = "SELECT * FROM tbl_tutorial WHERE id_materi='$id_materi'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	public function view_soal_id($id_tutorial)
	{
		try {
			$sql = "SELECT * FROM tbl_soal WHERE id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function view_student_id($id_user)
	{
		try {
			$sql = "SELECT * FROM tbl_user WHERE id_user='$id_user'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function select_soal_id($id_soal)
	{
		try {
			$sql = "SELECT * FROM tbl_soal WHERE id_soal='$id_soal'";
			$query = $this->koneksi->db->query($sql);
			return $query;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	// edit sesuatuu --------------------------------------------------------------------
	public function edit_user($id_user, $username, $nama_user, $email, $id_materi)
	{
		
		try {
			$sql = "UPDATE `tbl_user` SET `username`=?,`nama_user`=?,`email`=?,`id_materi`=? WHERE id_user='$id_user'";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $username);
			$query->bindParam(2, $nama_user);
			$query->bindParam(3, $email);
			$query->bindParam(4, $id_materi);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function edit_materi($id_materi, $nama_materi, $ket)
	{
		
		try {
			$sql = "UPDATE `tbl_materi` SET `nama_materi`=?,`ket`=? WHERE id_materi='$id_materi'";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $nama_materi);
			$query->bindParam(2, $ket);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function add_materi($nama_materi, $ket)
	{
		
		try {
			$sql = "INSERT INTO `tbl_materi`(`nama_materi`, `ket`) VALUES (?,?)";
			$query = $this->koneksi->db->prepare($sql);			
			$query->bindParam(1, $nama_materi);
			$query->bindParam(2, $ket);
			
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function edit_tutorial($id_tutorial,$nama_tutorial, $ket, $id_materi, $link)
	{
		
		try {
			$sql = "UPDATE `tbl_tutorial` SET `nama_tutorial`=?,`ket`=?,`id_materi`=?,`link`=? WHERE id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $nama_tutorial);
			$query->bindParam(2, $ket);
			$query->bindParam(3, $id_materi);
			$query->bindParam(4, $link);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function add_tutorial($nama_tutorial, $ket, $id_materi, $link)
	{
		
		try {
			$sql = "INSERT INTO `tbl_tutorial`(`nama_tutorial`, `ket`, `id_materi`, `link`) VALUES (?,?,?,?)";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $nama_tutorial);
			$query->bindParam(2, $ket);
			$query->bindParam(3, $id_materi);
			$query->bindParam(4, $link);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function edit_soal($id_soal, $gambar, $soal, $pil_a, $pil_b, $pil_c, $pil_d, $kj, $id_tutorial)
	{
		
		try {
			$sql = "UPDATE `tbl_soal` SET `gambar`=?,`soal`=?,`pil_a`=?,`pil_b`=?,`pil_c`=?,`pil_d`=?,`kj`=?,`id_tutorial`=? WHERE id_soal='$id_soal'";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $gambar);
			$query->bindParam(2, $soal);
			$query->bindParam(3, $pil_a);
			$query->bindParam(4, $pil_b);
			$query->bindParam(5, $pil_c);
			$query->bindParam(6, $pil_d);
			$query->bindParam(7, $kj);
			$query->bindParam(8, $id_tutorial);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	

	// on off sesuatuuu -------------------
	public function off_tutorial($id_tutorial)
	{
		
		try {
			$date = date("Y-m-d H:i:s");
			$sql = "UPDATE `tbl_tutorial` SET `status_del`=? WHERE id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->prepare($sql);
			$query->bindParam(1, $date);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function on_tutorial($id_tutorial)
	{
		
		try {
			$sql = "UPDATE `tbl_tutorial` SET `status_del`=NULL WHERE id_tutorial='$id_tutorial'";
			$query = $this->koneksi->db->prepare($sql);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function off_soal($id_soal)
	{
		
		try {
			$sql = "UPDATE `tbl_soal` SET `aktif`='NO' WHERE id_soal='$id_soal'";
			$query = $this->koneksi->db->prepare($sql);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	public function on_soal($id_soal)
	{
		
		try {
			$sql = "UPDATE `tbl_soal` SET `aktif`='YES' WHERE id_soal='$id_soal'";
			$query = $this->koneksi->db->prepare($sql);
			$query->execute();
			if ($query) {
				return "SUCCESS";
			} else {
				return "FAILED";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
}