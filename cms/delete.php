<?php
    include('db_config.php');
    include('functions.php');
    if(isset($_GET['id'])){
        $id=(int)decrypt_data($_GET['id']);
        $query="delete from users where id=$id;";
        if(mysqli_query($sql_conn,$query)){
            echo '<script>alert("deleted succesfully")</script>';
            echo '<script>window.location.href="home.php";</script>';
        }
    }



?>