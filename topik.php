<?php

require "config.php";

if(isset($_SESSION['profile'])){
  $profile = $_SESSION['profile'];
}


?>
<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.rtl.min.css" integrity="sha384-5/ZcxA7Dub2FNG09dHw8CHmPN7Fz6ASlweagj0nuXjmMyupgH9n9F5Hd926zsu3/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script src="https://kit.fontawesome.com/0d35f3ceae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Topik Pembelajaran</title>
    <style>
      h3 {
        margin-bottom: 40px;
        font-size: 30px;
        text-align: center;

      }
      h4 {
        color: grey;
      }
      .profil{
            border-radius: 50%;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <?php if(!is_logged_in()){ ?>
      <a class="nav-link" href="index.php"><img class="navbar-brand studee" src="gambar/studee.png" width="110" height="50"></a>
    <?php }?>
    <?php if(is_logged_in()){ ?>
    <a class="nav-link" href="home.php"><img class="navbar-brand studee" src="gambar/studee.png" width="110" height="50"></a>
    <?php }?>
      <form class="d-flex search" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success jarak1" type="submit">Search</button>
        </form>

      <div class="collapse navbar-collapse"  id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
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
          <?php if (is_logged_in()){?>  
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
          <?php }?>
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
          <?php if (is_logged_in()){?>  
          <li class="nav-item text">
            <a class="nav-link besar1 margin1" href="#"><i class="bi bi-bell fa-lg"></i></a>
            <span class = "hover6-text"> 
              <div class="col3 kotak">Notification</div><br/>
              <div class="col3 kotak">Notification</div><br/>
              <div class="col3 kotak">Notification</div><br/>    
           </span>
          </li>
          <?php }?>
          <!-- <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li> -->
        </ul>
      </div>
    <?php if (is_logged_in()){?>  
    <div class="text">
    <a href="setting.php"> <img class="profil" src="media/<?php echo $profile; ?>"></a>
    <span class = "hover3-text "> 
        <?php 
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        ?>
        <div class="col1"><img class="profil2" src="media/<?php echo $profile; ?>"></div>
        <div class="col1" style="margin-left: -170px; padding-top: 3px;"><b><?php echo $username; ?></b> 
          <br/>
          <div style="font-size:13px"><?php echo $email; ?></div><br/>
        </div>
        
        <a href="setting.php"><button type="button" class="button1"><b>SETTINGS</b></button></a><br/>
        <a href="logout.php"><button type="button" class="button2"><b>LOG OUT</b></button></a>
      </span>
    <?php 
    } ?>
    <?php if (!is_logged_in()){?>
    <a href="login.php"> <button type="button" class="btn btn-dark">Login</button></a>
    <a href="sign_up.php"> <button type="button" class="btn btn-outline-secondary jarak1">Signup</button></a>
    <?php }?>    
    
     </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
    <?php
    $id_kategori =  $_GET['get_kategori'];
    $sql_kategori = "SELECT * FROM topik WHERE id = '$id_kategori'";
    $stmt_kategori = $conn->prepare($sql_kategori);
    $stmt_kategori->execute();
    $result_kategori = $stmt_kategori->get_result();
    $row_kategori = $result_kategori->fetch_assoc();
    $nama_kategori = $row_kategori['nama_topik'];
    ?>
    <h3 style="margin-top:30px">Video pembelajaran yang berkaitan dengan topik <?php echo $nama_kategori; ?></h3>
  <?php 

      $sql = "SELECT * FROM video WHERE kategori = '$id_kategori' ORDER BY created_date ASC";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
 
    if(mysqli_num_rows($result) > 0){
      while($row_video = $result->fetch_assoc()){
        $video_id = $row_video['id'];
        $user_id = $row_video['user_id'];
        $sql_user = "SELECT * FROM student WHERE id = '$user_id'";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $row_user = $result_user->fetch_assoc();
      ?>
        <div class="card" style="margin-right:41px; margin-bottom:20px; width:18rem;">
        <?php
        if(is_logged_in()){ ?>
        <a href="home_video.php?get_id_video=<?= $video_id; ?>"><img src="media/<?=$row_video['thumbnail']; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;"></a>
        <?php }
        if(!is_logged_in()){ ?>
        <a href="sign_up.php"><img src="media/<?=$row_video['thumbnail']; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;"></a>
        <?php }?>
        <div class="card-body">
          <h5 class="card-title"><?=$nama_kategori; ?></h5>
          <p class="card-text"><?=$row_user['nama']; ?></p>
        </div>
        </div>

      <?php
      }
      }else{ ?>
        <div style="text-align: center;">
          <img src="gambar/kursus_kosong.jpg" height="500px" width="500px" style="margin: 0 auto;">
          <h4>Belum ada video yang di-upload</h4>
        </div>
      <?php }?>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>
</html>
