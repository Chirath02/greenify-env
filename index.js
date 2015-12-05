 $("#login-button").click(function(event){
		 event.preventDefault();
	 
	 $('form').fadeOut(500);
	 $('.wrapper').addClass('form-success');
         setTimeout(function() {
    window.location.href = "mainpage/index.html";
}, 2000);
});