<?php
include '../shared/top.php';
include '../conn.php';
$suc = false;
$fail = false;
$name = "";
$pass = "";
$email = "";
$level = '';
if(isset($_POST['add'])){
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
      else if(len($pass , 8 , 50) ){
        $fail = "Password should be between 8 to 50 chararcters";
      }
    else{
        $suc = "Data recorded successfully";
        $sql = "INSERT INTO doctor (name , `level` , pass , email) VALUES('$name' , $level , '$pass' ,'$email' )";
        mysqli_query($conn , $sql);
        $name = "";
$pass = "";
$email = "";
$level = '';
      }
}
?>
  <main id="main" class="main">
  <form method="post" >
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
    
    <input type="text" value="<?=$name?>"  name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Doctor Name">
    
  </div>
  <br>
  <div class="form-group">
   
    <input type="number" value="<?=$level?>" name="level" class="form-control" id="exampleInputPassword1" placeholder="Level">
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

  <button type="submit" name="add" class="btn btn-primary">Register</button>
</form>
  </main>
<?php
include '../shared/bottom.php'
?>