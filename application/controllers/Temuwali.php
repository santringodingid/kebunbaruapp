<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Temuwali extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('TemuWaliModel', 'twm');

		CekLoginAkses();
	}

	public function index()
	{
		$data = [
			'title' => 'Temu Wali Santri'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('temuwali/temuwali');
		$this->load->view('layout/footer');
		$this->load->view('temuwali/js-temuwali');
	}

	public function service()
	{
		$data = [
			'title' => 'Temu Wali Santri'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('temuwali/service/service');
		$this->load->view('layout/footer');
		$this->load->view('temuwali/service/js-service');
	}

	public function setService($zone)
	{
		$session = $this->session->userdata('zone_temu_wali');

		if ($session) {
			$this->session->unset_userdata('zone_temu_wali');
		}

		$this->session->set_userdata(['zone_temu_wali' => $zone]);

		redirect('temuwali/service');
	}

	public function checkData()
	{
		$id = $this->input->post('id', true);
		$result = $this->twm->checkData($id);

		echo json_encode($result);
	}

	public function getData()
	{
		$id = $this->input->post('id', true);
		$hasil = $this->twm->getData($id);
		$data = [
			'hasil' => $hasil
		];

		$this->load->view('temuwali/service/ajax-check', $data);
	}

	public function listKtws()
	{
		$zone = $this->input->post('zone', true);
		$form = $this->input->post('form', true);

		$arrayData = [
			0 => 'A',
			15 => 'B',
			30 => 'C',
			45 => 'D',
			60 => 'E',
			75 => 'F',
			90 => 'G',
			105 => 'H',
			130 => 'I'
		];

		$hasil = $this->twm->loadData();
		$data = [
			'title' => 'Print',
			'data' => $hasil,
			'form' => $zone,
			'abjad' => $arrayData[$form]
		];

		$this->load->view('print/list-ktws', $data);
	}

	public function save()
	{
		$result = $this->twm->save();

		echo json_encode($result);
	}

	public function store()
	{
		$data = [
			'title' => 'Cetak KTWS'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('temuwali/store/store');
		$this->load->view('layout/footer');
		$this->load->view('temuwali/store/js-store');
	}

	public function loadData()
	{
		$hasil = $this->twm->loadData();
		$data = [
			'datasantri' => $hasil
		];

		$this->load->view('temuwali/store/ajax-store', $data);
	}

	public function update()
	{
		$result = $this->twm->update();

		echo json_encode($result);
	}

	public function getPrint($id, $idSantri)
	{
		$data = $this->twm->getDataPrint($id);
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		$jadi =  $generator->getBarcode($data[0]->id_walisantri, $generator::TYPE_CODE_128, 9, 240);

		$data = [
			'title' => 'Print Out Kartu Mahram',
			'id' => $idSantri,
			'data' => $data[0],
			'santri' => $data[1],
			'total' => $data[2],
			'barcode' => $jadi
		];

		$this->load->view('print/ktws', $data);
	}

	public function reset()
	{
		$this->session->unset_userdata('zone_temu_wali');

		redirect('temuwali/index');
	}

	public function upload()
	{
		$data = [
			'title' => 'Upload Foto'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('temuwali/upload/upload');
		$this->load->view('layout/footer');
		$this->load->view('temuwali/upload/js-upload');
	}

	public function uploadStore()
	{
		$config['upload_path']          = FCPATH . '/assets/images/apps/ktws/';
		// $config['upload_path']          = FCPATH . '/assets/fotowali/dev/';
		$config['allowed_types']        = 'jpg|jpeg';
//		$config['file_name']            = $fileName;

		$this->load->library('upload', $config);
		$data = $this->upload->data();
		$name = $data['file_name'];
		$fotoawal = 'assets/images/apps/ktws/' . $name;
		// $fotoawal = 'assets/fotowali/dev/' . $id . '.jpg';
		if ($fotoawal) {
			@unlink($fotoawal);
		}

		if ($this->upload->do_upload('filepond')) {
			$data = 1;
		} else {
			$data = 0;
		}

		echo json_encode($data);
	}
}
