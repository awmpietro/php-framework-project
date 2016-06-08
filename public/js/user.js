$(function(){
	$("#btn_teste").click(function(e){
		e.preventDefault();
		$.ajax({
			url: 'index/teste',
			beforeSend: function(request){
				request.setRequestHeader('Authorization', window.sessionStorage.getItem('jwt'));
			},
			type: 'GET',
			success: function(data) {
				alert(data);
			},
			error: function() {
				alert('error');
			}
		});
	});
});
	
//alert(window.sessionStorage.getItem('jwt'));