$(function(){
	$('.section_thumb').click(function(event){
		$(".edit_page_menu").hide();
		
	});
})

$(function(){
	$('.section_thumb').dblclick(function(event){
		$(".edit_page_menu").hide();
			var sectionId = $(this).data('thumb_select');
			window.location = 'http://localhost:8888/index.php?sectionid=' + sectionId;
	});
})