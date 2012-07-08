<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {

	protected $_autoload_models = array('menu');

	public function index($section_id = -1)
	{
		$data = array();

		$this->load->view('templates/header');
			
		$data['records'] = $this->menu->get_existing_pages($section_id);
		$data['sections'] = $this->menu->get_existing_sections($section_id);
		
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