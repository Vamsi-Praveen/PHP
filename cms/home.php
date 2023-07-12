<?php
    include('db_config.php');
    include('functions.php');
    $query = "select * from users";
    $result = mysqli_query($sql_conn,$query);
    session_start();
    if(!((isset($_SESSION['username'])) && (isset($_SESSION['password'])))){
      header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
  <h3 class="m-2 mb-1">Logged in:  <span><?=$_SESSION['username']?></span></h3>
    <button class="btn btn-danger m-3 mb-2 shadow-none"><a href="./logout.php" style="text-decoration:none;color:#fff;">LOGOUT</a></button>
    <?php
      $user_id = (int)$_SESSION['id'];
      $query_new = "select * from users where id=$user_id;";
      $result_new = mysqli_query($sql_conn,$query_new);
      $fetched_data = mysqli_fetch_assoc($result_new);
      if($fetched_data['is_admin']==1){
        echo '<button type="button" class="btn btn-success shadow-none mt-2"><a class="text-decoration-none text-white" href="add_user.php">ADD USER</a></button>';
      }
      else{
        echo '<button type="button" class="btn btn-success shadow-none mt-2" disabled><a class="text-decoration-none text-white" href="add_user.php">ADD USER</a></button>';
      }
    ?>
    <!-- <button  type="button" class="btn btn-success shadow-none mt-2"><a class="text-decoration-none text-white" href="add_user.php">ADD USER</a></button> -->
    <div class="container shadow-sm text-center p-3 mt-4 rounded bg-white">
        <table class="table table-striped table-md align-middle text-wrap">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">USERNAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col">ACTIONS</th>
              <th scope="col">STATUS</th>
              <th scope="col">-</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
                <?php
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['username']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['password']?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit.php?id=<?php echo encrypt_data($row['id'])?>">EDIT</a>
                        <a class="btn btn-danger btn-sm"  href="delete.php?id=<?php echo encrypt_data($row['id'])?>">DELETE</a>
                    </td>
                    <td>
                      <?php
                      $is_admin=0;
                        if($row['status']==0){
                          $new_status=1;
                        }
                        else{
                          $new_status=0;
                        }
                        if($row['is_admin']==1){
                          $is_admin=1;
                        }
                      ?>
                      <a class="btn btn-<?php echo $row['status']=='0'?"success":"danger";?> btn-sm" href="set_status.php?id=<?php echo base64_encode($row['id'])?>&status=<?php echo base64_encode($new_status);?>"><?php echo $row['status']=='0'?"Enable":"Disable"?></a>
                    </td>
                    <td>
                      <script>
                         var data_Send = <?php echo(json_encode($row['id']));?>;
                      </script>
                      <button onclick="make_admin(data_Send)" class="btn btn-<?php echo $row['is_admin']=='0'?"primary":"dark";?> btn-sm" ><?php echo $row['is_admin']=='0'?"Make Admin":"Disable Admin"?></button>
                    </td>
      
            </tr>
                <?php
                    }
                ?>
          </tbody>
        </table>
    </div>
    <script src="functions.js"></script>
</body>
</html>