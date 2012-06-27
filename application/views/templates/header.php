<? $this->load->helper('url'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title ?></title>
<script type="text/javascript" src="<? echo base_url() ?>assets/js/vendor/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<? echo base_url() ?>assets/js/vendor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<? echo base_url() ?>assets/js/vendor/cms_add_page.js"></script>
<script type="text/javascript" src="<? echo base_url() ?>assets/js/vendor/cms_edit_page.js"></script>
<script type="text/javascript" src="<? echo base_url() ?>assets/js/vendor/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">
tinyMCE.init({
        mode : "textareas"
});
</script>
<link rel="stylesheet" href="<? echo base_url() ?>assets/css/reset.css" />
<link rel="stylesheet" href="<? echo base_url() ?>assets/css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>

</head>

<body>
	<div class="wrapper">
    	<div class="header">
   			<? if(!isset($header_admin_image)){
				echo "<div class='add_header_admin_image'>";
			}
			?>
            
			<h1>Content Management System - Main Menu</h1>
            
            <? if(!isset($header_admin_image)){
				echo anchor('menu/add_admin_image', 'Add Image');
				echo "</div>";
			}
			?>
            
            <div class="nav_options">
            	<ul>
                	<li><?php echo anchor('menu', 'Main Menu'); ?></li>
                    <li><?php echo anchor('add_page', 'Add Page'); ?></li>
                </ul>
            </div><!-- closing of nav_options -->
            
            <div style="clear: both"></div>
            
        </div>
        
