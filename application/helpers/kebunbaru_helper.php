<?php

function getURLAPI()
{
	return 'http://localhost/kebunbaruapi/';
}


function getKategri()
{
	$ci = get_instance();

	$ci->load->model('menuModel');
	$kategoriUser = $ci->session->userdata('kategori_user');

	return $ci->menuModel->GetKategoriPengguna($kategoriUser);
}


function getMenu()
{
	$ci = get_instance();

	$ci->load->model('menuModel');

	$jabatan = $ci->session->userdata('jabatan_user');

	return $ci->menuModel->getMenu($jabatan);
}


function CekLogin()
{
	$ci = get_instance();

	if (!$ci->session->userdata('id_user')) {
		redirect('login');
	}
}



function CekLoginAkses()
{
	$ci = get_instance();

	if (!$ci->session->userdata('id_user')) {
		redirect('login');
	} else {
		$ci->load->model('menuModel');

		$url      = $ci->uri->segment(1);
		$kategori = $ci->session->userdata('kategori_user');
		$jabatan  = $ci->session->userdata('jabatan_user');

		$datax = [
			'kategori_datamenu' => $kategori,
			'jabatan_datamenu' => $jabatan,
			'url_menu' => $url,
			'status_menu' => 1
		];

		$cek = $ci->menuModel->getMenuID($datax);

		if ($cek <= 0) {
			redirect('block');
		}
	}
}


function tanggalIndo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}


function tanggalIndoShort($tanggal)
{
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agu',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}



function TampilHijri($tanggal)
{

	$bulan = array(
		1 =>   'Muharram',
		'Shafar',
		'Rabi\'ul Awal',
		'Rabi\'ul Tsani',
		'Jumadal Ula',
		'Jumadal Tsaniyah',
		'Rajab',
		'Sya\'ban',
		'Ramadhan',
		'Syawal',
		'Dzul Qo\'dah',
		'Dzul Hijjah'
	);

	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}


function getNamaKategori($id)
{
	$nama = [
		1 => 'Administrator',
		'Pengasuh',
		'Yayasan',
		'Komisi Umum',
		'Komisi I',
		'Komisi II',
		'Komisi III',
		'Komisi IV',
		'Komisi V',
		'Komisi VI',
		'IASBA'
	];

	return $nama[$id];
}

function selisihWaktu($kembali)
{
	$ci = get_instance();
	$ci->load->model('kamtibModel', 'km');

	$waktu = $ci->km->gettanggal();
	$awal = date_create($waktu);
	$akhir = date_create($kembali); // waktu sekarang
	$diff  = date_diff($awal, $akhir);

	$tahun = $diff->y;
	$bulan = $diff->m;
	$hari = $diff->d;
	$jam = $diff->h;
	$menit = $diff->i;
	$detik = $diff->s;

	if ($tahun != 0) {
		$t = $tahun . ' tahun';
	} else {
		$t = '';
	}

	if ($bulan != 0) {
		$b = $bulan . ' bulan';
	} else {
		$b = '';
	}

	if ($hari != 0) {
		$h = $hari . ' hari';
	} else {
		$h = '';
	}

	if ($jam != 0) {
		$j = $jam . ' jam';
	} else {
		$j = '';
	}

	if ($menit != 0) {
		$m = $menit . ' menit';
	} else {
		$m = '';
	}

	if ($detik != 0) {
		$d = $detik . ' detik';
	} else {
		$d = '';
	}

	return $t . ' ' . $b . ' ' . $h . ' ' . $j . ' ' . $m . ' ' . $d;
}

function setselisih()
{
	$ci = get_instance();
	$ci->load->model('kamtibModel', 'km');

	$waktu = $ci->km->gettanggal();
	$kembali = date("Y-m-d H:i:s");
	$selisih = strtotime($waktu) - strtotime($kembali);

	if ($selisih >= 1) {
		$hasil = 3;
	} else {
		$hasil = 2;
	}

	return $hasil;
}

function selisihWaktuprint($tanggal, $kembali)
{
	$awal = date_create($tanggal);
	$akhir = date_create($kembali); // waktu sekarang
	$diff  = date_diff($awal, $akhir);

	$tahun = $diff->y;
	$bulan = $diff->m;
	$hari = $diff->d;
	$jam = $diff->h;
	$menit = $diff->i;
	$detik = $diff->s;

	if ($tahun != 0) {
		$t = $tahun . ' tahun';
	} else {
		$t = '';
	}

	if ($bulan != 0) {
		$b = $bulan . ' bulan';
	} else {
		$b = '';
	}

	if ($hari != 0) {
		$h = $hari . ' hari';
	} else {
		$h = '';
	}

	if ($jam != 0) {
		$j = $jam . ' jam';
	} else {
		$j = '';
	}

	if ($menit != 0) {
		$m = $menit . ' menit';
	} else {
		$m = '';
	}

	if ($detik != 0) {
		$d = $detik . ' detik';
	} else {
		$d = '';
	}

	return $t . ' ' . $b . ' ' . $h . ' ' . $j . ' ' . $m . ' ' . $d;
}

function in_array_r($needle, $haystack, $strict = false)
{
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
			return true;
		}
	}

	return false;
}

function penyebut($nilai)
{
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " " . $huruf[$nilai];
	} else if ($nilai < 20) {
		$temp = penyebut($nilai - 10) . " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
	}
	return $temp;
}

function terbilang($nilai)
{
	if ($nilai < 0) {
		$hasil = "minus " . trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}
	return $hasil;
}

function datetimeIDShirtFormat($tanggal)
{
	$tgl = date('Y-m-d', strtotime($tanggal));
	$jam = date('H:i:s', strtotime($tanggal));
	$pecahkan = explode('-', $tgl);
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agu',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . ' ' . $jam;
}

function ageCounter($birth)
{
	$birthDate = new DateTime($birth);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("Tanggal lahir tidak valid");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	if ($y > 0) {
		$y = $y . ' tahun';
	} else {
		$y = '';
	}

	return $y;
}

function diffDayCounter($from, $finish)
{
	$tgl1 = strtotime($from);
	$tgl2 = strtotime($finish);

	$jarak = $tgl2 - $tgl1;

	$hari = $jarak / 60 / 60 / 24;
	return round($hari);
}

function dateDisplayWithDay($date, $hijri)
{
	$tgl = date('Y-m-d', strtotime($date));
	$jam = date('H:i', strtotime($date));

	$days = [
		1 =>    'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		'Jum\'at',
		'Sabtu',
		'Minggu'
	];

	$months = [
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	];
	$explodeDate = explode('-', $tgl);
	$dayNum = date('N', strtotime($date));

	return 'Hari <b>' . $days[$dayNum] . '</b> tanggal <b>' . $explodeDate[2] . ' ' . $months[(int)$explodeDate[1]] . ' ' . $explodeDate[0] . '</b> | <b>' . $hijri . '</b> pukul <b>' . $jam . ' WIB</b>';
}

function setselisihkembali($tanggal, $kembali)
{
	$selisih = strtotime($tanggal) - strtotime($kembali);

	if ($selisih >= 1) {
		//DISIPLIN
		$hasil = 2;
	} else {
		//TERLAMBAT
		$hasil = 3;
	}

	return $hasil;
}

function selisihWaktuprintkembali($tanggal, $kembali)
{
	$awal = date_create($tanggal);
	$akhir = date_create($kembali); // waktu sekarang
	$diff  = date_diff($awal, $akhir);

	$tahun = $diff->y;
	$bulan = $diff->m;
	$hari = $diff->d;
	$jam = $diff->h;
	$menit = $diff->i;
	$detik = $diff->s;

	if ($tahun != 0) {
		$t = $tahun . ' tahun';
	} else {
		$t = '';
	}

	if ($bulan != 0) {
		$b = $bulan . ' bulan';
	} else {
		$b = '';
	}

	if ($hari != 0) {
		$h = $hari . ' hari';
	} else {
		$h = '';
	}

	if ($jam != 0) {
		$j = $jam . ' jam';
	} else {
		$j = '';
	}

	if ($menit != 0) {
		$m = $menit . ' menit';
	} else {
		$m = '';
	}

	if ($detik != 0) {
		$d = $detik . ' detik';
	} else {
		$d = '';
	}

	return $t . ' ' . $b . ' ' . $h . ' ' . $j . ' ' . $m;
}
