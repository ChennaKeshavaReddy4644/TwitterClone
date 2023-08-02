<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body style="background:url('back.jpg');background-repeat:repeat;background-position:top;z-index:-10;">
<h1 style="z-index:105;position:fixed;top:0%;left:45%;text-transform:uppercase;color:deepskyblue;"><i class="fa fa-twitter" aria-hidden="true" style="width:55px;z-index:105;position:fixed;top:30px;left:45%;font-size:50px;"></i></h1>
    <div style="position:fixed;top:0;left:0;width:100%;height:100px;background:white;z-index:90;"></div>
<a href="home.php" style="z-index:105;position:fixed;top:30px;right:400px;font-size:40px;color:black;text-transform:uppercase;text-decoration:none;padding:5px;"><i class="fa fa-home" aria-hidden="true"></i></a>
<a href="search.php" style="z-index:105;color:black;"><i class="fa fa-search" aria-hidden="true" style="width:40px;z-index:105;position:fixed;top:38px;right:315px;font-size:40px;"></i></a>
<a href="notif.php" style="z-index:105;position:fixed;top:30px;right:220px;font-size:40px;color:black;text-transform:uppercase;text-decoration:none;padding:5px;"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
<a href="tweets.php" style="z-index:105;color:deepskyblue;"><i class="fa fa-envelope-o" aria-hidden="true" style="width:40px;z-index:105;position:fixed;top:38px;right:130px;font-size:40px;"></i></a>
    
    <?php
    session_start();
    $fname=$_SESSION["name"];
    $conn=mysqli_connect("localhost","root","","tweet") or die("connection failed");
    $query="select * from userpost where pname='$fname' order by pid desc";
    $run=mysqli_query($conn,$query);
    $query1="select * from tusers where uname='$fname'";
    $run1=mysqli_query($conn,$query1);
    $row1=mysqli_fetch_assoc($run1);
    while($row=mysqli_fetch_assoc($run)){
        $name=$row["pname"];
        $pic=$row1["pic"];
        $about=$row["post"];
        $photo=$row["img"];
        $t=$row["time"];
        $query2="select * from likes where lname='$fname' and topic='$about'";
        $run2=mysqli_query($conn,$query2);
        $nl=mysqli_num_rows($run2);
        $query3="select * from comments where cname='$fname' and topic='$about'";
        $run3=mysqli_query($conn,$query3);
        $nc=mysqli_num_rows($run3);
        $query4="select * from comments where cname='$name' and topic='$about'";
        $run4=mysqli_query($conn,$query4);
        $nic=mysqli_num_rows($run4);
        $query5="select * from likes where lname='$name' and topic='$about'";
        $run5=mysqli_query($conn,$query5);
        $nil=mysqli_num_rows($run5);
        $query6="select * from tusers where uname='$name'";
        echo "<div style='margin:115px 0px -109px 50px;width:400px;height:290px;background:white;opacity:1;border:1px solid black;border-radius:10px;'>";
        echo "<a href='$pic'><img src='$pic' style='width:50px;height:50px;border-radius:50%;padding:5px;'></a>";
        echo "<h2 style='margin:-60px 0px 0px 70px;'>$name</h2>";
        echo "<h3 style='margin:10px 0px 0px 70px;'>$about</h3>";

        if($photo!="tweet/"){
        echo "<a href='$photo'><img src='$photo' style='margin:8px 0px 0px 70px;width:280px;height:130px;border:2px solid black;border-radius:20px;'></a>";
        echo "<h4 style='margin:-200px 0px 0px 250px;color:red;'>$t</h4>";
        
        }
        else if($photo=="tweet/"){
            echo "<h4 style='margin:-76px 0px 0px 250px;color:red;'>$t</h4>";
        
        }

        echo "<a><i class='fa fa-comment-o' aria-hidden='true' style='margin:200px 0px 0px 80px;color:lime;font-size:20px;'></i></a>";
          echo "<a><i class='fa fa-heart' aria-hidden='true' style='margin:180px 0px 0px 185px;color:blue;font-size:20px;'></i></a>";
          echo "<h4 style='margin:-18px 0px 50px 115px;color:black;'>$nc</h4>";
          echo "<h4 style='margin:-70px 0px 50px 320px;color:black;'>$nl</h4>";
          echo "<a href='viewcomments.php?cname=$name&topic=$about' style='text-decoration:none;'><h4 style='margin:-40px 0px 50px 80px;color:black;'>view all $nic comments</h4></a>";
          echo "<a href='viewlikes.php?lname=$name&topic=$about' style='text-decoration:none;'><h4 style='margin:-70px 0px 50px 270px;color:black;'>view all $nil likes</h4></a>";
          
        echo "</div>";
    }
    ?>
    <?php
    $name=$_SESSION['name'];
    $conn1=mysqli_connect("localhost","root","","tweet") or die("connection failed");
    $query1="select * from notifications where uname='$name' and status='0'";
    $run1=mysqli_query($conn1,$query1);
    $num_rows=mysqli_num_rows($run1);
    if($num_rows==0){
        echo "<h1 style='position:absolute;top:0;width:10px;height:10px;background:red;'></h1>";
    }
    else if($num_rows>0){
        echo "<h1 style='position:absolute;right:220px;top:12px;color:white;font-size:18px;font-weight:1000;z-index:100;width:20px;height:20px;background:red;border-radius:70%;text-align:center;'>$num_rows</h1>";
    }
    
    ?>
    
</body>
</html>