<html>  
    <!--gotten from https://www.javatpoint.com/php-mysql-login-system-->
<head>  
    <title>PHP login system</title>  
     <!--insert style.css file inside index.html-->  
    <link rel = "stylesheet" type = "text/css" href = "style.css"> 
    <?php
        session_start();
        session_destroy();
    ?>  
</head>  
<body>  
    <div id = "frm">  
        <h1>Login</h1>  
        <form name="f1" action = "authentication.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> UserName: </label>  
                <input type = "text" id ="user" name  = "user" />  
            </p>  
            <p>  
                <label> Password: </label>  
                <input type = "password" id ="pass" name  = "pass" />  
            </p>  
            <p>     
                <input type =  "submit" id = "btn" value = "Login" />  
            </p>  
        </form>  
    </div>  
    <div id = "frm">
    <form action="newUser.php">
        <input type="submit" id="btn" value="New user?" />
    </form>
    </div>
    <div id = "frm">
        <form action="init.php">
            <input type="submit" id="btn" value="Initialize Database" />
        </form>
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