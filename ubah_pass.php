<?php

require "config.php";
$profile = $_SESSION['profile'];
$id_user = $_SESSION['user_id'];

$sql_user  = "SELECT * FROM student WHERE id = '$id_user'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();
$password = $row_user['password'];

if (isset($_POST['reset'])) {
  if ($_POST['pass_sekarang'] == $password) {
    $pass_baru = $_POST['pass_ulang'];

    $sql = "UPDATE student SET password = ? WHERE id = '$id_user'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pass_baru);

    if ($stmt->execute()) {
      header("location: home.php");
    }
  } elseif ($_POST['pass_sekarang'] != $password) {
    ?>

    <div class="modal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ada Kesalahan Input</h5>
          </div>
          <div class="modal-body">
            <p>Password saat ini yang Anda masukkan salah. Silahkan ulangi lagi.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
<?php }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.rtl.min.css" integrity="sha384-5/ZcxA7Dub2FNG09dHw8CHmPN7Fz6ASlweagj0nuXjmMyupgH9n9F5Hd926zsu3/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/0d35f3ceae.js" crossorigin="anonymous"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <title>Settings</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.modal').modal('show');
      });

      function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;

      if (password !== confirmPassword) {
        document.getElementById("password").classList.add("error");
        document.getElementById("confirmPassword").classList.add("error");
        return false;
      } else {
        document.getElementById("password").classList.remove("error");
        document.getElementById("confirmPassword").classList.remove("error");
        return true;
      }
    }
    </script>
    <style>
      .profil{
        border-radius: 50%;
      }
      .error {
        border: 1px solid red;
      }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
    <a class="nav-link" href="home.php"><img class="navbar-brand studee" src="gambar/studee.png" width="110" height="50"></a>


      <form class="d-flex search" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success jarak1" type="submit">Search</button>
        </form>

        <div class="collapse navbar-collapse"  id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item text">
            <!-- <a class="nav-link active" aria-current="page" href="#">Topik</a> -->
            <!-- <a class="nav-link margin4" style="margin-left: -40px; margin-right: 30px;" href="#">Topik</a> -->
            <div class ="text">
            <a class="nav-link margin4" style="margin-left: -40px; margin-right: 30px;" href="#">Topik</a>
            <span class = "hover2-text">
            <div class="list-group">
            <?php
              $sql_kategori = "SELECT * FROM topik ORDER BY nama_topik ASC";
              $result_kategori = $conn->query($sql_kategori);
              while ($row_kategori = $result_kategori->fetch_assoc()) {
                $kategori_id = $row_kategori['id'];
                $nama_kategori = $row_kategori['nama_topik'];
                ?>
                <a href="topik.php?get_kategori=<?php echo $kategori_id; ?>" class="list-group-item list-group-item-action"><?php echo $nama_kategori; ?></a>
                <?php
              }
              ?>
            </div>
            </span>
          </div>
          </li>
          <li class="nav-item text">
          <?php if(is_registered_as_guru()){ ?>
            <a class="nav-link" style="margin-right: 30px;"href="awal_guru.php">Guru</a>
            <span class = "hover2-text">Kamu telah menjadi guru <a href="awal_guru.php"><br/><button type="button" class="button4"><b>Click Me!</b></button></a></span>
            <?php }?>
            <?php if(!is_registered_as_guru()){ ?>
            <a class="nav-link" style="margin-right: 30px;"href="awal_guru.php">Jadi Guru</a>
            <span class = "hover2-text">Ayo jadi guru <a href="awal_guru.php"><br/><button type="button" class="button4"><b>Click Me!</b></button></a></span>
            <?php }?>
          </li>
          <li class="nav-item text">
            <a class="nav-link margin3" style="margin-right: 30px;" href="pembelajaran.php">Pembelajaran Saya</a>
            <span class = "hover4-text">
              <?php
              $user_id = $_SESSION['user_id']; //dari login signup
              $sql = "SELECT * FROM listsaya WHERE user_id = '$user_id' ORDER BY created_date ASC";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();
              if(mysqli_num_rows($result) > 0){
                  $count = 0;
                  while($row_listsaya = $result->fetch_assoc()){
                    $video_id = $row_listsaya['video_id'];
                    $sql_video = "SELECT * FROM video WHERE id = '$video_id'"; //cari id vid di list di table video
                    $stmt_video = $conn->prepare($sql_video);
                    $stmt_video->execute();
                    $result_video = $stmt_video->get_result();
                    $row_video = $result_video->fetch_assoc();
                    $thumbnail_video = $row_video['thumbnail'];
                    $judul_video = $row_video['judul'];
              ?>

              <div class="kolom1"><img class="profil3" src="media/<?=$thumbnail_video; ?>"></div>
              
              <div class="kolom2" style="margin-left: -155px;"><b><?=$judul_video; ?></b> </div>
              <?php 
              $count++;
              if($count == 3){
                break;
              }
              }}?> 
              <div class="col3">
               <a href="pembelajaran.php"><button type="button" class="button3"><b>Pembelajaran Saya</b></button></a><br/>
              </div>
            </span>
          </li>
          <li class="nav-item text">
            <a class="nav-link" style="margin-right: 20px;" href="pembelajaran.php"><i class = "bi bi-bookmark fa-lg"></i></a>
            <span class = "hover5-text"> 
              <?php
                $user_id = $_SESSION['user_id']; //dari login signup
                $sql = "SELECT * FROM wishlist WHERE user_id = '$user_id' ORDER BY created_date ASC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                if(mysqli_num_rows($result) > 0){
                    $count = 0;
                    while($row_listsaya = $result->fetch_assoc()){
                      $video_id = $row_listsaya['video_id'];
                      $sql_video = "SELECT * FROM video WHERE id = '$video_id'"; //cari id vid di list di table video
                      $stmt_video = $conn->prepare($sql_video);
                      $stmt_video->execute();
                      $result_video = $stmt_video->get_result();
                      $row_video = $result_video->fetch_assoc();
                      $thumbnail_video = $row_video['thumbnail'];
                      $judul_video = $row_video['judul'];
                ?>
              <div class="kolom1"><img class="profil4" src="media/<?=$thumbnail_video ?>"></div>
              <div class="kolom2" style="margin-left: -155px;"><b><?=$judul_video ?></b> </div> 
              <?php 
              $count++;
              if($count == 3){
                break;
              }
              }}?> 
              <div class="col3">
               <a href="pembelajaran.php"><button type="button" class="button3"><b>Wishlist</b></button></a><br/>
              </div>
           </span>
          </li>
          <li class="nav-item text">
            <a class="nav-link besar1 margin1" href="#"><i class="bi bi-bell fa-lg"></i></a>
            <span class = "hover6-text"> 
              <div class="col3 kotak">Notification</div><br/>
              <div class="col3 kotak">Notification</div><br/>
              <div class="col3 kotak">Notification</div><br/>    
           </span>
          </li>

        </ul>
      </div>
      <div class="text">
      <a href="setting.php"><img class="profil" src="media/<?php echo $profile; ?>"></a>
      <span class = "hover3-text"> 
        <?php 
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        ?>
        <div class="col1"><img class="profil2" src="media//<?php echo $profile; ?>"></div>
        <div class="col1" style="margin-left: -170px; padding-top: 3px;"><b><?php echo $username; ?></b> 
          <br/>
          <div style="font-size:13px"><?php echo $email; ?></div><br/>
        </div>
        
        <a href="setting.php"><button type="button" class="button1"><b>SETTINGS</b></button></a><br/>
        <a href="logout.php"><button type="button" class="button2"><b>LOG OUT</b></button></a>
      </span>
     </div>
    </div>
  </nav>

  <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
      <div class="position-sticky sidebar-sticky warnasetting">
        <ul class="nav flex-column">
          <li class="nav-item kiri2">
            <a class="nav-link active b" aria-current="page" href="setting.php">
            <i class="bi bi-info-circle" style="margin-right:15px;"></i>
            <span class="align-text-bottom textkecil1"></span>
              Profile
            </a>
          </li>
          <hr class="hr1">
          <li class="nav-item kiri2">
            <a class="nav-link b" href="pp.php">
            <i class="bi bi-person-circle" style="margin-right:15px;"></i>
            <span data-feather="file" class="align-text-bottom textkecil1" style="color:white;"></span>
              Profile Picture
            </a>
          </li>
          <hr class="hr1">
          <li class="nav-item kiri2">
            <a class="nav-link b" href="ubah_pass.php">
            <i class="bi bi-key" style="margin-right:15px;"></i>
            <span data-feather="file" class="align-text-bottom textkecil1" style="color:white;"></span>
              Ganti Password
            </a>
          </li>
          <hr class="hr1">
          <li class="nav-item kiri2">
            <a class="nav-link c"  href="closeakun.php">
            <i class="bi bi-x-circle" style="margin-right:15px;"></i>
            <span data-feather="shopping-cart" class="align-text-bottom textkecil1"></span>
              Tutup Akun
            </a>
          </li>
          <hr class="hr1">
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="margin-left:60px;">
        <h1 class="h2">Profile</h1>
      </div>

      <form method="POST" enctype="multipart/form-data" action="" onsubmit="return validateForm()">
      <div style="margin-left:60px; margin-top:10px; width:70%">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input class="form-control" type="text" placeholder=<?php echo $email; ?> aria-label="Disabled input example" disabled name="email">
      </div>  

      <div style="margin-left:60px; margin-top:20px;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password Saat Ini</label>
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="password saat ini" name="pass_sekarang" required>
        </div>
      </div>

      <div style="margin-left:60px; margin-top:20px;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password" placeholder="password baru" name="pass_baru" required>
        </div>
      </div>

      <div style="margin-left:60px; margin-top:20px;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ulangi Password Baru</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="ulangi password baru" name="pass_ulang" required>
        </div>
      </div>


      <div><button class="button5" style="margin-left:60px; margin-top:20px;" name="reset">Reset Password</button></div>
      </form>
    </main>
    </div>
</div>
</body>
</html>