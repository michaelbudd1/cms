<?php

class menu_model extends CI_Model {
	
	function get_existing_pages(){

		if(isset($_GET['sectionid'])){
			
			$section_id = $_GET['sectionid'];
		
			$query = $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1 AND section=' . $section_id);
			return $query->result();
		
		}
	}
	
	
	function get_existing_sections(){
		
		
			if(isset($_GET['sectionid'])){
				
				$sectionId = $_GET['sectionid'];
		
				$query = $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1 AND section=' . $sectionId . ' AND sub_section = 1');
				return $query->result();
			
			} else {
				
				$query = $this->db->query('SELECT * FROM page_cms WHERE deleted <> 1 AND section=-1');
				return $query->result();
			}
	}
}

?>