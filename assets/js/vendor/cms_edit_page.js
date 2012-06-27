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
	$(".page_thumb").dblclick(function(event){
		$(".add_page_menu").hide();
		$(".edit_page_menu").hide();
		$(".edit_page_menu").show();
		$(".edit_page_menu").css('top', edit_page_mouse_top);
		$(".edit_page_menu").css('left', edit_page_mouse_left);
		var thumb_select = $(this).data('thumb_select');
		var thumb_select = "#thumb_" + thumb_select;
		$(thumb_select).css('border', '4px solid #000;');
	})
})



// DRAGABBLE 
$(function() {
		$(".add_page_menu").hide();
		$(".edit_page_menu").hide();
		$(".page_thumb").draggable();
});

	
