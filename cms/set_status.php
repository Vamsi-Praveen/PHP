<?php
    include('db_config.php');
    include('functions.php');
    if(isset($_GET['id']) && isset($_GET['status'])){
        $id=(int)base64_decode($_GET['id']);
        $status=(int)base64_decode($_GET['status']);
        $query="update users set status=$status where id=$id;";
        $result = mysqli_query($sql_conn,$query);
        if($result){
            header("location:home.php");
            // echo '<script>alert("data changed")</script>';   
        }
        else{
            echo '<script>alert("ERROR OCCURED")</script>';
        }
    }

?>

