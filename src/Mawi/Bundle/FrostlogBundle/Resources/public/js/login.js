$(function(){
	var hasStorage = (function() {
      try {
    	var mod = 1323422;
        localStorage.setItem(mod, mod);
        localStorage.removeItem(mod);
        return true;
      } catch(e) {
        return false;
      }
	}());
	
	var autologin = function() {
		if (hasStorage) {
			var u = localStorage.getItem('u');
			var p = localStorage.getItem('p');
			if (u && p) {
				$('#remember').val('1');
				$('#username').val(u);
				$('#password').val(p);
				$('#loginButton').click();
			}
		}
	};
	
	$.mobile.loading( 'show' );
	$.ajax({
		url: baseurl+'check', 
		error: function() { 
			console.log('login  error');
			$.mobile.loading( 'hide' );
		},
		success: function(data) {
			if (data != 'OK') {
				console.log(data);
				$.mobile.changePage($('#loginPage'));
				autologin();
			} else {
				$.mobile.changePage('index');
			}
			$.mobile.loading( 'hide' );
		}
	});
	
	
	
	$('body').on('click', '#loginButton', function(){
		$.mobile.loading( 'show' );
		if (hasStorage) {
			if ($('#remember').val()*1) {
				localStorage.setItem('u', $('#username').val());
				localStorage.setItem('p', $('#password').val());
			} else {
				localStorage.removeItem('u');
				localStorage.removeItem('p');
			}
		} else {
			$('#remember').attr('disabled', 'disabled').slider('refresh');
		}
		
		$.ajax({
			url: baseurl+'login_check', 
			type: 'POST',
			data: '_username='+ $('#username').val() + '&_password=' + $('#password').val(),
			error: function() { 
				console.log('login error');
				$.mobile.loading( 'hide' );
			},
			success: function(data) {
				$('#password').val('');
				if (data == 'DONE') {
					$.mobile.changePage('index');
				} else {
					$('#password').focus();
				}
				$.mobile.loading( 'hide' );
			}
		});
	});
	
	$('body').on('click', '#logout', function(){
		$.mobile.loading( 'show' );
		$.ajax({
			url: baseurl+'logout', 
			type: 'GET',
			error: function() { 
				console.log('logout error');
				$.mobile.loading( 'hide' );
			},
			success: function() {
				console.log('logout done');
				$.mobile.changePage($('#loginPage'));
				$.mobile.loading( 'hide' );
			}
		});
	});
	
	
	
});