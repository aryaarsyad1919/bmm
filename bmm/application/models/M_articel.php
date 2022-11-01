<?php
class M_articel extends CI_Model{

	function get_all_falilitas(){
		$hsl=$this->db->query('SELECT * FROM artikel ORDER BY kd_artikel DESC');
		return $hsl;
	}

	function simpan_artikel($nama,$deskripsi,$gambar){
		$hsl=$this->db->query("INSERT INTO artikel (nama,gambar,detail) VALUES ('$nama','$gambar','$deskripsi')");
		return $hsl;
	}

	function get_artikel_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM artikel WHERE kd_artikel='$kode'");
		return $hsl;
	}

	function update_artikel($kode,$nama,$deskripsi,$gambar){
		$hsl=$this->db->query("UPDATE artikel SET nama='$nama',gambar='$gambar',detail='$deskripsi' WHERE kd_artikel='$kode'");
		return $hsl;
	}

	function update_artikel_no_img($kode,$nama,$deskripsi){
		$hsl=$this->db->query("UPDATE artikel SET nama='$nama',detail='$deskripsi' WHERE kd_artikel='$kode'");
		return $hsl;
	}

	function hapus_artikel($kode){
		$hsl=$this->db->query("DELETE FROM artikel WHERE kd_artikel='$kode'");
		return $hsl;
	}


	//FRONTEND
	function get_all_articel_home(){
		$hsl=$this->db->query("SELECT * FROM artikel ORDER BY kd_artikel DESC LIMIT 4");
		// $query = "SELECT * FROM nama_table ORDER BY nama_kolom DESC";
		return $hsl;
	}
}