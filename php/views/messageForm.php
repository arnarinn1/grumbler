<div class="bs-example">
  <form id="submitMessage" role="form" method="post" action="create_grumpy_message.php">
    <textarea id="grumpyMessage" class="form-control" rows="3" name="message"></textarea>
    <div class ="boxPadding">
    	<div class="col-md-2">
        	<select id="emoticons" class="form-control" name="emotion">
			  <option id="grumpy">Grumpy</option>
			  <option id="superangry">Super angry</option>
			  <option id="pissedoff">Pissed off</option>
			  <option id="annoyed">Annoyed</option>
			  <option id="terroristic">Terroristic</option>
			  <option id="hostile">Hostile</option>
			  <option id="cat">Grumpy cat</option>
			</select>
		</div>
		<img class="emoticonPadding" src="emoticons/grumpy.png" id="emoticonSmiley"/> 
    	<button type="submit" id="submitMessageBtn" class="btn btn-primary">Do Some Bitching</button>
    </div>
  </form>
</div>
<br>	