<?php
    
    session_start();
    $link = mysqli_connect("localhost","cl38-twitter-ifw","JBUm!KdnM","cl38-twitter-ifw");
    if(mysqli_connect_error()){
        die("there aws an error connecting to database");
    }

    function displayTweets($type){
        global $link;
        $whereClause="";
        if($type == "public"){
            $whereClause="";

        }else if($type == "isFollowing"){
            //current user: $_SESSION["id"] 
            $query = "select * from isFollowing where follower = ".$_SESSION["id"];
            if($result = mysqli_query($link, $query)){
                while($row = mysqli_fetch_assoc($result)){
                    //$row["isFollowing"]
                    if($whereClause == "") 
                        $whereClause=" where ";
                    else 
                        $whereClause .= " OR ";
                    $whereClause .= "userid=".$row["isFollowing"];
                }
            }
        }else if($type == "yourtweets"){
            $whereClause ="where userid = ". $_SESSION["id"];
        }else if($type == "search"){
            $whereClause ="where tweet like '%".$_GET["query"]."%'";
        }else if(is_numeric($type)){
            $whereClause = "where userid = ".$type;
        }
            $query = "select * from tweets ".$whereClause." order by datetime DESC  ";
//            echo $query;
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) != 0){
                while($row = mysqli_fetch_array($result)){
                    //$row["tweet"]  $row["datetime"] $row["userid"]
                    $userid = $row["userid"]; 
                    $query2 = "select * from users where id = '$userid' limit 1";
                    $row2 = mysqli_fetch_array(mysqli_query($link, $query2));
                    //$row2["email"]
                    echo "<div class='tweets'><p><a href='index.php?page=publicprofiles&userid=".$userid." '>".$row2['email']."</a> <span class='time'>".time_since(time() - strtotime($row['datetime']))." ago:</span></p><p>".$row['tweet']."</p>"
                        ."<p>
                        <a class='toggleFollow' data-userId='$userid' href='#'>";
                    $query3 ="select * from isFollowing where follower= ".$_SESSION["id"]
                        ." and isFollowing= ".$row["userid"];
                    if($result3=mysqli_query($link, $query3)){
                        if(mysqli_num_rows($result3) == 0){
                            echo "Follow";
                        }else{
                            echo "UnFollow";
                        }
                    }
                    echo "</a>
                        </p>".
                        "</div>";
                }
            }
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displaySearch(){
        echo "<form class='form-inline'>
          <label class='sr-only' for='inlineFormInput'>Name</label>
          <input type='hidden' name='page' value='search'>
          <input type='text' name='query' class='form-control mb-2 mr-sm-2 mb-sm-0' id='inlineFormInput' placeholder='search'>
          <button type='submit' class='btn btn-primary'>Search Tweets</button>
        </form>
          <hr>";
    }
    function displayTweetBox(){
        if($_SESSION["id"]>0){
            echo "<div class='alert alert-success' role='alert' id='postSuccAlert' style='display:none'></div>";
            echo "<div class='alert alert-danger' role='alert' id='postFailAlert' style='display:none'></div>";
            echo "<div class='form-group'>
                        <textarea class='form-control' id='exampleTextarea' rows='3'></textarea>
                          <button type='submit' class='btn btn-primary' id='postTweets'>Post Tweets</button>
                </div>";
        }
    }
    function displayActiveUsers(){
        if($_SESSION["id"]>0){
            global $link;
            $query = "select * from users limit 10";
            $result = mysqli_query($link, $query);
            while($row = mysqli_fetch_array($result)){
                echo "<p><a href='index.php?page=publicprofiles&userid=".$row["id"]."'>".$row["email"]."</a></p>";
            }
            
        }
    }

 
?>