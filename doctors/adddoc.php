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
    if(empty($name) or empty($pass) or empty($email) or empty($level)  ){
        $fail = "Please fill all inputs";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fail = "Invalid email format";
      }
    else if(strlen($pass) < 8){
        $fail = "Password should be at least 8 chararcters";
      }
    else{
        $suc = "Data recorded successfully";
        $sql = "INSERT INTO doctor (name , `level` , pass , email) VALUES('$name' , $level , '$pass' ,'$email' )";
        mysqli_query($conn , $sql);
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
    
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Doctor Name">
    
  </div>
  <br>
  <div class="form-group">
   
    <input type="number" name="level" class="form-control" id="exampleInputPassword1" placeholder="Level">
  </div>
  <br>
  <div class="form-group">
   
    <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
  </div>
  <br>
  <div class="form-group">
   
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <br>

  <button type="submit" name="add" class="btn btn-primary">Register</button>
</form>
  </main>
<?php
include '../shared/bottom.php'
?>