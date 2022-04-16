<?php      
    $host = "127.0.0.1:3308";  
    $user = "user";  
    $password = "pass";  
    $db_name = "comp440project";   
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>  