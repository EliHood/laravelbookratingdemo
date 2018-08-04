(function($){
	$('#flash-message').hide();
	$('#rateYo').rateYo({
	    starWidth: "20px",
	  
	});


	$('#rateYo2').rateYo({
	    starWidth: "20px",
         readOnly: true
	  
	});
	
	
	$('#rateYo').click(function(){
		var rating = $('#rateYo').rateYo("rating");
		console.log(rating);

		 $('#val').val(rating);


	});




$('#sub').submit(function(e){
      var owl = $(this).attr("data");
      var route = JSON.parse(owl);

         $.ajax({
            type:"POST",
            url:"/rate/" + route.id,
            headers: {
                    'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
              }, 
            data:{rating:$('#val').val()},
            success:function(data){
            	var status = data.status;
              

             
               	if(typeof status !== "undefined"){

                    
             
               		$('#flash-message').show().html(status);
               		
               	}else{


               		$('#flash-message').hide();
               	}
 
            }
         });

      event.preventDefault();


   });

   


 })(jQuery); 