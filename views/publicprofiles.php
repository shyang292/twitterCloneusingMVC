<div class="container mainDiv">
    <div class="row">
      <div class="col-md-8">
          
          <?php
            if($_GET["userid"]){
                displayTweets($_GET["userid"]);
            }else{
                echo "<h2>Active Users</h2>";
                displayActiveUsers();
            }
          ?>
      </div>
      <div class="col-md-4">
          <?php displaySearch(); ?>
          
          <?php displayTweetBox(); ?> 

      </div>
    </div>
</div>
