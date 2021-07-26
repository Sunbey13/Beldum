$('body').on('click', '.password-checkbox', function(){
	if ($(this).is(':checked')){
		$('#password-input').attr('type', 'text');
	} else {
		$('#password-input').attr('type', 'password');
	}
}); 

$('body').on('click', '.password-old-checkbox', function(){
	if ($(this).is(':checked')){
		$('#old').attr('type', 'text');
	} else {
		$('#old').attr('type', 'password');
	}
}); 

$('body').on('click', '.password-new-checkbox', function(){
	if ($(this).is(':checked')){
		$('#new-1').attr('type', 'text');
	} else {
		$('#new-1').attr('type', 'password');
	}
}); 

$('body').on('click', '.password-new-checkbox', function(){
	if ($(this).is(':checked')){
		$('#new-2').attr('type', 'text');
	} else {
		$('#new-2').attr('type', 'password');
	}
}); 