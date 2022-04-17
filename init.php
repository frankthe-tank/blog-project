<?php      
    $host = "127.0.0.1:3308";  
    $user = "user";  
    $password = "pass";  
    $db_name = "comp440project";   

    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }    
    $sql = file_get_contents('initialize_440.sql');
    $con->multi_query($sql);
    echo ("<script LANGUAGE='JavaScript'>
            window.alert('Initialization sucessful!');
           window.location.href='index.php';
           </script>");
?>  