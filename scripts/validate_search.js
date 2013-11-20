
$(document).ready(function()
{	
	$("#searchUser").submit(function(event)
	{
		var message = $("#searchUserInput").val();
		
		if (message == "" || message.length < 4)
		{
			$("#searchUserLabel").text('Input must be longer than 3 chars');
  			event.preventDefault();
		}
		else
		{
			$("#searchUserLabel").text('');
		}
	});
	
});