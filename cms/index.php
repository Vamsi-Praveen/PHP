<?php
include('db_config.php');
include('session.php');
$status=false;
$no_login=false;
$no_user=false;
if(isset($_SESSION['username'])){
    header('location:home.php');
}
if(isset($_POST['submit'])){
    if(!empty($_POST['userid'])){
        $user = $_POST['userid'];
    }
    if(!empty($_POST['passwd']))
    {
        $password = $_POST['passwd'];
    }
    // $query = "select * from users where username='$user' and password='$password'";
    $query = "select * from users where username='$user';";
    $result = mysqli_query($sql_conn,$query);
    if(mysqli_num_rows($result)>0){
        $data=mysqli_fetch_assoc($result);
        $fetched_pass = $data['password'];
        if(password_verify($password,$fetched_pass)){
            if($data['status']==0){
                $no_login=true;
            }
            else{
                header("location:home.php");
                session_start();
                $_SESSION['username']=$user;
                $_SESSION['password']=$password;
                $_SESSION['id']=$data['id'];
                $status=false;
            }
        }
        else{
            $status=true;
        }
    }
    else{
        $no_user=true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid content-container d-flex flex-column justify-content-center align-items-center">
        <?php
            if($status==true){
                echo '
                <div class="alert alert-warning alert-dismissible fade show alert_wrong" role="alert">
                    <strong>Invalid Credentials</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
            if($no_login==true){
                echo '
                <div class="alert alert-warning alert-dismissible fade show alert_wrong" role="alert">
                    <strong>Account disabled! Contact Admin.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
            if($no_user==true){
                echo '
                <div class="alert alert-warning alert-dismissible fade show alert_wrong" role="alert">
                    <strong>No account found...!!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        ?>
        <div class="main-content d-flex ">
            <div class="left d-flex align-items-center justify-content-center">
                <h1>W<span>elcome</span></h1>
            </div>
            <div class="right d-flex justify-content-center align-items-center flex-column">
                <h3 class="head">Login</h3>
                <form method="post" class="d-flex justify-content-center align-items-center flex-column">
                    <div class="input-container">
                        <input name="userid" type="text" placeholder="Enter your UserID"  required spellcheck="false" autocomplete="off" >
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-container">
                        <input name="passwd" type="password" placeholder="Enter your Password" required spellcheck="false" autocomplete="off" >
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div class="input-container">
                        <button name="submit">Login</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>