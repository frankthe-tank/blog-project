<html>
    <head>  
        <title>Welcome</title>  
         <!--insert style.css file inside index.html-->  
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <nav class="display">
            <a href="loggedin.php" class="navhead">Home</a>
            <a href="newPost.php" class="navhead">Make A Post!</a>
            <a href="functions.php" class="navhead">Part 3</a>
            <a href="http://127.0.0.1:8080/440%20project/professor%20didnt%20use/index.php" class="navhead">Logout</a>
        </nav>   
    </head> 
    <body>
    <h1 style="padding-top:60px;padding-bottom:0;"><center>Welcome <?php
        session_start();
        $username=$_SESSION['username'];
        echo $username;
        ?>! </center></h1>
    <?php
        
        
        $host = "127.0.0.1:3308";  
        $user = "user";  
        $password = "pass";  
        $db_name = "comp440project";  

        $con = mysqli_connect($host, $user, $password, $db_name); 
        

        $sql="SELECT * FROM blog ORDER BY blogID DESC";
        $result = mysqli_query($con, $sql); 
        
        

        echo "<br>";
        echo "<table border='1'>";
        while ($row = mysqli_fetch_assoc($result)) { 
            $sqltag="SELECT * FROM tag WHERE ".$row['blogID']." = blogID";
            $tagresult=mysqli_query($con,$sqltag);
            //getting comments
            $sqlcomnum="SELECT COUNT(*) FROM comment WHERE".$row['blogID']."= blogID";
            $sqlcomm="SELECT * FROM comment WHERE ".$row['blogID']."= blogID";
            
            $commresult=mysqli_query($con,$sqlcomm);

            if($commresult)
                $totalcom=mysqli_num_rows($commresult);
            else
                $totalcom=0;
            

           echo("<div class='card'>");
           echo("<h2>".$row['subject']."</h2>
                <h3>By User: ".$row['username']."</h3>
                <h5>Created on: ".$row['p_date']."</h5>
                <p>".$row['description']."</p><p><b>TAGS: </b>");

            while($tagrow=mysqli_fetch_assoc($tagresult)){
                echo($tagrow['tag'].",");
            }  
            if($totalcom>=1){  
            echo("<h3>Comments</h3>");
            while($comrow=mysqli_fetch_assoc($commresult)){
                echo("<div><h5>From user: ".$comrow['username']."</h5>
                <h5>Date: ".$comrow['c_date']."     Response: ".$comrow['sentiment']."</h5>
                <p>description: ".$comrow['description']."</p>
                </div>");
            }
        }
           echo("</p><form action=comment.php method = 'POST'>
                    <label for='comment'>Comment:</label><br>
                    <input type='text'  name='comments' ><br>
                    <label for='Rating'>Select a rating for the blog.</label>
                        <select  name='rating'>
                            <option value='Positive'>Positive</option>
                            <option value='Negative'>Negative</option>
                        </select>
                        <input type='hidden'  name='blogId' value=".$row['blogID']."/>
                    <input type =  'submit' id = 'btn' name= 'create' value = 'Post Comment' />
                    
                </form>");

            
            echo "</div><br>";
        }
        
    ?>
    <div>

    </div>
    </body>
</html>