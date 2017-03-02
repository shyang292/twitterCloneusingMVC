<?php

    session_start();
    include ("functions.php");

    if(array_key_exists("action", $_GET)){
        $data = "";
       if($_GET["action"] == "loginSignup"){
            if($_POST["loginActive"] == "1"){
                //login
                $email = mysqli_real_escape_string($link, $_POST["email"]);
                $password = mysqli_real_escape_string($link, $_POST["password"]);
                $query = "select * from users where email='$email' limit 1";
                if($result = mysqli_query($link, $query)){
                    if(mysqli_num_rows($result) == 0){
                        $data = "this email doesn't exist";
                    }else{
                        $row = mysqli_fetch_array($result);
                        if($row["2"] == md5(md5($row["0"]).$_POST["password"])){
    //                        $data = "login successfully!";
                            $_SESSION["id"] = $row["id"];
                            $_SESSION["email"] = $row["email"];
                        }else{
                            $data = "password doesn't match!";
                        }
                    }
                    echo $data;
                }
            }else{
                //signup
                $email = mysqli_real_escape_string($link, $_POST["email"]);
                $query = "select * from users where email='$email'";
                if($result = mysqli_query($link, $query)){
                    if(mysqli_num_rows($result) > 0){
                        $data = "this email has been registered";
                    }else{
                        $password = mysqli_real_escape_string($link, $_POST["password"]);
                        $query = "insert into users(email, password) values('$email', '$password')";
                        if(mysqli_query($link, $query)){
//                            $data = "register successfully";
                            $query = "update users set password = '".md5(md5(mysqli_insert_id($link)).$password)."' where email = '$email' limit 1";
                            mysqli_query($link, $query);
                        }
                    }
                }
                echo $data;
            }
       }
       if($_GET["action"] == "toggleFollow"){
           //current user: $_SESSION["id"]   tweet user: $_POST["userId"]
           $query = "select * from isFollowing where follower = ".mysqli_real_escape_string($link,$_SESSION["id"])
               ." and isFollowing = ".mysqli_real_escape_string($link, $_POST["userId"]." limit 1");
           if($result = mysqli_query($link, $query)){
               if(mysqli_num_rows($result) > 0){
                   //unfollow   delete record
                   $row = mysqli_fetch_assoc($result);
                   $query3 = "delete from isFollowing where id= ".$row["id"];
                   if(mysqli_query($link, $query3)){
                       echo "1";
                   }
               }else{
                   //follow
                   $query2 = "insert into isFollowing(follower, isFollowing) values("
                       .mysqli_real_escape_string($link,$_SESSION["id"]).", "
                       .mysqli_real_escape_string($link, $_POST["userId"]).
                   ")";
                   if($result2 = mysqli_query($link, $query2)){
                       echo "0";
                   }
               }
           }
       }
       if($_GET["action"] == "postTweets"){
           if($_POST["tweetContent"] == ""){
               echo "Your tweet is empty!";
           }else if(strlen($_POST["tweetContent"]) > 140){
               echo "Your tweet is too long !";
           }else{
    //           echo mysqli_real_escape_string($_POST["tweetContent"]);
               $query = "insert into tweets(tweet, userid, datetime) values('"
                   .$_POST["tweetContent"]
                   ."',"
                   .$_SESSION["id"]
                   .", NOW())";
               if(mysqli_query($link, $query)){
                   echo "1";
               }
           }
       }
        if($_GET["action"] == "logout"){
            session_unset();
        }
    }
?>