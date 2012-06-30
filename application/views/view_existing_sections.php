		
		<?php if(isset($sections)) : foreach($sections as $row) : ?>
       	<?php 
		$page_descrip = $row->page_descrip;
		if(strlen($page_descrip) > 20) {
		$page_descrip = substr($row->page_descrip, 0, 20) . " ...";
		}
		?>
        <div class="section_thumb ui-widget-content" data-thumb_select="<?php echo $row->page_id; ?>" id="thumb_<?php echo $row->page_id; ?>">
        	<p><?php echo $page_descrip; ?></p>
        </div>
     
        <?php endforeach; ?>
        <?php else : ?>
        
    
        
        <?php endif ?>
		