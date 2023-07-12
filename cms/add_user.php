<?php
    include('db_config.php');
    include('functions.php');
    session_start();
    if(!((isset($_SESSION['username'])) && (isset($_SESSION['password'])))){
      header("location:index.php");
    }
    if(isset($_POST['add_user'])){
        $user = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!empty($user) && !empty($email) && !empty($password)){
            $password_hash = password_hash($password,PASSWORD_BCRYPT);
            $query = "insert into users(username,password,email) values('$user','$password_hash','$email');";
            $result = mysqli_query($sql_conn,$query);
            if($result){
                echo '<script>alert("USER ADDED SUCCESFULLY")</script>';
                echo '<script>window.location.href="home.php";></script>';
            }
            else{
                echo '<script>alert("error")</script>';
            }
        }
        else{
            echo '<script>alert("all feilds required")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light min-vh-100 d-flex justify-content-center align-items-center">
    <div class="container bg-white my-5 w-25 rounded-3 text-center d-flex justify-content-center align-items-center flex-column">
        <form method="post" class="p-3">
            <h3 class="mb-4">ADD NEW USER</h3>
            <div class="form-floating mb-3 w-100">
                <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Username" name="username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control shadow-none" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control shadow-none" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <button  type="submit" class="btn btn-danger btn-md shadow-none m-3" name="add_user">Add User</button>
            <a href="home.php" class="text-decoration-none text-white btn btn-dark shadow-none">Close</a>
        </form>
    </div>
</body>
</html>