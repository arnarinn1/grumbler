
$(document).ready(function()
{

	$("select").change(function () 
	{
	    $( "#filterMessages option:selected" ).each(function() 
	    {
	    	//Selected filter option
	    	var filter = $(this).attr('id');
	    	var grumpyFilter = filter.substring(0, filter.length-6);
	    		
	    	//All messages
	        var messages = $("div .bs-callout.bs-callout-info");
	       
	        if (grumpyFilter !== "allGrumps")
	        {
	        	//Only show those messages user filtered by
	        	$.each(messages, function( i, l )
		        {
				  	var image = $(this).find(".emoticon").attr("src");

				   	if (image.indexOf(grumpyFilter) === -1)
				   	{
						$(this).hide("slow");	   	
				   	}
				   	else
				   	{
				   		$(this).show("slow");
				   	}
			    });	
	        }
	        else
	        {
	        	//User selected all messages so we show them all
	        	$.each(messages, function( i, l )
		        {				  	 
			   		$(this).show("slow");
			    });	
	        }

	    });

  	}).change();

});