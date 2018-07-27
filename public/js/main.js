$("#rateYo").each(function () {
	$('#rateYo').rateYo({
	    starWidth: "20px",
	  
	});

	$('#rateYo2').rateYo({
	    starWidth: "20px",
	  
	});
	
	
	$('#rateYo').click(function(){
		var rating = $('#rateYo').rateYo("rating");
		console.log(rating);

		 $('#val').val(rating);


	});

});

