<?php      
   $host = "127.0.0.1:3308";  
   $user = "user";  
   $password = "pass";  
   $db_name = "comp440project";  
     
   $con = mysqli_connect($host, $user, $password, $db_name);  
   if(mysqli_connect_errno()) {  
       die("Failed to connect with MySQL: ". mysqli_connect_error());  
   }    
   session_start();
    $_SESSION['username'] = $_POST['user'];  
    $password = $_POST['pass'];  
    $username=$_SESSION['username'];
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<h1><center> Welcome " .$username." </center></h1>";  
            
            header('Location: loggedin.php',true,301);
            exit();
        }  
        else{             
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('wrong info');
            window.location.href='index.php';
            </script>");   
        }     
?> 