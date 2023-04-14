<?php

require "config.php";
$profile = $_SESSION['profile'];

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

    <title>Home</title>

    <style>
      .profil{
        border-radius: 50%;
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
          <li class="nav-item">
            <!-- <a class="nav-link active" aria-current="page" href="#">Topik</a> -->
            <!-- <a class="nav-link margin4" style="margin-left: -40px; margin-right: 30px;" href="#">Topik</a> -->
            <div class ="text">
            <a class="nav-link margin4" style="margin-left: -40px; margin-right: 30px;" href="#">Topik</a>
            <span class = "hover2-text">
            <div class="list-group">
              <a href="topik.php?get_kategori=Akademis" class="list-group-item list-group-item-action">Akademis</a>
              <a href="topik.php?get_kategori=Akuntansi" class="list-group-item list-group-item-action">Akuntansi</a>
              <a href="topik.php?get_kategori=Bisnis" class="list-group-item list-group-item-action">Bisnis</a>
              <a href="topik.php?get_kategori=Desain" class="list-group-item list-group-item-action">Desain</a>
              <a href="topik.php?get_kategori=Komputer" class="list-group-item list-group-item-action">Komputer</a>
              <a href="topik.php?get_kategori=Marketing" class="list-group-item list-group-item-action">Marketing</a>
              <a href="topik.php?get_kategori=Musik" class="list-group-item list-group-item-action">Musik</a>
              <a href="topik.php?get_kategori=Sains" class="list-group-item list-group-item-action">Sains</a>
              <a href="topik.php?get_kategori=Videografi" class="list-group-item list-group-item-action">Videografi</a>
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
              <div class="kolom1" style="margin-left: -155px;"><b><?=$judul_video; ?></b> </div>
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
          <!-- <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li> -->
        </ul>
      </div>
      <div class="text">
      <a href="setting.php"> <img class="profil" src="media/<?php echo $profile; ?>"></a>
      <span class = "hover3-text"> 
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
    </div>
    </div>
  </nav>
  
  <br>


  <div class="d-flex justify-content-center">
      <div class="card" style="width: 40rem;">
        <img src="gambar/mulai_kursus.jpg" class="card-img-top" alt="..." style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">Siap untuk mulai mengajar?</h5>
          <a href="form_kursus.php" class="btn btn-primary">Buat Kursus</a>
        </div>
      </div>
    </div>

    <br>
    <hr style="margin-bottom:-10px">

    <div class="container">
      <div class="row m-5" >
        <?php 
        $nama = $_SESSION['nama'];
        ?>
        <h4 style="margin-left:-100px; margin-bottom:-20px;">Halo, <?php echo $nama; ?>! Lihat Video Yang Telah Kamu Upload</h4>
      </div>

      <div class="row">
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM video WHERE user_id = '$user_id' ORDER BY created_date ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0){
          while($row_guru = $result->fetch_assoc()){
            $thumbnail = $row_guru['thumbnail'];
            $judul = $row_guru['judul'];
            $deskripsi = $row_guru['deskripsi'];
        ?>
        <div class="card col-md-4" style="margin-right:40px; margin-bottom:20px; width:18rem;">
          <img src="media/<?=$thumbnail; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;>
          <div class="card-body">
            <h5 class="card-title"><?=$judul; ?></h5>
            <p class="card-text"><?=$deskripsi; ?></p>
          </div>
        </div>
        <?php }
        }else{ ?>
        <div style="text-align: center;">
          <img src="gambar/kursus_kosong.jpg" height="500px" width="500px" style="margin: 0 auto;">
          <h3>Belum ada video yang di-upload</h3>
        </div>
        <?php }?>
      </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    -->
  </body>
</html>