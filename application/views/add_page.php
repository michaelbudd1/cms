<div class="existing_pages">
	<div class="add_new_page_div">
    	
        <h2>Add New Page</h2>
    
    	   <?php echo form_open('add_page/create_page');?>
        
            <div class="spaceBelow">
            
                <label for="page_descrip">Page Description:</label>
                <input type="text" name="page_descrip" id="page_descrip" />
                
            </div>
            
            <div class="spaceBelow">
            
                <label for"page_content">Page Content:</label>
                <textarea name="page_content" id="page_content" rows="40" cols="100"></textarea>
            
            </div>
            
            <div class="spaceBelow">
            
                <input type="submit" value="Add Page" />
            
            </div>
        
        <?php echo form_close(); ?> 
    
    </div><!-- closing of add_new_page_div -->

</div>
    
