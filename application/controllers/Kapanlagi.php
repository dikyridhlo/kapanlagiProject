<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapanlagi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->model('image_model');
		$this->load->helper('url');
		$this->load->library('imageconvert');
		// $this->load->library('image_lib');

	}
	public function index()
	{
        $this->load->view('layout/header');
        $data = $this->crud_model->getdata('kapanlagi');
        $data = array('data' => $data);
        $this->load->view('crud/body', $data);
	}

	public function insert(){
		$data = array(
        'nama' => $this->input->post('nama'),
        'alamat' => $this->input->post('alamat'),
        'tgl_lahir' => $this->input->post('tl'),
        'email' => $this->input->post('email')
		);
		if (empty($_FILES['image']['name'])) {
			echo "FILE TDK ADA";
			$this->crud_model->insertdata('kapanlagi',$data);
		}else{
			echo "FILE ADA";
			$path600x600 = $this->imageconvert->namefile('600x600','image');
			$path240x240= $this->imageconvert->namefile('240x240','image');


			$this->imageconvert->uploadfileandinsert('image','kapanlagi',$data);
			$this->crud_model->insertdata('kapanlagi',$data);
			$insert_id = $this->db->insert_id();

			$img1 = array(
				'ID_KAPANLAGI' => $insert_id,
				'FOTO' => $path600x600
			);
			$img2 = array(
				'ID_KAPANLAGI' => $insert_id,
				'FOTO' => $path240x240
			);
			$this->image_model->insertdata('foto_kapanlagi',$img1);
			$this->image_model->insertdata('foto_kapanlagi',$img2);
		}
		
 		 // $this->image_lib->clear();
		redirect('','refresh');
	}
	public function delete(){
		$id = $this->input->get('id');
		$data['id'] = $id;
		$cari = $this->db->get_where('foto_kapanlagi', array('ID_KAPANLAGI'=>$id));
		$result = $cari->result_array();
		if (count($result) == 0) {
		$this->crud_model->deletedata('kapanlagi', $data);
		}else{
			foreach ($result as $key) {
				unlink($key['FOTO']);
			}
		$this->crud_model->deletedata('kapanlagi', $data);

		}
		redirect('','refresh');

	}



	public function update(){
		$id = $this->input->post('id');
		$file = $_FILES['upimage']['name'];
		echo $file;
		echo $id;
		$data=array(
			'nama' => $this->input->post('upnama'),
	        'alamat' => $this->input->post('upalamat'),
	        'tgl_lahir' => $this->input->post('uptl'),
	        'email' => $this->input->post('upemail')
		);
		if (empty($file)) {
			$this->crud_model->updatedata('kapanlagi',$data,array('ID'=>$id));
			echo 'file kosong';
		}else{
			echo "file ada";
			//SEARCH DATA FOTO
			$cari = $this->db->get_where('foto_kapanlagi', array('ID_KAPANLAGI'=>$id));
			$result = $cari->result_array();
			if (count($result) == 0) {
				$path600x600 = $this->imageconvert->namefile('600x600','upimage');
				$path240x240= $this->imageconvert->namefile('240x240','upimage');


				$this->imageconvert->uploadfileandinsert('upimage','kapanlagi',$data);

				$img1 = array(
					'ID_KAPANLAGI' => $id,
					'FOTO' => $path600x600
				);
				$img2 = array(
					'ID_KAPANLAGI' => $id,
					'FOTO' => $path240x240
				);
				$this->image_model->insertdata('foto_kapanlagi',$img1);
				$this->image_model->insertdata('foto_kapanlagi',$img2);
			} //FILE FALSE
			else{ //FILE TRUE
				foreach ($result as $key) {
					$hasil[] = $key['FOTO'];

				}

				$this->imageconvert->imageupdate('upimage',$hasil[0],$hasil[1]);
			}
			$this->crud_model->updatedata('kapanlagi',$data,array('ID'=>$id));	
			
		}
		redirect('','refresh');


	}
	public function encode(){
		// $query = $this->crud_model->getdata('kapanlagi');
		// $tmp = array();
		// foreach ($query as $key => $value) {
		// 	# code...
		// }
		// $query = $this->crud_model->joindata('kapanlagi','foto_kapanlagi','ID','ID_KAPANLAGI');
		// foreach ($query->result() as $key) {
		// 	$tmp[] = $key;
		// }
		$query = $this->db->get('kapanlagi');
		// print_r($query->result());
		foreach ($query->result() as $key) {
			$tes[] = $key;
			$cari = $this->db->get_where('foto_kapanlagi', array('ID_KAPANLAGI'=>$key->ID));
			foreach ($cari->result() as $key1) {
				// $tes[] = $key1;
				$key->FOTO[] = $key1->FOTO;


			}

		}
		$p = array(
			'total Data' => count($this->crud_model->getdata('kapanlagi')),
			'Data' => $tes
			// 'foto' => 
	);
		// print_r($p);
		// $dtenc = json_encode($p, JSON_PRETTY_PRINT);

		// json_decode($p,true);
		// echo json_encode($tes);
		$this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($p, JSON_PRETTY_PRINT));
	}
	

}

/* End of file Kapanlagi.php */
/* Location: ./application/controllers/Kapanlagi.php */