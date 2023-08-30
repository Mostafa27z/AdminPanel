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
    if(validate($name) or validate($pass) or validate($email) or validate($stat)   ){
        $fail = "Please fill all inputs";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fail = "Invalid email format";
      }
      else if(!isimg($_FILES['img']['type'] , "image/jpeg" , "image/jpg" , "image/png")) {
        $fail = "please upload an image (jpeg , png , jpg)";
      }
      else if(imgSize($_FILES['img']['size'] , 1)) {
        $fail = "image cannot exceed 1 mega";
      }
    else if(len($pass , 8 , 50) ){
        $fail = "Password should be between 8 to 50 chararcters";
      }
      else if($stat < 0 or $stat > 3){
        $fail = "Stat should be 1 or 2 only";
      }
    else{
        $suc = "Data recorded successfully";
        $sql = "INSERT INTO admin (name  , pass , email ,stat ,img) VALUES('$name'  , '$pass' ,'$email', $stat , '$img')";
        move_uploaded_file($tmp ,$folder);
        mysqli_query($conn , $sql);
        $name = "";
        $pass = "";
        $email = "";
        $stat = "";
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
    
    <input type="text" value="<?=$name?>" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Admin Name">
    
  </div>
  <br>
  <div class="form-group">
    
    <input type="file"   name="img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Image">
    
  </div>
  <br>
  <div class="form-group">
    <input type="email" value="<?=$email?>"   name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
  </div>
  <br>
  <div class="form-group">
   
    <input type="password" value="<?=$pass?>" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <br>
  
  <div class="form-group">
   
    <input type="number" value="<?=$stat?>" name="stat" class="form-control" id="exampleInputPassword1" placeholder="stat">
  </div>
  <br>
  <button type="submit" name="add" class="btn btn-primary">Register</button>
</form>
  </main>
<?php
include '../shared/bottom.php'
?>