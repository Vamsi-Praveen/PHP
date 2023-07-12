<?php
     $server_addr = '127.0.0.1:3307';
     $user = 'root';
     $passwd = '';
     $db_name = 'php';
 
     $sql_conn = mysqli_connect($server_addr,$user,$passwd,$db_name);
 
     if(!$sql_conn){
        echo mysqli_errno($sql_conn);
     }


?>