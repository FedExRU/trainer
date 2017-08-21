alert('23423');
$(".container-center-themes-themes-block").hide();
$("h4.container-center-themes-subject-label").click(function(){
	$(this).next().slideToggle();
	if($(this).find('#subj-arrow').text() == '▼')
		$(this).find('#subj-arrow').text('▲');
	else
		$(this).find('#subj-arrow').text('▼');
});