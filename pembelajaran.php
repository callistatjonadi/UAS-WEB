<?php
require "config.php";
$profile = $_SESSION['profile'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.rtl.min.css" integrity="sha384-5/ZcxA7Dub2FNG09dHw8CHmPN7Fz6ASlweagj0nuXjmMyupgH9n9F5Hd926zsu3/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script src="https://kit.fontawesome.com/0d35f3ceae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Pembelajaran Saya</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function(){
         $(".hapus_list-btn").click(function(){
          var id_video = $(this).data("id"); //dari button data-id
          var card = $(this).closest('.card');

          $.post("edit_pembelajaran.php",
            {
              id_video_hapuslist: id_video
            },
          function(data, status){
            if (status == "success") {
              card.hide();
            } 
         });
        });
         $(".hapus_wishlist-btn").click(function(){
          var id_video = $(this).data("id"); //dari button data-id
          var card = $(this).closest('.card');

          $.post("edit_pembelajaran.php",
            {
              id_video_hapuswishlist: id_video
            },
          function(data, status){
            if (status == "success") {
              card.hide();
            } 
         });
        });
       });
    </script>
    <style>
      h1{
        font-size: 15px;
        font-weight: normal;
      }
      .rapi1{
        margin-left: 90px;
        color: white;
      }

      #wrapper{
        display: flex;
        align-items: center;
        margin-top:20px;
        max-width: 80rem;
        margin: 0 auto;
        padding: 20px;
    }
    .tabs{
        width: 100%;
        background-color: black;
        border-radius: 0.5rem;
        box-shadow: black;
    }
    .tab-control{
        display: inline-block;
        border-bottom: 2px solid transparent;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.25s ease;
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
    .bghitam{
      background-color: black;
      margin-top: 110px;
      margin-bottom: 0px;
    }
    
    input[type=radio]:checked+.tab-control{
        font-weight: 600;
        color: #3565ff;
        border-bottom-color: #3565ff;
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

    p{
       margin-left: 5.7rem;
       margin-right: 5.5rem;
       text-align: justify;
       margin-top: 1rem;
    }
    .kanan{
      margin-left: 90px;
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

  

  <div class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid bghitam2">
      <div>
        <h2 class="borderdua" style="text-align: left; margin-bottom: 0px;">Pembelajaran Saya</h2>
        </br>
        <div id="wrapper" class="rapi1" >
        <div class="tabs">
            <input hidden type="radio" name="tab-name" id="tab-1" checked>
            <label class="tab-control rapi1" for="tab-1" >Semua Pelajaran</label>

            <input hidden type="radio" name="tab-name" id="tab-2">
            <label class="tab-control" for="tab-2">List Saya</label>

            <input hidden type="radio" name="tab-name" id="tab-3">
            <label class="tab-control" for="tab-3" >Wishlist</label>

            <div class="tab-content">
                <div id="tab-panel-1" class="tab-panel">
                <div class="container">
                      <div class="row kanan">
                      <?php 
                          $user_id = $_SESSION['user_id']; //dari login signup
                          $sql = "SELECT video_id FROM listsaya WHERE user_id = '$user_id'
                          UNION
                          SELECT video_id FROM wishlist WHERE user_id = '$user_id'";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute();
                          $result = $stmt->get_result();

                          if(mysqli_num_rows($result) > 0){
                            while($row_pembelajaran = $result->fetch_assoc()){
                              $video_id = $row_pembelajaran['video_id'];

                              $sql_video = "SELECT * FROM video WHERE id = '$video_id'"; //cari id vid di list di table video
                              $stmt_video = $conn->prepare($sql_video);
                              $stmt_video->execute();
                              $result_video = $stmt_video->get_result();
                              $row_video = $result_video->fetch_assoc();
                              $thumbnail_video = $row_video['thumbnail'];
                              $judul_video = $row_video['judul'];

                            ?>
                              <div class="card" style="margin-right:6px; margin-bottom:20px; width:18rem;">
                              <a href="home_video.php?get_id_video=<?= $video_id; ?>">  
                                <img src="media/<?=$thumbnail_video; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;">
                              </a>
                              <div class="card-body">
                                <h5 class="card-title"><?=$judul_video; ?></h5>
                                <h1 class="card-text"><?=$row_video['deskripsi']; ?></h1>
                              </div>
  
                              </div>
                            <?php
                            }
                            }
                            ?>
                          </div>
                      </div>
                    
                </div>

                <div id="tab-panel-2" class="tab-panel">
                    <div class="container">
                      <div class="row kanan">
                      <?php 
                          $user_id = $_SESSION['user_id']; //dari login signup
                          $sql = "SELECT * FROM listsaya WHERE user_id = $user_id ORDER BY created_date ASC";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute();
                          $result = $stmt->get_result();

                          if(mysqli_num_rows($result) > 0){
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
                              <div class="card" style="margin-right:6px; margin-bottom:20px; width:18rem;">
                              <a href="home_video.php?get_id_video=<?= $video_id; ?>">  
                                <img src="media/<?=$thumbnail_video; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;">
                              </a>
                              <div class="card-body">
                                <h5 class="card-title"><?=$judul_video; ?></h5>
                                <h1 class="card-text"><?=$row_video['deskripsi']; ?></h1>
                              </div>
                              <button class="btn btn-danger hapus_list-btn" data-id="<?=$video_id;?>" type="button" style="width: 100%; margin-bottom: 10px;">- List Saya</button>
                              </div>
                            <?php
                            }
                            }
                            ?>
                          </div>
                      </div>
                </div>

                <div id="tab-panel-3" class="tab-panel">
                <div class="container">
                      <div class="row kanan">
                      <?php 
                          $user_id = $_SESSION['user_id']; //dari login signup
                          $sql = "SELECT * FROM wishlist WHERE user_id = $user_id ORDER BY created_date ASC";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute();
                          $result = $stmt->get_result();

                          if(mysqli_num_rows($result) > 0){
                            while($row_wishlist = $result->fetch_assoc()){
                              $video_id = $row_wishlist['video_id'];

                              $sql_video = "SELECT * FROM video WHERE id = '$video_id'"; //cari id vid di list di table video
                              $stmt_video = $conn->prepare($sql_video);
                              $stmt_video->execute();
                              $result_video = $stmt_video->get_result();
                              $row_video = $result_video->fetch_assoc();
                              $thumbnail_video = $row_video['thumbnail'];
                              $judul_video = $row_video['judul'];
                            ?>
                              <div class="card" style="margin-right:6px; margin-bottom:20px; width:18rem;">
                              <a href="home_video.php?get_id_video=<?= $video_id; ?>">  
                                <img src="media/<?=$thumbnail_video; ?>" class="card-img-top" alt="..." height="200px" style="margin-top: 12px;">
                              </a>
                              <div class="card-body">
                                <h5 class="card-title"><?=$judul_video; ?></h5>
                                <h1 class="card-text"><?=$row_video['deskripsi']; ?></h1>
                              </div>
                              <button class="btn btn-danger hapus_wishlist-btn" data-id="<?=$video_id;?>" type="button" style="width: 100%; margin-bottom: 10px;">- Wishlist</button>
                              </div>
                            <?php
                            }
                            }
                            ?>
                          </div>
                      </div>
                    
                </div>
            </div>

        </div>
        </div>


      </div>
  </div>
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
  
    
</body>
</html>