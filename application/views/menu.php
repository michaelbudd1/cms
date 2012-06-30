<div class="existing_pages">
	<div class="add_page_menu">
    	<ul>
        	<li><a href="menu/paste_page?sectionid=<?php if(isset($_GET['sectionid'])) { echo $_GET['sectionid']; } else { echo "-1"; } ?>" id="paste_link">Paste</a>
        	<li><? echo anchor('add_section', 'Add New Section'); ?></li>
        	<li><? echo anchor('add_page', 'Add New Page'); ?></li>
        </ul>
    </div>

	<div style="clear: both"></div>

	<div class="edit_page_menu">
    	<ul>
        	<li><a href="" id="copy_link" class="copy_link">Copy</a></li>
        	<li><a href="" id="cut_link">Cut</a></li>
        	<li><a href="" id="thumb_edit_link">Edit</a></li>
        	<li><a href="" id="delete_page_link" onclick="return confirm('Are you sure you want to delete this page?')">Delete</a></li>
        </ul>
    </div>

</div>
    
