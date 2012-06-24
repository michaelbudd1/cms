
<?php

class menu_model extends CI_Model {
	
	function get_existing_pages(){
	
		$query = $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1');
		return $query->result();
	}
	
	
	
}

?>