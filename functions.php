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
        <input type="submit" name="atLestTwo" class="btn" value="At least two blogs!"/>
        <input type="submit" name="mostBlog" class="btn" value="Users with most blogs on 5/1/22!"/>
        <!--example hobby pairs-->
        <input type="submit" name="sharedHobby" value="Shared Hobby" class="btn" />
        <input type="submit" name="neverComment" value="Never Commented!" class="btn"/>
        <input type="submit" name="neverPosted" class="btn" value="Never posted a blog!"/>
        <input type="submit" name="onlyNegative" class="btn" value="Users only comment negative!"/>
        <input type="submit" name="noNegative" class="btn" value="Users with only positive!"/>

        </form>
    </div> 
    <?php 
            
            //if shared hobby is clicked
            if(isset($_POST['sharedHobby'])){
                $host = "127.0.0.1:3308";  
                $user = "user";  
                $password = "pass";  
                $db_name = "comp440project";  
     
                $con = mysqli_connect($host, $user, $password, $db_name);  
                if(mysqli_connect_errno()) {  
                    die("Failed to connect with MySQL: ". mysqli_connect_error());  
                } 

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
            else if(isset($_POST['neverComment'])){
                echo "<table style='width:100%'>
                <tr>
                    <td>user</td>
                    
                </tr></table>";
            }
        ?> 

    <div id='frm'>
    <p><b> blogs by user who has received no negative reviews!</b></p>  
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
    <div id='frm'>
        <p><b>Search for people followed by these two users!</b></p>  
        <form name="f1" action = "newPost.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> User 1: </label>  
                <input type = "text" id ="Subject" name  = "Subject" required/>  
            </p>    
            <p>  
                <label> User 2: </label>  
                <input type = "text" id ="Tags" name  = "Tags" required />  
            </p>


            <p>     
                <input type =  "submit" id = "btn" name= create value = "VIEW" />  
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