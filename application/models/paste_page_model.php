<?php
session_start();


class Paste_page_model extends CI_Model {
	
	function paste_page()
	{
		if(isset($_SESSION['copy'])){
		
		$sectionid= $_GET['sectionid'];
		
		$query = "SELECT * FROM page_cms WHERE page_id = " . $_SESSION['copy'];
		$result = mysql_query($query);
		while($row= mysql_fetch_array($result)){
			$page_descrip = $row['page_descrip'];
			$page_content = $row['page_content'];
		}
		
		$query = "INSERT INTO page_cms (section, page_descrip, page_content) VALUES ('$sectionid', '$page_descrip', '$page_content')";
		$result = mysql_query($query);
		
		unset($_SESSION['copy']);
		}
		
		return;

	}
}
?>