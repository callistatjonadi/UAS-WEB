<?php
    require "config.php";
    if (isset($_SESSION['profile'])){
      $profile = $_SESSION['profile']; //dari session pp.php
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
      .ukurantulisan {
        font-size: 50px;
        text-anchor: middle;
        font-weight : bold;
        margin-top: 150px;
        margin-left: 30px;
      }
      .ukurantulisan2 {
        font-size: 20px;
        text-anchor: middle;
        margin-left: 30px;
      }
      .ukurantulisan3 {
        font-size: 30px;
        text-anchor: middle;
        margin-top: 20px;
        margin-left: 30px;
      }
      .ukuranfoto{
        width: auto; 
        height: 50%;
      }
      .ukurantulisan4{
        font-family: sans-serif;
        text-align: center;
        font-weight: bold;
        margin-top: 120px;
        margin-bottom: 30px;
      }
      .gambarkecil {
      width: 20%; 
      height: auto;
      display:  block;
      margin: auto;
      margin-top: 10px;
    }
    .bghitam{
      background-color: black;
      margin-top: 110px;
      margin-bottom: 0px;
    }
    .bordersatu{
      font-size:30px;
      color: white;
      margin-left:10px;
      font-family: sans-serif;
      text-align: center;
      margin-top: 25px;
      margin-bottom: 25px;
      margin-left: 110px;
      margin-right: 110px;
      float: left
    }
    .container{
      height: 100px;
      background: black;
      /* border: 1px solid black; */
      margin: auto;
      margin-top: 50px;
      padding: 5px
    }
    #wrapper{
        display: block;
        align-items: center;
        height: 100vh;
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
          <?php if(is_logged_in()){ ?>
            <?php if(is_registered_as_guru()){ ?>
            <a class="nav-link" style="margin-right: 30px;"href="home_guru.php">Guru</a>
            <span class = "hover2-text">Kamu telah menjadi guru <a href="awal_guru.php"><br/><button type="button" class="button4"><b>Click Me!</b></button></a></span>
            <?php }?>
            <?php if(!is_registered_as_guru()){ ?>
            <a class="nav-link" style="margin-right: 30px;"href="home_guru.php">Jadi Guru</a>
            <span class = "hover2-text">Ayo jadi guru <a href="awal_guru.php"><button type="button">Click Me!</button></a></span>
            <?php }?>
          <?php }?>
          <?php if(!is_logged_in()){ ?>
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
              <div class="kolom1"><img class="profil3" src="media/<?=$thumbnail_video; ?>" ></div>
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
                if(isset($_SESSION['user_id'])){
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
              }}}?> 
              <div class="col3">
              <?php if(is_logged_in()){ ?>
               <a href="pembelajaran.php"><button type="button" class="button3"><b>Wishlist</b></button></a><br/>
               <?php } ?>
               <?php if(!is_logged_in()){ ?>
               <a href="sign_up.php"><button type="button" class="button3"><b>Wishlist</b></button></a><br/>
               <?php } ?>
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
    <span class = "hover3-text"> 
        <?php 
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        ?>
        <div class="col1"><img class="profil2" src="gambar/profile.png"></div>
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

  <div class="card text-bg-dark">
    <img src="gambar/ngajar.jpg" class="card-img ukuranfoto" alt="...">
    <div class="card-img-overlay" style="color:black ">
        <h5 class="card-title ukurantulisan" >Ayo bagikan ilmu anda <br> bersama kami</h5>
        <p class="card-text ukurantulisan2">Pendidikan bukanlah persiapan untuk hidup, <br> pendidikan adalah kehidupan itu sendiri</p>  
        <?php if (is_logged_in()){?>
        <p class="card-text ukurantulisan3" style="margin-top: 20px"><a href="home_guru.php"><button type="button" class="btn btn-primary btn-lg">Mulai Mengajar</button></a></p>
        <?php }?>  
        <?php if (!is_logged_in()){?>
        <p class="card-text ukurantulisan3" style="margin-top: 20px"><a href="login.php"><button type="button" class="btn btn-primary btn-lg">Mulai Mengajar</button></a></p>
        <?php }?>
        </div>
    </div> 

    <div>
        <H3 class="ukurantulisan4">Alasan Mengapa Kamu Harus Memulai Mengajar</H3>
        <div class="card-group">
          <div class="card">
            <img class="gambarkecil" src="gambar/class.jpg">
            <div class="card-body">
              <h5 class="card-title">Mengajar</h5>
              <p class="card-text">anda dapat membuat konten kreatif anda sendiri dengan mengunggah video disini</p>
              <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
            </div>
          </div>
          <div class="card">
            <img class="gambarkecil" src="gambar/idea.jpg">
            <div class="card-body">
              <h5 class="card-title">Inspirasi</h5>
              <p class="card-text">Anda dapat menginsprasi orang-orang untuk ikut membagikan ilmu dan memberi kesempatan kepada orang-orang untuk belajar</p>
              <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
            </div>
          </div>
          <div class="card">
            <img class="gambarkecil" src="gambar/present.jpg">
            <div class="card-body">
              <h5 class="card-title">Penghargaan</h5>
              <p class="card-text">Anda akan mendapatkan relasi, jaringan sosial dengan orang lain.</p>
              <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
            </div>
          </div>
        </div>
    </div>

    <div class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid bghitam">
      <div>
          <h5 class="bordersatu">75M Peserta</h5>
        </div>
        <div>
          <h5 class="bordersatu">10+ Bahasa</h5>
        </div>
        <div>
          <h5 class="bordersatu">180+ Negara</h5>
        </div>
    </div>
  </div>
  </div>

  <H3 class="ukurantulisan4">Cara Memulai Pengajaran Anda</H3>
    <div id="wrapper">
        <div class="tabs">
            <input hidden type="radio" name="tab-name" id="tab-1" checked>
            <label class="tab-control" for="tab-1" >Merencakan pengajaran</label>

            <input hidden type="radio" name="tab-name" id="tab-2">
            <label class="tab-control" for="tab-2">Membuat Video</label>

            <input hidden type="radio" name="tab-name" id="tab-3" checked>
            <label class="tab-control" for="tab-3" >Upload Video</label>

            <div class="tab-content">
                <div id="tab-panel-1" class="tab-panel">
                <img class="gambarkecil" src="gambar/teaching.jpg">
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                </div>

                <div id="tab-panel-2" class="tab-panel">
                <img class="gambarkecil" src="gambar/video.jpg">
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                </div>
                <div id="tab-panel-3" class="tab-panel">
                <img class="gambarkecil" src="gambar/upload.jpg">
                    <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
                      The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', 
                      making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, 
                      and a search for 'lorem ipsum' will uncover many web sites still in their infancy. 
                      Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
                    
                </div>
            </div>
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