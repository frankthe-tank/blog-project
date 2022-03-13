<?php      
    $host = "localhost";  
    $user = "root";  
    $password = 'Faa!122518P03';  
    $db_name = "databaseproject";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>  