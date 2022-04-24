<html>
    <head>  
        <title>New Post</title>  
         <!--insert style.css file inside index.html-->  
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <nav class="display">
            <a href="loggedin.php" class="navhead">Home</a>
            <a href="newPost.php" class="navhead">Make A Post!</a>
            <a href="functions.php" class="navhead">ADMIN ONLY</a>
            <a href="index.php" class="navhead">Logout</a>
        </nav>   
    </head> 
    <body>
    <div id = "frm">  
        <h1>Enter data</h1>  
        <form name="f1" action = "newPost.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> Subject: </label>  
                <input type = "text" id ="Subject" name  = "Subject" required/>  
            </p>  
            <p>  
                <label > Description: </label>  
                <textarea type = "text" id ="Description" name  = "Description" rows="4" cols="25" required ></textarea> 
            </p>  
            <p>  
                <label> Tags: </label>  
                <input type = "text" id ="Tags" name  = "Tags" required />  
            </p>


            <p>     
                <input type =  "submit" id = "btn" name= create value = "Register" />  
            </p>  
        </form>  
    </div> 
    <div>
        <?php 
            if(isset($_POST['create'])){
                 
                $host = "127.0.0.1:3308";  
                $user = "user";  
                $password = "pass";  
                $db_name = "comp440project";  
     
                $con = mysqli_connect($host, $user, $password, $db_name);  
                if(mysqli_connect_errno()) {  
                    die("Failed to connect with MySQL: ". mysqli_connect_error());  
                }  
                session_start();
                $username=$_SESSION['username'];
                  
                $subject = $_POST['Subject']; 
                $description = $_POST['Description'];  
            
                $date=date("m-d-y");
                  
                 
      ///stopped here
                //to prevent from mysqli injection    
                $subject = stripcslashes($subject); 
                $description = stripcslashes($description);  
                //$tags = stripcslashes($tags);  

                $description = mysqli_real_escape_string($con, $description);  
                $subject = mysqli_real_escape_string($con, $subject);  
                //$tags = mysqli_real_escape_string($con, $tags);  


                $sql = "SELECT * FROM user WHERE username = '$username' ";  
                $result = mysqli_query($con, $sql);  
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                $count = mysqli_num_rows($result);
                $blogcount=0;

                $sqlnumcount="SELECT * FROM blog WHERE username='$username' AND p_date='$date'";
                $countresult=mysqli_query($con,$sqlnumcount);
                
                if($countresult){
                    $blogcount=mysqli_num_rows($countresult);
                }
                else{
                    $blogcount=0;
                }

                if($count==1 && $blogcount<2){
                    //how to insert with auto incramenting key
                    $sql = "INSERT INTO blog (blogID, username, subject, description, p_date)
                            VALUES (DEFAULT,'$username', '$subject', '$description','$date')";
                    /*$get_blogID="SELECT blogID FROM blog
                                WHERE username='$username' AND subject='$subject' ";
                    $resultblog=$con->query($get_blogID);*/
                    //$blogid=$resultblog->fetch_array()['blogID'] ?? '';
                    $splitted = explode(",", $_POST['Tags']);
                    $totaltag=count($splitted);

                    // grab blogid and for "," count insert into tag
                    if ($con->query($sql) === TRUE) {
                        
                        for($x=0;$x<$totaltag;$x++){
                        $query="INSERT INTO tag (blogID, tag)
                        VALUES((SELECT blogID from blog
                        where username='$username' AND subject='$subject'),'".$splitted[$x]."')";
                        $result=$con->query($query);
                        }


                        echo ("<script LANGUAGE='JavaScript'>
                         window.alert('Blog added!');
                        window.location.href='loggedin.php';
                        </script>");
                      } 
                      else {
                        echo "Error: " . $sql . "<br>" . $con->error;
                      }
                }
                
                else{
                    echo ("<script LANGUAGE='JavaScript'>
                         window.alert('Error Occured, may not be logged in or you may have posted 2 blogs today.');
                        </script>");
                }
                
                
            }
        ?>
    </div>
    <script>  
            function validation()  
            {  
                var sub=document.f1.Subject.value;  
                var des=document.f1.Description.value;
                var tag=document.f1.Tags.value;
                if(sub.length=="" && des.length=="" && tag.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(sub.length=="") {  
                        alert("Subject is empty.");  
                        return false;  
                    }   
                    if (des.length=="") {  
                    alert("Description field is empty.");  
                    return false;  
                    }  
                    if (tag.length=="") {  
                    alert("Tag is empty.");  
                    return false;  
                    }  
                }                             
            }  
        </script> 
    </body>
</html>