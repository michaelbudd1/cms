<?php

class add_page_model extends CI_Model {
	
	function add_new_page($data)
	{
		$this->db->insert('page_cms', $data);
		return;
	}


}

?>