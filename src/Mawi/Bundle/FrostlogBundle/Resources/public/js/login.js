$(function(){
	console.log('hi');
	$.ajax({
		url: baseurl+'check', 
		error: function() { 
			console.log('login  error');
		},
		success: function(data) {
			if (data != 'OK') {
				console.log(data);
				$.mobile.changePage($('#loginPage'));
			} else {
				$.mobile.changePage('index');
			}
		}
	});
	
	$('body').on('click', '#loginButton', function(){
		$.ajax({
			url: baseurl+'login_check', 
			type: 'POST',
			data: '_username='+ $('#username').val() + '&_password=' + $('#password').val(),
			error: function() { 
				console.log('login error');
			},
			success: function(data) {
				$('#password').val('');
				if (data == 'DONE') {
					$.mobile.changePage('index');
				} else {
					$('#password').focus();
				}
			}
		});
	});
	
	$('body').on('click', '#logout', function(){
		$.ajax({
			url: baseurl+'logout', 
			type: 'GET',
			error: function() { 
				console.log('logout error');
			},
			success: function() {
				console.log('logout done');
				$.mobile.changePage($('#loginPage'));
			}
		});
	});
	
	
	
});