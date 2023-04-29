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
    <link rel="stylesheet" type="text/css" href="dashboard.css">
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
              alert("Video sudah ada di List Saya.");
            } else {
              alert("Video berhasil ditambahkan ke List Saya.");
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
            alert("Video sudah ada di Wishlist Saya.");
          } else {
            alert("Video berhasil ditambahkan ke Wishlist Saya.");
          }
        });
        });
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
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>
    
  </head>
  <body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="admin.php"><img class="navbar-brand studee" src="gambar/Studee1.png" width="110" height="50"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
        <a class="nav-link px-3" style="color:white;" href="logout.php">Sign out</a>
        </div>
    </div>
   </header>

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

        <div class="card" style="margin-right:41px; margin-bottom:20px; width:200rem; margin-top: 50px;">
        <video id="video-player" src="media/<?=$row_video['video']; ?>" class="card-img-top" alt="..." height="400px" style="margin-top: 12px;"
        poster="media/<?=$thumbnail; ?>" controls autoplay></video>
        <div class="card-body">
            <h2 class="card-title"><?=$row_video['judul']; ?></h2>
            <p class="card-text"><?=$row_video['deskripsi']; ?></p>
            <p class="card-text">Guru: <?=$nama_user; ?></p>

        </div>
    
        </div>
      <?php
      }
      ?>
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