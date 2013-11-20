

$(document).ready(function()
{
	$("select").change(function () 
	{
	    $( "#emoticons option:selected" ).each(function() 
	    {
	       var smiley = $(this).attr('id');
	       $("#emoticonSmiley").attr("src", "emoticons/" + smiley + ".png");
	    });

  	}).change();

  	$("#submitMessage").submit(function(event)
	{
		var message = $("#grumpyMessage").val();

		if (message == "")
		{
			$("#submitMessageBtn").attr('class', 'btn btn-danger');
			$("#submitMessageBtn").text('Must Enter Text');
  			event.preventDefault();
		}
		else
		{
			$("#submitMessageBtn").attr('class', 'btn btn-primary');
			$("#submitMessageBtn").text('Do Some Bitching');
		}
	});

});
