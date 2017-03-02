
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="http://79.170.44.75/shycan.com/content/12-twitter/styles.css">-->
      <link rel="stylesheet" href="styles.css" type="text/css">
  </head>
  <body>
      
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">Twitter</a> 

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link
                      <?php 
                    session_start();
                    if(!$_SESSION["id"]){
                        echo "disabled";
                    }
                  ?>
                      " href="index.php?page=timeline">Your timeline <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link
                  <?php 
                    session_start();
                    if(!$_SESSION["id"]){
                        echo "disabled";
                    }
                  ?>
                      " href="index.php?page=yourtweets">Your tweets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link
                  <?php 
                    session_start();
                    if(!$_SESSION["id"]){
                        echo "disabled";
                    }
                  ?>
                      " href="index.php?page=publicprofiles">Public Profiles</a>
          </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <span id="welcomeWords" style="margin-right:10px">
            <?php
              session_start();
              if($_SESSION["email"]){
                  echo "Welcome, ".$_SESSION["email"];
              }
              ?>
            </span>
          <button class="btn btn-outline-success my-2 my-sm-0"  data-toggle="modal" data-target="#myModal1" id ="loginSignupBtn"  
                  <?php 
                    session_start();
                    if($_SESSION["id"]){
                        echo "style='display:none'";
                    }
                  ?>
                  >Login/Signup
              </button>
          <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#myModal2" id="logoutBtn"
                  <?php
                    session_start();
                    if(!$_SESSION["id"]){
                        echo "style='display:none'";
                    }
                  ?>
                  >Logout
              </button>
        </div>
      </div>
    </nav>
