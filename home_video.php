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

    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
      $("#tambah_list-btn").click(function(){
        var id_video = "<?php echo $_GET['get_id_video']; ?>";
        $.post("edit_pembelajaran.php", 
        {
          id_video_listsaya: id_video
        },
        function(data, status){
          if (data == "sudah_ada") {
            showModal("Video sudah ada di List Saya.");
          } else {
            showModal("Video berhasil ditambahkan ke List Saya.");
          }
        });
      });

      $("#tambah_wishlist-btn").click(function(){
        var id_video = "<?php echo $_GET['get_id_video']; ?>";
        $.post("edit_pembelajaran.php",
        {
          id_video_wishlist: id_video
        },
        function(data, status){
          if (data == "sudah_ada") {
            showModal("Video sudah ada di Wishlist Saya.");
          } else {
            showModal("Video berhasil ditambahkan ke Wishlist Saya.");
          }
        });
      });

      function showModal(message) {
        $("#modal-message").text(message);
        $("#myModal").modal("show");
      }
    });
  </script>
    <style>
        body{
            background: #D3D3D3;
        }
        nav{
            margin-bottom: 20px; 
        }
        p{
            font-size: 20px;
        }
        .btn{
            letter-spacing: 1px;
            font-weight: bold;
        }
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

  <div class="container">
    <div class="row">
  <?php 
    // $sql = "SELECT * FROM video";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $row = $result->fetch_assoc();
    if(isset($_GET['get_id_video'])){
        $id_video = $_GET['get_id_video']; //dari url page home.php
        $sql = "SELECT * FROM video WHERE id = '$id_video'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_video = $result->fetch_assoc();
        $user_id = $row_video['user_id']; //ambil data kolom user_id di tabel video
        $thumbnail = $row_video['thumbnail'];

        $sql_user = "SELECT * FROM student WHERE id = '$user_id'";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $row_user = $result_user->fetch_assoc();
        $nama_user = $row_user['nama'];

        ?>

        <div class="card" style="margin-right:41px; margin-bottom:20px; width:200rem;">
        <video id="video-player" src="media/<?=$row_video['video']; ?>" class="card-img-top" alt="..." height="400px" style="margin-top: 12px;"
        poster="media/<?=$thumbnail; ?>" controls autoplay></video>
        <div class="card-body">
            <h2 class="card-title"><?=$row_video['judul']; ?></h2>
            <p class="card-text"><?=$row_video['deskripsi']; ?></p>
            <p class="card-text">Guru: <?=$nama_user; ?></p>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" id="tambah_list-btn" style="width: 20%; ">+ List Saya</button>
                <button class="btn btn-primary" type="button" id="tambah_wishlist-btn" style="width: 20%; padding-left: -200px;">+ Wishlist Saya</button>

            </div>
        </div>
        </div>
      <?php
      }
      ?>
      </div>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Pemberitahuan</h4>
            
        </div>
        <div class="modal-body">
          <p id="modal-message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  
    </div>
    <!-- <script>
    var videoPlayer = document.getElementById("video-player");
      videoPlayer.addEventListener("ended", function(){
        if(videoPlayer.ended){
          document.getElementById("status").innerHTML = "Complete";
        }
      });
    </script> -->
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