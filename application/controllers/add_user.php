<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class add_user extends CI_Controller
	{
		function index()
		{
			$data = array();
			//$this->load->view('add_user');	
			
			if($query = $this->add_user_model->get_records())
			{
				$data['records'] = $query;	
			}
			
			$this->load->view('add_user', $data);
		}
		
		function create()
		{
			$data = array(
				'page_descrip' => $this->input->post('page_descrip'),
				'page_content' => $this->input->post('page_content')
			);
			
			$this->add_user_model->add_record($data);
			$this->index();
		}
		
		function delete()
		{
			$this->add_user_model->delete_row();
			$this->index();
		}
		
		
		function update()
		{
			$data= array(
				'page_descrip' => 'My page descrip update',
				'page_content' => 'My content update'
			);
			
			$this->add_user_model->update_record($data);
		}
		

	}


?>