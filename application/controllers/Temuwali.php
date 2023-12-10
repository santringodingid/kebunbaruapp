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
}
