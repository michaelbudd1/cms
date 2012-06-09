<?php

class add_user_model extends CI_Model {
	
	function get_records()
	{
		$query = $this->db->get('page_cms');
		return $query->result();
		
	}
	
	function add_record($data)
	{
		$this->db->insert('page_cms', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('page_id', 9);
		$this->db->update('page_cms', $data);
	}
	
	function delete_row()
	{
		$this->db->where('page_id', $this->uri->segment(3));
		$this->db->delete('page_cms');
	}
}