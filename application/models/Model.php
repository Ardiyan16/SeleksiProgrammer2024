<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

	public function get_data_pasien()
	{
		$pasien = $this->db->get('patients')->result();
		return $pasien;
	}

	public function get_data_visit()
	{
		$visit = $this->db->select('visits.*, patients.name as nama_pasien')
		->from('visits')
		->join('patients', 'visits.patient_id = patients.id')
		->get()->result();
		return $visit;
	}

}
