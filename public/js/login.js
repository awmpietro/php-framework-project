$(function(){
	$("#login_form").submit(function(e){
		e.preventDefault();
		$.post('login/authenticate', $("#login_form").serialize(), function(data){
			data = JSON.parse(data);
			window.sessionStorage.setItem('jwt', data.jwt);
			window.location.replace("index");
		}).fail(function(){
			alert('error');
		});
	});
});