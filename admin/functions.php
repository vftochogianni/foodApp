<?php
include_once 'connect.php';

function fetchViews(){                          //get the number of views
    $query="SELECT * FROM views";
    $result=mysql_query($query) or ('Something went wrong');
    $row=mysql_fetch_array($result);            //get result from database
    echo $row['num'];
}

function fetchNumPosts(){                       //get the number of posts
    $query="SELECT * FROM posts";               //query to get all posts
    $result=mysql_query($query) or ('Something went wrong');
    $i=0;
    while($row=mysql_fetch_array($result)){     //count all posts
        $i++;
    }
    echo $i;
}
?>