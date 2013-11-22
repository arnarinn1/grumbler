<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Followers</h4>
      </div>
      <div class="modal-body">

      	<?php foreach($followers as $follower): ?>

      	<div class="row">
		    <div class="col-lg-8">
		        <div class="media">
		        	<?php 
		            	print '<a class="pull-left" href="view_user.php?user=' . $follower['username'] .'&amp;id=' . $follower['id'] . '">';
	                	print '<img class="media-object dp img-circle" alt="' . $follower['username'] . '"
		                src="pics/' . $follower["username"] . '.png" style="width: 100px;height:100px;">';
		                ?>
		            </a>
		            <div class="media-body">
		            	<?php
		            		print '<h4 class="media-heading">' . $follower['name'] . '</h4>';
		                	print '<h5>Username: ' . $follower['username'] . ' </h5>';
		                	print '<hr style="margin:8px auto">';
		                ?>
		            </div>
		        </div>
		    </div>
		</div>
		<br>

		<?php endforeach; ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>