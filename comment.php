<?php
        $host = "127.0.0.1:3308";  
        $user = "user";  
        $password = "pass";  
        $db_name = "comp440project";  

        $con = mysqli_connect($host, $user, $password, $db_name); 
        
            session_start();
            $username=$_SESSION['username'];
            
            $comment=$_POST['comments'];
            $rating=$_POST['rating'];
            $blog=$_POST['blogId'];
            $date=date("m-d-y");
            $commentnum=0;
            $postedonblog=0;

            $sqlcomment="INSERT INTO comment (commentID, username, description, sentiment, c_date, blogID)
            VALUES (DEFAULT, '$username','$comment','$rating','$date',(SELECT blogID from blog
                        where blogID='$blog'))";
            $sqlcommentnum="SELECT * FROM comment WHERE '".$date."'=c_date AND username='".$username."'";
            $sqlcommblog="SELECT * FROM comment WHERE '".$blog."' = blogID AND '".$username."'=username";

            $commresult=mysqli_query($con,$sqlcommentnum);
            $comblogres=mysqli_query($con,$sqlcommblog);

            if($commresult)
                $commentnum=mysqli_num_rows($commresult);
            else
                $commentnum=0;
            
            if($comblogres)
                $postedonblog=mysqli_num_rows($comblogres);
            else
                $postedonblog=0;

            if($commentnum<=3 && $postedonblog==0){
            $query=mysqli_query($con,$sqlcomment);
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Comment added!');
           window.location.href='loggedin.php';
           </script>");
            }
            elseif($commentnum>3){
                echo ("<script LANGUAGE='JavaScript'>
            window.alert('You posted your max comments for the day!');
           window.location.href='loggedin.php';
           </script>");
            }
            elseif($postedonblog==1){
                echo ("<script LANGUAGE='JavaScript'>
            window.alert('Max Comments on blog!');
           window.location.href='loggedin.php';
           </script>");
            }

?>