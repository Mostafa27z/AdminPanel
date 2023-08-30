<?php
include '../shared/top.php';
include '../conn.php';
$suc = false;
$fail = false;
$name = "";
$pass = "";
$email = "";
$level = '';
$doc = '';
if(isset($_GET['up'])){

  $id = $_GET['up']; 
  
  $sql = "SELECT * FROM doctor where id =$id ";
  $doc = mysqli_fetch_assoc( mysqli_query($conn , $sql));
  $name = $doc['name'];
  $pass =$doc['pass'];
  $email = $doc['email'];
  $level = $doc['level'];
  if(isset($_POST['update'])){
    $name = $_POST['name'];
  $pass = $_POST['pass'];
  $email = $_POST['email'];
  $level = $_POST['level'];
  if(validate($name) or validate($pass) or validate($email) or validate($level)  ){
    $fail = "Please fill all inputs";
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fail = "Invalid email format";
  }
  else if( len($pass , 8 , 50) ){
    $fail = "Password should be between 8 to 50 chararcters";
  }
  else{
    $update = "UPDATE doctor SET name = '$name' , `level` = $level , email='$email' , pass = '$pass' where id =$id ";
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
    
    <input type="text" value="<?=$name?>" name="name" class="form-control"  aria-describedby="emailHelp" placeholder="Doctor Name">
    
  </div>
  <br>
  <div class="form-group">
   
    <input type="number" value="<?=$level?>" name="level" class="form-control"  placeholder="Level">
  </div>
  <br>
  <div class="form-group">
   
    <input type="email" value="<?=$email?>" name="email" class="form-control"  placeholder="Email">
  </div>
  <br>
  <div class="form-group">
   
    <input type="password" value="<?=$pass?>" name="pass" class="form-control" placeholder="Password">
  </div>
  <br>

  <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>
  </main>
<?php
include '../shared/bottom.php'
?>