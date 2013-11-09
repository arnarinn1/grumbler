

$(document).ready(function()
{
	$("select").change(function () 
	{
	    $( "select option:selected" ).each(function() 
	    {
	       var smiley = $(this).attr('id');
	       $("#emoticonSmiley").attr("src", "emoticons/" + smiley + ".png");
	    });

  	}).change();

});
