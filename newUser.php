<html>  
    <!--gotten from https://www.javatpoint.com/php-mysql-login-system-->
<head>  
    <title>new user</title>  
     <!--insert style.css file inside index.html-->  
    <link rel = "stylesheet" type = "text/css" href = "style.css">   
</head>  
<body>  
    <div id = "frm">  
        <h1>Enter data</h1>  
        <form name="f1" action = "newUser.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> UserName: </label>  
                <input type = "text" id ="user" name  = "user" required/>  
            </p>  
            <p>  
                <label> Password: </label>  
                <input type = "password" id ="pass" name  = "pass" required />  
            </p>  
            <p>  
                <label> First name: </label>  
                <input type = "text" id ="fName" name  = "fName" required />  
            </p>
            <p>  
                <label> Last Name: </label>  
                <input type = "text" id ="lName" name  = "lName" required />  
            </p>
            <p>  
                <label> Email: <br></label>  
                <input type = "Email" id ="email" name  = "email" required />  
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
                $username = $_POST['user'];  
                $password = $_POST['pass']; 
                $fName = $_POST['fName'];  
                $lName = $_POST['lName']; 
                $email = $_POST['email'];  
                 
      
                //to prevent from mysqli injection  
                $username = stripcslashes($username);  
                $password = stripcslashes($password);  
                $username = mysqli_real_escape_string($con, $username);  
                $password = mysqli_real_escape_string($con, $password);  
      
                $sql = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";  
                $result = mysqli_query($con, $sql);  
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                $count = mysqli_num_rows($result);
                
                if($count==0){
                    $sql = "INSERT INTO user (username, password, firstName, lastName, email)
                            VALUES ('$username', '$password', '$fName','$lName','$email')";
                    if ($con->query($sql) === TRUE) {
                        echo ("<script LANGUAGE='JavaScript'>
                         window.alert('User Created!');
                        window.location.href='index.php';
                        </script>");
                      } 
                      else {
                        echo "Error: " . $sql . "<br>" . $con->error;
                      }
                }
                else{
                    echo ("<script LANGUAGE='JavaScript'>
                         window.alert('User or email taken!');
                        </script>");
                }
            }

        ?>
    </div>
    
    <!-- validation for empty field -->  
    <script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
</body>     
</html> 