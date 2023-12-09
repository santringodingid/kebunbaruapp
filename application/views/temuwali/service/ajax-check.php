<?php
$user = $this->session->userdata('tipe_user');
$fotoc = FCPATH . 'assets/images/apps/fotosantri/';
$foto = base_url('assets/images/apps/fotosantri/');
$image = $user . '/' . $hasil->id_santri . '.jpg';

if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
	$fotoj = $foto . $user . '.jpg';
} else {
	$fotoj = $foto . $image;
}
?>
<div class="card card-success card-outline">
	<div class="card-header">
		<h4 class="card-title">Data Santri</h4>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<img src="<?= $fotoj ?>" alt="Foto santri" style="width: 100%;">
			</div>
			<div class="col-8">
				<table style="width: 100%;">
					<thead>
					<tr>
						<th style="width: 30%;">ID P2K</th>
						<th style="width: 5%;">:</th>
						<th style="width: 65%;"><?= $hasil->id_santri ?></th>
					</tr>
					<tr>
						<td>Nomor Induk</td>
						<td>:</td>
						<td><?= $hasil->induk_santri ?></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><b><?= $hasil->nama_santri ?></b></td>
					</tr>
					<tr>
						<td>Domisili</td>
						<td>:</td>
						<td>P2K, <?= $hasil->domisili_santri ?> - <?= $hasil->nomor_kamar_santri ?></td>
					</tr>
					<tr>
						<td>Pendidikan Diniyah</td>
						<td>:</td>
						<td><?= $hasil->kelas_diniyah ?> - <?= $hasil->tingkat_diniyah ?></td>
					</tr>
					<tr>
						<td>Pendidikan Formal</td>
						<td>:</td>
						<td><?= $hasil->kelas_formal ?> - <?= $hasil->tingkat_formal ?></td>
					</tr>
					<tr>
						<td rowspan="4" class="align-top">Alamat</td>
						<td>:</td>
						<td><?= $hasil->dusun_santri . ', RT ' . $hasil->rt_santri . '/RW ' . $hasil->rw_santri ?></td>
					</tr>
					<tr>
						<td></td>
						<td><?= $hasil->desa_santri ?></td>
					</tr>
					<tr>
						<td></td>
						<td><?= $hasil->kecamatan_santri . ' ' . $hasil->kabupaten_santri ?></td>
					</tr>
					<tr>
						<td></td>
						<td><?= $hasil->provinsi_santri . ', ' . $hasil->kode_pos_santri ?></td>
					</tr>
					<tr>
						<td>Wali</td>
						<td>:</td>
						<td><b><?= $hasil->nama_walisantri ?></b></td>
					</tr>
					<tr>
						<td>No. HP</td>
						<td>:</td>
						<td><?= $hasil->nomor_hp_walisantri ?></td>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="row justify-content-between">
			<div class="col-6">
				<button class="btn btn-success btn-block" onclick="save(<?= $hasil->id ?>, 1)">Simpan dan Pemotretan</button>
			</div>
			<div class="col-6">
				<button class="btn btn-danger btn-block" onclick="save(<?= $hasil->id ?>, 0)">Simpan Tanpa Pemotretan</button>
			</div>
		</div>

	</div>
</div>
