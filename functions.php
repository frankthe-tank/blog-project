<?php

    session_start();
    $username=$_SESSION['username'];

    if($username!='admin')
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('You do not have permission to access this page');
    window.location.href='loggedin.php';
    </script>");

?>

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
        <form method="post">
        <h1>Choose option</h1>  
        <input type="submit" name="mostBlog" class="btn" value="Users with most blogs on 5/4/22!"/>
        <!--example hobby pairs-->
        <input type="submit" name="sharedHobby" value="Shared Hobby" class="btn" />
        <input type="submit" name="neverPosted" class="btn" value="Never posted a blog!"/>
        <input type="submit" name="neverComment" value="Never Commented!" class="btn"/>
        <input type="submit" name="onlyNegative" class="btn" value="Users only comment negative!"/>
        <input type="submit" name="noNegative" class="btn" value="Users with only positive!"/>

        </form>
    </div> 
    
    <?php 
    //tables will be displayed here        
            $host = "127.0.0.1:3308";  
            $user = "user";  
            $password = "pass";  
            $db_name = "comp440project";  
     
            $con = mysqli_connect($host, $user, $password, $db_name);  
            if(mysqli_connect_errno()) {  
                die("Failed to connect with MySQL: ". mysqli_connect_error());  
            }
            
            //if shared hobby is clicked
            if(isset($_POST['sharedHobby'])){
                $sql="select p1.username as person1, p2.username as person2, p1.hobbies as hobby
                from
                (
                  select username, group_concat(hobby order by hobby) as hobbies
                  from hobby
                  group by username
                ) p1
                join
                (
                  select username, group_concat(hobby order by hobby) as hobbies
                  from hobby
                  group by username
                ) p2 on p2.username > p1.username and p2.hobbies = p1.hobbies
                order by person1, person2;";
                $result = mysqli_query($con, $sql);
                echo "<table style='width:100%'>
                <tr>
                    <td><b>user 1</b></td>
                    <td><b>user 2</b></td>
                    <td><b>hobby</b></td>
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['person1'] . "</td>";
                    echo "<td>" . $row['person2'] . "</td>";
                    echo "<td>" . $row['hobby'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                
            }
             //if followed by 2 is clicked
            else if(isset($_POST['searchFollow'])){
                $user1 = $_POST['user1'];  
                $user2 = $_POST['user2'];
      
                $sql="select p1.following as theyfollow from(
                    select username,  following
                    from follow
                    where username='".$user1."'
                )p1
                join
                  (
                    select username, following
                    from follow
                    where username='".$user2."'
                    
                  ) p2 on  p2.following = p1.following;";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto;
                margin-right: auto;'>
                <tr>
                    <td><b>Users followed by: ".$user1." AND ".$user2."</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['theyfollow'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            //if never posted a blog
            else if(isset($_POST['neverPosted'])){
                $sql = "select username as neverPosted
                        from user
                        where username not in (select distinct username from blog);";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto; margin-right: auto;'>
                <tr>
                    <td><b>user</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['neverPosted'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            //if never commented
            else if(isset($_POST['neverComment'])){
                $sql = "select username as neverComment 
                        from user
                        where username not in (select distinct username from comment);";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto; margin-right: auto;'>
                <tr>
                    <td><b>user</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['neverComment'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else if(isset($_POST['onlyNegative'])){
                $sql = "select distinct username as onlyNegative
                        from comment
                        where sentiment = 'Negative' and username not in (select distinct username 
                                                                          from comment 
                                                                          where sentiment = 'Positive');";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto; margin-right: auto;'>
                <tr>
                    <td><b>user</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['onlyNegative'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else if(isset($_POST['noNegative'])){
                $sql = "select distinct username as noNegative
                        from blog
                        where username not in (select distinct B.username
                                               from blog as B, comment as C
                                               where B.blogID = C.blogID and sentiment = 'Negative');";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto; margin-right: auto;'>
                <tr>
                    <td><b>user</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['noNegative'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else if(isset($_POST['twotags'])){ 
                $tag1 = $_POST['tag1'];  
                $tag2 = $_POST['tag2'];
      
                $sql="SELECT username
                FROM blog
                WHERE blogID IN (SELECT blogID
                            FROM tag
                            WHERE tag = '".$tag1."')
                AND blogID IN (SELECT blogID
                            FROM tag
                            WHERE tag = '".$tag2."')
                GROUP BY username
                HAVING COUNT(username) >= 2;";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto;
                margin-right: auto;'>
                <tr>
                    <td><b>Users who posted with tags: ".$tag1." AND ".$tag2."</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else if(isset($_POST['mostBlog'])){
                $sql="SELECT username
                FROM blog
                WHERE p_date = '05-04-22'
                GROUP BY username
                HAVING COUNT(username) = (SELECT MAX(largest) as highest
                                        FROM (SELECT COUNT(username) AS largest
                                            FROM blog
                                            WHERE p_date = '05-04-22'
                                            GROUP BY username) 
                                            AS table1);";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto;
                margin-right: auto;'>
                <tr>
                    <td><b>Here are the users with the most blogs on 5/4/22</b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

            }
            else if(isset($_POST['create'])){ 
                $username = $_POST['Subject'];  
                
      
                $sql="SELECT *
                FROM comp440project.blog
                WHERE username = '".$username."' AND blogID IN (SELECT blogID
                                                        FROM comp440project.comment)
                                                        AND blogID NOT IN (SELECT blogID
                                                                        FROM comp440project.comment
                                                                        WHERE sentiment = 'Negative');";
                $result = mysqli_query($con, $sql);
                echo "<table style='margin-left: auto;
                margin-right: auto;'>
                <tr>
                    <td><b>Blog ID </b></td>
                    <td><b>".$username." </b></td>
                    <td><b>Subject </b></td>
                    <td><b>Description </b></td>
                    <td><b>Date </b></td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['blogID'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['subject'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['p_date'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?> 

    <div id='frm'>
    <p><b> Search blogs by user who has received only positive reviews!</b></p>  
        <form name="" action = "" onsubmit = "" method = "POST">  
            <p>  
                <label> Enter user's name: </label>  
                <input type = "text" id ="Subject" name  = "Subject" required/>  
            </p>    
            <p>     
                <input type =  "submit" id = "btn" name= create value = "VIEW" />  
            </p>  
        </form>

    </div>
    </div>
    <div id='frm'>
        <p><b>Search for users who posted two blogs with selected tags!</b></p>  
        <form method = "POST">  
            <p>  
                <label> User 1: </label>  
                <input type = "text" id ="tag1" name  = "tag1" required/>  
            </p>    
            <p>  
                <label> User 2: </label>  
                <input type = "text" id ="tag2" name  = "tag2" required />  
            </p>


            <p>     
                <input type =  "submit" id = "btn" name= "twotags" value = "VIEW" />  
            </p>  
        </form>
        
    </div>

    <div id='frm'>
        <p><b>Search for people followed by these two users!</b></p>  
        <form method = "POST">  
            <p>  
                <label> User 1: </label>  
                <input type = "text" id ="user1" name  = "user1" required/>  
            </p>    
            <p>  
                <label> User 2: </label>  
                <input type = "text" id ="user2" name  = "user2" required />  
            </p>


            <p>     
                <input type =  "submit" id = "btn" name= "searchFollow" value = "VIEW" />  
            </p>  
        </form>
        
    </div>
   
    
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