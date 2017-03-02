<div class="container mainDiv">
    <div class="row">
      <div class="col-md-8">
          <h2>Recent tweets</h2>
          <?php displayTweets('search');  ?>
      </div>
      <div class="col-md-4">
          <?php displaySearch(); ?>
          
          <?php displayTweetBox(); ?> 

      </div>
    </div>
</div>

