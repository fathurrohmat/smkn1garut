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
	function simpan_pengguna(){
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if(!empty($_FILES['filefoto']['name']))
		{
			if ($this->upload->do_upload('filefoto'))
			{
				$gbr = $this->upload->data();
				//Compress Image

				$config['source_image']='./assets/images/'.$gbr['file_name'];

				$config['quality']= '60%';
				$config['width']= 300;
				$config['height']= 300;
				$config['new_image']= './assets/images/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();


				$nama=$this->input->post('xnama');
				$jenkel=$this->input->post('xjenkel');
				$username=$this->input->post('xusername');
				$password=sha1($this->input->post('xpassword'));
				$email=$this->input->post('xemail');
				$nohp=$this->input->post('xkontak');
				$level=$this->input->post('xlevel');
				$gambar=$gbr['file_name'];
				$this->model_pengguna->simpan_pengguna($nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar);

				echo $this->session->set_flashdata('msg','success');
				redirect('admin/ekskul');
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/ekskul');
			}

		}else{
			$this->model_pengguna->simpan_pengguna_tanpa_img();
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/pengguna');
		}


	}

	

	

}
