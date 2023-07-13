<?php
    /*for msql connection we need four paramater
        1.server_address->localhost/127.0.0.1
            if mysql port changed then 127.0.0.1:port example 127.0.0.1:3307
        2.username of database ->root
        3.password of database
        4.database name


    for connecting into mysql database we have mysql_connect_method    
    */
    /* define is used for declaring constant varibales*/
    define($server_address,'127.0.0.1');
    define($username,'root');
    define($password,'');
    define($database,''); //database name here
    $con= mysql_connect($server_address,$username,$password,$database);
    //checking conection is established or not
    if($con){
        echo('Connected to database succesfull');
        //after connection success we have to proceed;
        //simply we need to insert into some data into mysql databse
        //in our database we have a table named "USERS" it consits of columns username,password
        //we will use this query to insert the user details in USERS TABLE
        //let us declare a two variable
        $user='Ramya';
        $passwd='ramyasri';
        //for inserting into databse we need to run a querry;
        $query="insert into users values('$user','$passwd');";
        //we need to execute query by mysql_query() it takes 2 paramters one is connection and query
        $result = mysql_query($con,$query);
        if($result) //checking if executed or not
        {
            echo 'inserted';
        }
        else{
            echo 'failed';
        }
    }
    else{
        echo('failed to connect');
    }




?>