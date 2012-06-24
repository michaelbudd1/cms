/*
$(".header").mousedown(function(e) {
    if (e.which === 1) {
        alert("Right Mousebutton was clicked!");
    }
});
*/
$(function(){
	$(".add_page_menu").hide();
})

$(function(){
	$('.existing_pages').click(function(e){
		add_page_mouse_left = e.pageX;
		add_page_mouse_top  = e.pageY;
	});
})

$(function(){
	$(".existing_pages").click(function(event){
		$(".edit_page_menu").hide();
		$(".add_page_menu").hide();
		$(".add_page_menu").show();
		$(".add_page_menu").css('top', add_page_mouse_top);
		$(".add_page_menu").css('left', add_page_mouse_left);
	})
})
