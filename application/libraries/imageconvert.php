<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class imageconvert{
	protected $CI;
	public function namefile($ukuran,$fieldname){
		$CI =& get_instance();
		$config['upload_path'] = './image';
		$config['allowed_types'] = 'jpg';
		$config['max_size']     = '20480';
		$config['max_width'] = '4000';
		$config['max_height'] = '4000';
		// $CI->load->library('upload', $config);
		$CI->upload->initialize($config);
		// print_r($CI->upload->data());
		if (!$CI->upload->do_upload($fieldname)) {
			echo $CI->upload->display_errors();
		}
		else{
		$datainfo = array('file' => $CI->upload->data());
		print_r($datainfo);
		$filename =  $datainfo['file']['file_name'];
		$propt_asal = getimagesize('./image/'.$filename);
		$pathinfo  = pathinfo($datainfo['file']['file_name']);
		$filename1 = $pathinfo['filename'];
		$ext = $pathinfo['extension'];
		$pathupload = './image/'.$filename1.'_'.$ukuran.'.'.$ext;
		unlink('./image/'.$filename);
		}

		return $pathupload;
	}
	public function uploadfileandinsert($fieldname,$tbname,$obj){
		$CI =& get_instance();
		$config['upload_path'] = './image';
		$config['allowed_types'] = 'jpg';
		$config['max_size']     = '20480';
		$config['max_width'] = '4000';
		$config['max_height'] = '4000';
		// $CI->load->library('upload', $config);
		$CI->upload->initialize($config);

		if (!$CI->upload->do_upload($fieldname)) {
			echo $CI->upload->display_errors();
		}
			else{
			// $CI->insertdata($tbname,$obj);
			// $CI->upload->do_upload($fieldname);
			

			$datainfo = array('file' => $CI->upload->data());
			print_r($datainfo);
			$filename =  $datainfo['file']['file_name'];
			$propt_asal = getimagesize('./image/'.$filename);
			$pathinfo  = pathinfo($datainfo['file']['file_name']);
			$filename1 = $pathinfo['filename'];
			$ext = $pathinfo['extension'];
			
			
			//CROP 600X600
			$configsize['image_library'] = 'gd2';
			$configsize['source_image'] = './image/'.$filename;
			$configsize['width']         = 600;
			$configsize['height']       = 600;
			$configsize['maintain_ratio'] = FALSE;
			$configsize['x_axis'] = 20;
			$configsize['y_axis'] = 20;
			$configsize['overwrite'] = TRUE;
			$configsize['new_image'] = './image/'.$filename1.'_600x600.'.$ext;
			$CI->image_lib->initialize($configsize);
			$CI->load->library('image_lib', $configsize);
		    if (!$CI->image_lib->crop()) {
		        echo $CI->image_lib->display_errors();
		        die();
		    }
		    $CI->image_lib->clear();

			//CROP 240X240
			$configsize1['image_library'] = 'gd2';
			$configsize1['source_image'] = './image/'.$filename;
			$configsize1['width']         = 240;
			$configsize1['height']       = 240;
			$configsize1['maintain_ratio'] = FALSE;
			$configsize1['x_axis'] = 20;
			$configsize1['y_axis'] = 20;
			$configsize['overwrite'] = TRUE;
			$configsize1['new_image'] = './image/'.$filename1.'_240X240.'.$ext;
			$CI->image_lib->initialize($configsize1);
			$CI->load->library('image_lib', $configsize1);
		    if (!$CI->image_lib->crop()) {
		        echo $CI->image_lib->display_errors();
		        die();
		    }
			
			unlink('./image/'.$filename);

			
		}
	}
	public function imageupdate($fieldname,$before1,$before2){
			$CI =& get_instance();
			$CI =& get_instance();
		$config['upload_path'] = './image';
		$config['allowed_types'] = 'jpg';
		$config['max_size']     = '20480';
		$config['max_width'] = '4000';
		$config['max_height'] = '4000';
		// $CI->load->library('upload', $config);
		$CI->upload->initialize($config);

		if (!$CI->upload->do_upload($fieldname)) {
			echo $CI->upload->display_errors();
		}
			else{
			// $CI->insertdata($tbname,$obj);
			// $CI->upload->do_upload($fieldname);
			

			$datainfo = array('file' => $CI->upload->data());
			print_r($datainfo);
			$filename =  $datainfo['file']['file_name'];
			$propt_asal = getimagesize('./image/'.$filename);
			$pathinfo  = pathinfo($datainfo['file']['file_name']);
			$filename1 = $pathinfo['filename'];
			$ext = $pathinfo['extension'];
			
			
			//CROP 600X600
			$configsize['image_library'] = 'gd2';
			$configsize['source_image'] = './image/'.$filename;
			$configsize['width']         = 600;
			$configsize['height']       = 600;
			$configsize['maintain_ratio'] = FALSE;
			$configsize['x_axis'] = 20;
			$configsize['y_axis'] = 20;
			$configsize['overwrite'] = TRUE;
			$configsize['new_image'] = $before1;
			// $configsize['file_name'] = './image/'.'JIANCOKKKKKKK'.'_600x600.'.$ext;
			echo $before1.'<br>';
			echo $before2;

			$CI->image_lib->initialize($configsize);
			$CI->load->library('image_lib', $configsize);
		    if (!$CI->image_lib->crop()) {
		        echo $CI->image_lib->display_errors();
		        die();
		    }
		    $CI->image_lib->clear();

			//CROP 240X240
			$configsize1['image_library'] = 'gd2';
			$configsize1['source_image'] = './image/'.$filename;
			$configsize1['width']         = 240;
			$configsize1['height']       = 240;
			$configsize1['maintain_ratio'] = FALSE;
			$configsize1['x_axis'] = 20;
			$configsize1['y_axis'] = 20;
			$configsize['overwrite'] = TRUE;
			$configsize1['new_image'] = $before2;
			$CI->image_lib->initialize($configsize1);
			$CI->load->library('image_lib', $configsize1);
		    if (!$CI->image_lib->crop()) {
		        echo $CI->image_lib->display_errors();
		        die();
		    }
			
			unlink('./image/'.$filename);

			
		}
	}
}

/* End of file imageconvert.php */
/* Location: ./application/libraries/imageconvert.php */