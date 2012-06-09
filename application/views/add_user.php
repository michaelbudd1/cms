<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CMS - Add User</title>
</head>
<body>

<div id="container">
    <?php $this->load->view('templates/header'); ?>

	<div id="body">

        <?php echo form_open('add_user/create');?>
        
            <div class="spaceBelow">
            
                <label for="page_descrip">Page Description:</label>
                <input type="text" name="page_descrip" id="page_descrip" />
                
            </div>
            
            <div class="spaceBelow">
            
                <label for"page_content">Page Content:</label>
                <textarea name="page_content" id="page_content"></textarea>
            
            </div>
            
            <div class="spaceBelow">
            
                <input type="submit" value="Add Page" />
            
            </div>
        
        <?php echo form_close(); ?> 
        
        <hr />
        
        <h2>Read</h2>
        
        <?php if(isset($records)) : foreach($records as $row) : ?>
        
        <h2><?php echo anchor("add_user/delete/$row->page_id", $row->page_descrip); $row->page_descrip; ?> </h2>
        <div><?php echo $row->page_content; ?></div>
        <?php endforeach; ?>
        <?php else : ?>
        
        <h3>No records were returned.</h3>
        
        <?php endif ?>
        
        
        <hr />
        
        <h2>Delete</h2>
        
        <p>To sample the delete method, simply click on one of the headings... blah blah.</p>
        
        
        
        <hr />
        
        
	</div>

</div>

</body>
</html>