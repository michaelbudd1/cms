<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

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
		$data = array();
		$this->load->view('templates/header');
		$this->load->model('menu_model');
			
		if($query = $this->menu_model->get_existing_pages())
		{
			$data['records'] = $query;
		}
		
		if($query = $this->menu_model->get_existing_sections())
		{
			$data['sections'] = $query;
		}
		
		$this->load->view('view_existing_sections', $data);
		$this->load->view('view_existing_pages', $data);	
		
		$this->load->view('menu');
		$this->load->view('templates/footer');
	}
	
	public function paste_page()
	{
		$data = array();
		$this->load->model('paste_page_model');
		$this->paste_page_model->paste_page($data);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */