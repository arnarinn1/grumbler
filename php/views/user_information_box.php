<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                    	<?php 
                        	print '<img src="pics/' . $userInfo['username'] . '.png" alt="profile picture" class="img-rounded img-responsive" />';
                        ?>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            <?php echo $userInfo["name"] ?>
                        </h4>
                        <small>
                        	<cite> <?php echo $userInfo["location"]?>
                        		<i class="glyphicon glyphicon-map-marker"></i>
                    		</cite>
                    </small>
                        <p>
                            <i class="glyphicon glyphicon-user"></i><?php echo $userInfo['username'] ?>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i><?php echo $formattedDate ?>
                            <br />
                            <i class="glyphicon glyphicon-info-sign"></i><?php echo $userInfo["information"] ?>
                            <br />
                        	<i class="glyphicon glyphicon-plus"></i>

                        	<?php echo '<a href="#" data-toggle="modal" data-target="#myModal">' . sizeof($followers) . ' followers</a>' ?>
                        
                        	<?php include("views/launch_followers.php") ?>

                        </p>  
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>