<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model', 'model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$var['data'] = $this->model->get_data_pasien();
		$this->load->view('pasien', $var);
	}

	public function simpan_pasien()
	{
		$value = [
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address')
		];

		$simpan = $this->db->insert('patients', $value);
		if($simpan) {
			$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data pasien berhasil disimpan</div');
            redirect('Controller');
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Data pasien gagal disimpan</div');
            redirect('Controller');
		}
	}

	public function update_pasien()
	{
		$id = $this->input->post('id');
		$value = [
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address')
		];

		$update = $this->db->update('patients', $value, ['id' => $id]);
		if($update) {
			$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data pasien berhasil diperbarui</div');
            redirect('Controller');
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Data pasien gagal diperbarui</div');
            redirect('Controller');
		}
	}

	public function hapus_pasien($id)
	{
		$hapus = $this->db->delete('patients', ['id' => $id]);
		if($hapus) {
			$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data pasien berhasil dihapus</div');
            redirect('Controller');
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Data pasien gagal dihapus</div');
            redirect('Controller');
		}
	}

	public function visit()
	{
		$var['data'] = $this->model->get_data_visit();
		$var['pasien'] = $this->model->get_data_pasien();
		$this->load->view('visit', $var);
	}

	public function simpan_visit()
	{
		$value = [
			'patient_id' => $this->input->post('patient_id'),
			'name' => $this->input->post('name'),
			'clinic_name' => $this->input->post('clinic_name'),
			'tanggal_daftar' => $this->input->post('tanggal_daftar'),
			'tanggal_mulai_periksa' => $this->input->post('tanggal_mulai_periksa'),
			'tanggal_selesai_periksa' => $this->input->post('tanggal_selesai_periksa'),
			'doctor_name' => $this->input->post('doctor_name')
		];

		$simpan = $this->db->insert('visit', $value);
		if($simpan) {
			$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data pasien berhasil disimpan</div');
            redirect('Controller');
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Data pasien gagal disimpan</div');
            redirect('Controller');
		}
	}
}
