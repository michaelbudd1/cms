<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends MY_Model {
	
	public function get_existing_pages($section_id)
	{
		return $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1 AND section_id=' . $section_id)->result();
	}
	
	public function get_existing_sections($section_id)
	{
		if ($section_id) {
			$query = $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1 AND section_id=' . $section_id . ' AND sub_section = 1');
		} else {
			$query = $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1 AND section_id=-1');
		}

		return $query->result();
	}

}