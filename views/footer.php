
<footer class="footer">
  <div class="container">
    <span class="text-muted">&copy; My Website 2017</span>
  </div>
</footer>    
<!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<!-- Modal1 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="alert alert-danger"  id="alert1" style="display:none">
            </div>
          <div class="alert alert-success" role="alert" id="alert2" style="display:none"></div>
        <form method="post">
          <input type="hidden" id="loginActive" name="loginActive" value="1">
          <div class="form-group">
            <label for="formGroupExampleInput">Email</label>
            <input type="text" class="form-control" id="email" placeholder="email address">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Password</label>
            <input type="text" class="form-control" id="password" placeholder="password">
          </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <a id="toggleLogin" href="#">Signup</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnLoginSignup" type="button" class="btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>  

<!--Model2-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="alert alert-danger" >
                Do you want to logout?
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="logoutBtnModel" type="button" class="btn btn-primary">Logout</button>
      </div>
    </div>
  </div>
</div>  

<script type="text/javascript">
    $("#toggleLogin").click(function(){
        if($("#loginActive").val() == "1"){
            $("#exampleModalLabel").text("Signup");
            $("#toggleLogin").text("Login");
            $("#btnLoginSignup").text("Signup");
            $("#loginActive").val("0");
        }else{
            $("#exampleModalLabel").text("Login");
            $("#toggleLogin").text("Signup");
            $("#btnLoginSignup").text("Login");
            $("#loginActive").val("1");
        }
    });
    
    $("#btnLoginSignup").click(function(){
        $.ajax({
            method: "POST",
            url: "actions.php?action=loginSignup",
            data:{
                "loginActive" : $("#loginActive").val(),
                "email" : $("#email").val(),
                "password" : $("#password").val()
            },
            success: function(data){
                if(data != ""){
                    $("#alert1").text(data);
                    $("#loginAlert").show();
                }else{
                    $("#alert2").text("successfully");
                    $("#alert2").show();
                    setTimeout(function(){
                        location.assign("http://79.170.44.75/shycan.com/content/12-twitter/index.php");
                    }, 1000);
                }
            }
        });
    });
    
    $(".toggleFollow").click(function(){
        var id = $(this).attr("data-userId");
        $.ajax({
            method: "POST",
            url: "actions.php?action=toggleFollow",
            data:{
                "userId" : id
            },
            success: function(data){
                if(data == "1"){
                    $("a[data-userId='" + id + "']").html("Follow");
                }else{
                    $("a[data-userId='" + id + "']").html("Unfollow");
                }
            }
        });
    });
    
    $("#postTweets").click(function(){ 
//        alert($("#exampleTextarea").val());
        $.ajax({
            method: "POST",
            url: "actions.php?action=postTweets",
            data: {"tweetContent": $("#exampleTextarea").val()},
            success:function(data){
                if(data == "1"){
                    alert("you have posted your tweet successfully!");
                    $("#postSuccAlert").show();
                    $("#postSuccAlert").html("you have posted your tweet successfully!");
                    $("#postFailAlert").hide();
                }else{
                    $("#postFailAlert").show();
                    $("#postFailAlert").html(data);
                    $("#postSuccAlert").hide();
                }
            }
        });
    });
    
    $("#logoutBtnModel").click(function(){
        //ajax to server side; session_unset()
        //location.assign("http://79.170.44.75/shycan.com/content/12-twitter/index.php");
        $.ajax({
           url:"actions.php?action=logout",
            success:function(data){
                location.assign("http://79.170.44.75/shycan.com/content/12-twitter/index.php");
            }
        });
    });

</script>
</body>
</html>