		
        
		<?php if(isset($records)) : foreach($records as $row) : ?>
       	<?php 
		$page_descrip = $row->page_descrip;
		if(strlen($page_descrip) > 20) {
		$page_descrip = substr($row->page_descrip, 0, 20) . " ...";
		}
		?>
        <div class="page_thumb ui-widget-content" data-thumb_select="<?php echo $row->page_id; ?>" id="thumb_<?php echo $row->page_id; ?>">
        	<p><?php echo $page_descrip; ?></p>
        </div>
       
        <?php endforeach; ?>
        <?php else : ?>
        
        <h3>No records were returned.</h3>
        
        <?php endif ?>
