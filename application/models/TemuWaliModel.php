<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TemuWaliModel extends CI_Model
{
	public function checkData($id)
	{
		$zone = $this->session->userdata('zone_temu_wali');
		$data = $this->db->get_where('temu_wali', ['id' => $id])->row_object();

		if (!$data) {
			return [
				'status' => false,
				'message' => 'Opppss...! Data tidak ditemukan'
			];
		}

		if ($zone != 'NON' AND $data->zone != $zone) {
			return [
				'status' => false,
				'message' => 'Opppss...! Zona tidak valid'
			];
		}

		$data = $this->getData($id);

		return [
			'status' => true,
			'message' => $id,
			'id' => $data->id,
			'name' => $data->nama_santri
		];
	}

	public function getData($id)
	{
		$this->db->select('a.id, b.induk_santri, b.id_santri, b.nama_santri, b.tempat_lahir_santri, b.tanggal_lahir_santri, b.dusun_santri, b.rt_santri, b.rw_santri, b.desa_santri,
		b.kecamatan_santri, b.kabupaten_santri, b.domisili_santri, b.nomor_kamar_santri, b.kelas_diniyah, b.tingkat_diniyah, b.kelas_formal, b.tingkat_formal,
		c.nama_walisantri, c.nomor_hp_walisantri, b.provinsi_santri, b.kode_pos_santri');
		$this->db->from('temu_wali as a')->join('data_santri as b', 'b.id_santri = a.id')->join('data_walisantri as c', 'c.nik_walisantri = a.wali');
		return $this->db->where('a.id', $id)->get()->row_object();
	}

	public function save()
	{
		$id = $this->input->post('id', true);
		$status = $this->input->post('status', true);

		$this->db->where('id', $id)->update('temu_wali', [
			'created_at' => date('Y-m-d H-i-s'), 'image' => $status
		]);

		if ($this->db->affected_rows() <= 0) {
			return [
				'status' => false,
				'message' => 'Gagal..! Coba reload halaman'
			];
		}

		return [
			'status' => true,
			'message' => 'Data berhasil disimpan'
		];
	}

	public function loadData()
	{
		$zone = $this->input->post('zone', true);
		$form = $this->input->post('form', true);

		$this->db->select('a.id, b.induk_santri, b.id_santri, b.nama_santri, b.tempat_lahir_santri, b.tanggal_lahir_santri, b.dusun_santri, b.rt_santri, b.rw_santri, b.desa_santri,
		b.kecamatan_santri, b.kabupaten_santri, b.domisili_santri, b.nomor_kamar_santri, b.kelas_diniyah, b.tingkat_diniyah, b.kelas_formal, b.tingkat_formal,
		c.nama_walisantri, c.nomor_hp_walisantri, b.provinsi_santri, b.kode_pos_santri, c.id_walisantri');
		$this->db->from('temu_wali as a')->join('data_santri as b', 'b.id_santri = a.id')->join('data_walisantri as c', 'c.nik_walisantri = a.wali');
		$this->db->where(['a.created_at !=' => null, 'a.image' => true]);

		if ($zone) {
			$this->db->where('a.zone', $zone);
		}

		if ($form != '') {
			$this->db->limit(15, $form);
		}

		return $this->db->order_by('a.created_at', 'ASC')->get()->result_object();
	}

	public function update()
	{
		$id = $this->input->post('id', true);
		$phone = $this->input->post('phone', true);
		$hp = str_replace([' ', '_'], '', $phone);

		$this->db->where('id_walisantri', $id)->update('data_walisantri', [
			'nomor_hp_walisantri' => $hp
		]);

		if ($this->db->affected_rows() <= 0) {
			return [
				'status' => false,
				'message' => 'Gagal..! Coba reload halaman'
			];
		}

		return [
			'status' => true,
			'message' => 'Data berhasil disimpan'
		];
	}

	public function getDataPrint($id)
	{
		$data = $this->db->get_where('data_walisantri', ['id_walisantri' => $id])->row_object();

		$result = '';
		$total = 0;
		$dataSantri = '';
		if ($data) {
			$result = $data;

			$query = $this->db->select('id_santri, nama_santri, tipe_santri')->from('data_santri')->where('wali_santri', $data->nik_walisantri)->get();
			$dataSantri = $query->result_object();
			$total = $query->num_rows();
		}

		return [
			$result,
			$dataSantri,
			$total
		];

	}
}
























