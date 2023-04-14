<?php

require "config.php";

$profile = $_SESSION['profile'];

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM video WHERE user_id = '$user_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) > 0){
  $_SESSION['guru'] = $user_id; //untuk config.php, cek user ini pernah upload jadi guru, Jadi Guru -> Guru.
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
    <style>
      h1 {
        margin-bottom: 40px;
        font-size: 40px;
      }
      h3 {
        color: grey;
      }
      .profil{
        border-radius: 50%;
      }
      #wrapper{
        display: block;
        align-items: center;
        height: 60vh;
        max-width: 45rem;
        margin: 0 auto;
        padding: 20px;
    }
    .tabs{
        width: 100%;
        border-radius: 0.5rem;
        box-shadow: black;
    }
    .tab-control{
        display: inline-block;
        border-bottom: 2px solid transparent;
        font-size: 1.25rem;
        padding: 0.6rem 1rem;
        cursor: pointer;
        transition: all 0.25s ease;
        color: #636363;
    }
    .tab-control:hover{
        color: #3565ff;
    }
    .tab-control{
        border-top: 1px solid #3575ff;
        padding: 1rem;
    }
    .tab-panel{
        display: none;

    }
    
    input[type=radio]:checked+.tab-control{
        font-weight: bold;
        color: black;
        border-bottom-color: black;
    }

    #tab-1:checked~.tab-content>#tab-panel-1{
        display: block;
    }
    #tab-2:checked~.tab-content>#tab-panel-2{
        display: block;
    }
    #tab-3:checked~.tab-content>#tab-panel-3{
        display: block;
    }
    .gambarkecil {
      width: 40%; 
      height: auto;
      display:  block;
      margin: auto;
      margin-top: 10px;
    }
    .ukurantulisan4{
        font-family: sans-serif;
        text-align: center;
        font-weight: bold;
        margin-top: 50px;
        margin-bottom: 30px;
      }
      .round {
        margin-top:30px;
        border-radius: 50%;
        overflow: hidden;
        width: 150px;
        height: 150px;
        border:2px solid white;
        margin: 0 auto;
        }
      .round img {
          display: block;
          min-width: 100%;
          min-height: 100%;
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
            <!-- <a class="nav-link active" aria-current="page" href="#">Topik</a> -->
            <!-- <a class="nav-link margin4" style="margin-left: -40px; margin-right: 30px;" href="#">Topik</a> -->
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
              <div class="kolom2" style="margin-left: -155px; "><b><?=$judul_video ?></b> </div> 
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
  
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators ">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="gambar/gambar1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="gambar/gambar2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="gambar/gambar3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="container">
    <div class="row">
    <h1>Semua Kursus Online Kami</h1>
  <?php 
    $sql = "SELECT * FROM video ORDER BY created_date ASC";
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
        <div class="card col-md-4" style="margin-right:40px; margin-bottom:20px; width:18rem;">
        <a href="home_video.php?get_id_video=<?= $video_id; ?>"><img src="media/<?=$row_video['thumbnail']; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;"></a>
        <div class="card-body">
          <h5 class="card-title"><?=$row_video['judul']; ?></h5>
          <p class="card-text"><?=$row_user['nama']; ?></p>
        </div>
        </div>

      <?php
      }
      }else{ ?>
        <div style="text-align: center;">
          <img src="gambar/kursus_kosong.jpg" height="500px" width="500px" style="margin: 0 auto;">
          <h3>Belum ada video yang di-upload</h3>
        </div>
      <?php }?>
      </div>
      </div>
    
    
  <div class="container marketing">
  <hr>
    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
      <div class="round"  style="margin-top:50px">
					<img src="gambar/teacher1.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg img="src:gambar/teacher1.jpg" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Teacher Henny</h2>
        <p>Saya sangat senang dapat menjadi bagian sebagai guru di studee, sangat praktis dan mudah!</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="round"  style="margin-top:50px">
					<img src="gambar/teacher2.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Teacher Safira</h2>
        <p>Ayo belajar dan lihat pembelajaran yang saya unggah</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="round"  style="margin-top:50px">
					<img src="gambar/teacher3.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Teacher Celine</h2>
        <p>Video pembelajaran yang saya unggah berhubungan dengan marketing, ayo segera nonton video saya.</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div>

    <hr>

    <H3 class="ukurantulisan4">Alasan kenapa anda harus belajar di studee</H3>
    <div id="wrapper">
        <div class="tabs">
            <input hidden type="radio" name="tab-name" id="tab-1" checked>
            <label class="tab-control" for="tab-1" >Belajar Mandiri</label>

            <input hidden type="radio" name="tab-name" id="tab-2">
            <label class="tab-control" for="tab-2">Belajar Mudah</label>

            <input hidden type="radio" name="tab-name" id="tab-3" checked>
            <label class="tab-control" for="tab-3" >Menambah Ilmu</label>

            <div class="tab-content">
                <div id="tab-panel-1" class="tab-panel">
                <img class="gambarkecil" src="gambar/mandiri.jpg">
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                </div>

                <div id="tab-panel-2" class="tab-panel">
                <img class="gambarkecil" src="gambar/mudah.jpg">
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                </div>
                <div id="tab-panel-3" class="tab-panel">
                <img class="gambarkecil" src="gambar/menambahilmu.jpg">
                    <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
                      The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', 
                      making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, 
                      and a search for 'lorem ipsum' will uncover many web sites still in their infancy. 
                      Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
                    
                </div>
            </div>
        </div> 
    </div>

    <hr style="margin-top:170px">

    <div class="row">
      <div class="col-lg-4">
      <div class="round"  style="margin-top:30px">
					<img src="gambar/Velove.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg img="src:gambar/teacher1.jpg" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Velove</h2>
        <p>Belajar di studee sangat membantu.</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="round"  style="margin-top:30px">
					<img src="gambar/Joe.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Joe</h2>
        <p>Saya dapat belajar musik dengan mudah di studee</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="round"  style="margin-top:30px">
					<img src="gambar/Diana.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Diana</h2>
        <p>studee sangat membantu saya dalam belajar!</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div>
    <div class="col-lg-4">
        <div class="round"  style="margin-top:30px">
					<img src="gambar/Bastian.jpg" height="100px" width=auto/>
				</div>
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <h2 class="fw-normal">Bastian</h2>
        <p>Sangat menyenangkan! dapat dengan mudah mencari video yang diinginkan!</p>
        <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
          </a>
          <span class="mb-3 mb-md-0 text-body-secondary hitam">&copy; 2023 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><img class="medsos" src="gambar/twitter.png"></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><img class="medsos" src="gambar/ig.png"></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><img class="medsos" src="gambar/facebook.png"></svg></a></li>
        </ul>
      </footer>
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