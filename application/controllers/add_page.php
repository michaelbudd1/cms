<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class add_page extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('add_page');
		$this->load->view('templates/footer');
	}
	
	public function create_page()
	{
			$data = array(
				'page_descrip' => $this->input->post('page_descrip'),
				'page_content' => $this->input->post('page_content')
			);
			
			$this->load->model('add_page_model');
			$this->add_page_model->add_new_page($data);
			$this->index();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */