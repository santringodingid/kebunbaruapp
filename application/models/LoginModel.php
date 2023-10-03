<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
	public function CekUser($username)
	{
		 return $this->db->get_where('data_pengguna', ['username' => $username])->row_object();
	}


	public function getDataLengkap($kategori, $jabatan, $user)
	{
		 $query = "SELECT a.`nama_pengguna`, b.`nama_kategori`, c.`nama_jabatan`
		 FROM data_pengguna a, data_kategori b, data_jabatan c
		 WHERE a.`kategori_pengguna` = b.`id_kategori` AND a.`jabatan_pengguna` = c.`id_jabatan`
		 AND b.`id_kategori` = $kategori AND c.`id_jabatan` = $jabatan AND a.`username` = '$user'";

		 return $this->db->query($query)->row_object();
	}


	public function TambahAdmin()
	{
		$data = [
			'id_pengguna' => '',
			'kode_pengguna' => 'AD01',
			'nama_pengguna' => 'ADMINISTRATOR',
			'nama_ranting' => 'Administrator',
			'user_name' => 'admin',
			'kata_sandi' => password_hash('123456', PASSWORD_DEFAULT),
			'status_pengguna' => 1,
			'otoritas_pengguna' => 1,
			'gambar_pengguna' => 'default.jpg'
		];
		$this->db->insert('pengguna', $data);
	}
}
