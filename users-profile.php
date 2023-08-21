
<?php
include 'shared/top.php';
include 'conn.php';
$fail = null;
if(isset($_POST['save'])){

  $id = $_SESSION['id']; 
 
  
    $name = $_POST['name'];
  
    $email = $_POST['email'];
    $img = rand(0,1000).rand(0,1000).$_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $folder = "admin/upload/" . $img;
    $update = "UPDATE `admin` SET name = '$name' , img = '$img'  , email='$email' where id =$id ";
    mysqli_query($conn , $update);
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['img'] = $img;
    move_uploaded_file($tmp ,$folder);
    echo "<script>location.replace('http://127.0.0.1/niceadmin/niceadmin/users-profile.php');</script>";

  
}
if(isset($_POST['updatePass'])){
  $id = $_SESSION['id']; 
  $sql = "SELECT * FROM `admin` where id =$id ";

 $password = mysqli_query($conn , $sql);
 $pass = mysqli_fetch_assoc($password);
  $oldpass = $_POST['oldpass'];
  $curr = $_POST['curr'];
  $recurr = $_POST['recurr'];

    $update = "UPDATE `admin` SET pass = '$curr'  where id =$id ";
    
    if($oldpass != $pass['pass']){
      $fail = "Wrong password";
    }
    
    else if($recurr != $curr){
      $fail = "Please enter two identical passwords";
    }
    else if(strlen($curr)<8){
      $fail = "Password should be at least 8 characters";
    }
    else{
      
      mysqli_query($conn , $update);
    }
    

  
}
?> 
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="http://127.0.0.1/niceadmin/niceadmin/upload/<?= $_SESSION['img'] ?>" alt="Profile" class="rounded-circle">
            <h2><?= $_SESSION['name'] ?></h2>
            <h3>Web Designer</h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" id="over" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

             

              <li class="nav-item">
                <button id='p' class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?= $_SESSION['name'] ?></div>
                </div>

               

                

                

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?= $_SESSION['email'] ?></div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method='post' action='' enctype= "multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="http://127.0.0.1/niceadmin/niceadmin/upload/<?= $_SESSION['img'] ?>" alt="Profile">
                      <div class="pt-2">
                        
                          <input type="file" name="img" id="">

                        
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="<?= $_SESSION['name'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="<?= $_SESSION['email'] ?>">
                    </div>
                  </div>

                  
                  <div class="text-center">
                    <button type="submit" name='save' class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

           

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="post" action=''>

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="oldpass" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="recurr" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="curr" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" name = "updatePass" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
  <?php
                  if(strlen($fail) > 0):
                  ?>
                  <div class="alert alert-danger"><?=$fail?></div>
                  <?php endif; ?>
  </main><!-- End #main -->
  <?php
//   if(isset($_POST['updatePass'])){
//     echo '
// <script>
// var pass = document.getElementById("p");
// var over = document.getElementById("over");

// over.classList.remove("active");
// pass.click();
// </script>
// ';
//   }
include 'shared/bottom.php';
?> 
