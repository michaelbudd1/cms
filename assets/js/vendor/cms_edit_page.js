$(function(){
	$(".edit_page_menu").hide();
})


$(function() {
		$(".page_thumb" ).click(function(event){
			$(".add_page_menu").hide();
			var this_thumb = $(this).attr('id');
			$("#thumb_edit_link").attr('href', 'edit_thumb/' + this_thumb);
			$("#delete_page_link").attr('href', 'delete_thumb/' + this_thumb);

		});
	});
	
	
$(function(){
	$('.page_thumb').click(function(e){
		edit_page_mouse_left = e.pageX;
		edit_page_mouse_top  = e.pageY;
	});
})

$(function(){
	$(".page_thumb").click(function(event){
		$(".add_page_menu").hide();
		$(".edit_page_menu").hide();
		$(".edit_page_menu").show();
		$(".edit_page_menu").css('top', edit_page_mouse_top);
		$(".edit_page_menu").css('left', edit_page_mouse_left);
		var thumb_select = $(this).data('thumb_select');
		
		// CHANGE THE LINK FOR EDIT / COPY / DELETE WHEN CLICKED
		var new_copy_link = "copy_link_" + thumb_select;
		$(".copy_link").attr('id', new_copy_link);
		////////////////////////////////////////////////////////
		
		var thumb_select = "#thumb_" + thumb_select;
		$(thumb_select).css('border', '4px solid #000;');
	})
})

$(function(){
		$(".copy_link").click(function(event){
			event.preventDefault();
			var copy_link_id = $(this).attr('id');
			var copy_link_id = copy_link_id.replace('copy_link_', '');
		
			if(copy_link_id > 1){

				$.post("/start_copy_session.php", {"pageid": copy_link_id});
			}
		})
})


// DRAGABBLE 
$(function() {
		$(".add_page_menu").hide();
		$(".edit_page_menu").hide();
		$(".page_thumb").draggable({ containment: ".existing_pages", scroll: false });
		$(".page_thumb" ).draggable({ refreshPositions: true });
		$(".page_thumb" ).bind( "drag", function(event, ui) {
			var offset = $(this).offset();
            var xPos = offset.left;
            var yPos = offset.top;
            console.log('x: ' + xPos);
            console.log('y: ' + yPos);
		});
});

	
