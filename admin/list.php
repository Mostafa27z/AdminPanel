<?php
include '../shared/top.php';
include '../conn.php';
$sql= "SELECT * FROM `admin`";
$data = mysqli_query ($conn , $sql);
if($_SESSION['stat'] != 1){
  echo "
    <script>
    location.replace('http://127.0.0.1/niceadmin/niceadmin/index.php?');
    </script>";
}
if(isset($_GET['del'])){
    $did = $_GET['del'];
    $del = "DELETE FROM `admin` where id = $did";
    $s1 = "SELECT * FROM `admin` where id = $did";
    $s = mysqli_fetch_assoc(mysqli_query($conn , $s1));
    $s = $s['img'];
    unlink("upload/$s");
    mysqli_query($conn , $del);
   echo "<script>location.replace('list.php?');</script>";
}
?>
  <main id="main" class="main">
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">img</th>
      <th scope="col">Stat</th>
      
      <th scope="col" colspan='2'>action</th>
    </tr>
  </thead>
  <?php
  foreach ($data as $d):
    ?>
   
  <tbody>
    <tr>
      <th scope="row"><?=$d['id']?></th>
      <td><?=$d['name']?></td>
      <td><?=$d['email']?></td>
      <td><img src="upload/<?=$d['img']?>" width="40" alt=""></td>
      <td><?=$d['stat']?></td>
      <td><a href="?del=<?=$d['id']?>" class="btn btn-danger">Delete</a></td>
      <td><a href="update.php?up=<?=$d['id']?>" class="btn btn-info"> Update</a></td>
    </tr>
    
  </tbody>



    <?php
  endforeach;
  ?>
  </table>
  </main>
<?php
include '../shared/bottom.php'
?>