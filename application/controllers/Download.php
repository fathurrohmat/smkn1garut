<?php
class Download extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_files');
		$this->load->helper('download');
		
	}
	function index(){
		$x['data']=$this->m_files->get_all_files();
		$x['header'] = $this->load->view('tampilan_frontend/header','',TRUE);
			
		$this->load->view('tampilan_frontend/view_download',$x);
	}

	function get_file(){
		$id=$this->uri->segment(3);
		$get_db=$this->m_files->get_file_byid($id);
		$q=$get_db->row_array();
		$file=$q['file_data'];
		$path='./assets/files/'.$file;
		$data = file_get_contents($path);
		$name = $file;
		force_download($name, $data);
	}

}
