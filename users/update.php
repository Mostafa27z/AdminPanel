<?php
include '../shared/top.php';
include '../conn.php';

$name = "";
$pass = "";

$email = '';
$doc = '';

if(isset($_GET['up'])){

  $id = $_GET['up']; 
  $suc = false;
  $fail = false;
  $sql = "SELECT * FROM users where id =$id ";
  $doc = mysqli_fetch_assoc( mysqli_query($conn , $sql));
  $name = $doc['name'];
  $pass =$doc['pass'];
  $email = $doc['email'];
  if(isset($_POST['update'])){
    $name = $_POST['name'];
    $pass =$_POST['pass'];
    $email = $_POST['email'];
    if(validate($name) or validate($pass) or validate($email)  ){
      $fail = "Please fill all inputs";
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $fail = "Invalid email format";
    }
  else if(len($pass , 8 , 50)){
      $fail = "Password should be at least 8 chararcters";
    }
  else{
    $update = "UPDATE users SET name = '$name'  , email='$email' , pass = '$pass' where id =$id ";
    mysqli_query($conn , $update);
    echo "<script>location.replace('list.php?');</script>";
    }
    

  }
}
else{
  echo "<script>location.replace('list.php?');</script>";
}
?>
  <main id="main" class="main">
  <form method="post" action= "" >
    
  <?php
    if($suc):
    ?>
    <div class="alert alert-success"><?=$suc?></div>
    <?php
        elseif($fail):  
    ?>
    <div class="alert alert-danger"><?=$fail?></div>
    <?php endif; ?>
  <div class="form-group">
    
    <input type="text" value="<?=$name?>" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Doctor Name">
    
  </div>
  
  <br>
  <div class="form-group">
   
    <input type="email" value="<?=$email?>" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
  </div>
  <br>
  <div class="form-group">
   
    <input type="password" value="<?=$pass?>" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <br>

  <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>
  </main>
<?php
include '../shared/bottom.php'
?>