<?php
include '../shared/top.php';
include '../conn.php';
$suc = false;
$fail = false;
$name = "";
$pass = "";
$email = "";
$stat = "";
if($_SESSION['stat'] != 1){
  echo "
    <script>
    location.replace('http://127.0.0.1/niceadmin/niceadmin/index.php?');
    </script>";
}
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $stat = $_POST['stat'];
    $img = rand(0,1000).rand(0,1000).$_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $folder = "upload/" . $img;
    if(empty($name) or empty($pass) or empty($email) or empty($stat)   ){
        $fail = "Please fill all inputs";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fail = "Invalid email format";
      }
    else if(strlen($pass) < 8){
        $fail = "Password should be at least 8 chararcters";
      }
      else if($stat < 0 or $stat > 3){
        $fail = "Stat should be 1 or 2 only";
      }
    else{
        $suc = "Data recorded successfully";
        $sql = "INSERT INTO admin (name  , pass , email ,stat ,img) VALUES('$name'  , '$pass' ,'$email', $stat , '$img')";
        move_uploaded_file($tmp ,$folder);
        mysqli_query($conn , $sql);
      }
}
?>
  <main id="main" class="main">
  <form method="post" enctype= "multipart/form-data">
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
    
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Admin Name">
    
  </div>
  <br>
  <div class="form-group">
    
    <input type="file" name="img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Image">
    
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
  
  <div class="form-group">
   
    <input type="number" name="stat" class="form-control" id="exampleInputPassword1" placeholder="stat">
  </div>
  <br>
  <button type="submit" name="add" class="btn btn-primary">Register</button>
</form>
  </main>
<?php
include '../shared/bottom.php'
?>