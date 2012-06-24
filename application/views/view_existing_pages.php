		<?php if(isset($records)) : foreach($records as $row) : ?>
        
        <div class="page_thumb" data-thumb_select="<?php echo $row->page_id; ?>" id="thumb_<?php echo $row->page_id; ?>"><?php echo $row->page_content; ?></div>
        <?php endforeach; ?>
        <?php else : ?>
        
        <h3>No records were returned.</h3>
        
        <?php endif ?>
