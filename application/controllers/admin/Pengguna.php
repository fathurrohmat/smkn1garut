<?php
class Pengguna extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('model_pengguna');
		$this->load->library('upload');
	}


	function index(){
		$kode=$this->session->userdata('idadmin');
		$x['user']=$this->model_pengguna->get_pengguna_login($kode);
		$x['data']=$this->model_pengguna->get_all_pengguna();
		$this->load->view('admin/v_pengguna',$x);
	}

	

	

}