<?php      
   $host = "127.0.0.1:3308";  
   $user = "root";  
   $password = "comp440";  
   $db_name = "comp440proj1";  
     
   $con = mysqli_connect($host, $user, $password, $db_name);  
   if(mysqli_connect_errno()) {  
       die("Failed to connect with MySQL: ". mysqli_connect_error());  
   }    
   $sql = file_get_contents('university.sql');
   $con->multi_query($sql);
   echo "<h1><center> Initialization successful </center></h1>";
?> 