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
            body{
              background: #D3D3D3;
            }
            .container{
              display: flex;
              align-items: center; /* center vertically */
              justify-content: center; /* center horizontally */
              height: 100vh;
            }

            .putih{
              background: white;
              margin-top: 50px;
              height: 100vh;
              width: 100vh;
              border-radius: 10px;
            }
            .tombol{
              margin-top: 35px;
              width: 200px;
              height: 50px;
              font-size: 20px;
              border-radius: 10px;
              border: 3px solid gray;
              font-weight: bold;
              color: gray;
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

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <!-- <a class="nav-link active" aria-current="page" href="#">Topik</a> -->
            <!-- <a class="nav-link" href="#">Topik</a> -->
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
            <a class="nav-link margin3" href="pembelajaran.php">Pembelajaran Saya</a>
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
            <a class="nav-link besar1 margin1" href="pembelajaran.php"><i class="bi bi-bookmark fa-lg"></i></a>
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
  <?php
      if(isset($_POST['submit'])){
          $video_name = $_FILES['video']['name'];
          $video_path = "media/" . $video_name;
          
          $thumbnail_name = $_FILES['thumbnail']['name']; //thumbnail dari form name di bawah //nama file asli
          $thumbnail_path = "media/" . $thumbnail_name; //media/namafileasli

          $user_id = $_SESSION['user_id'];
          // $user_id = $id;
          $judul = $_POST['judul'];
          $kategori = $_POST['kategori'];
          $deskripsi = $_POST['deskripsi'];
          $status = "pending";

          move_uploaded_file($_FILES['video']['tmp_name'], $video_path); //video di temporary store ke videopath
          move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_path); //untuk upload ke folder media/


          $sql = "INSERT INTO video (user_id, judul, deskripsi, kategori, thumbnail, video, status) VALUES (?,?,?,?,?,?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("dssssss", $user_id, $judul, $deskripsi, $kategori, $thumbnail_name, $video_name, $status);
              
          if ($stmt->execute()){
            echo '<div class="alert alert-success">File berhasil diupload.</div>';
          } else {
            echo '<div class="alert alert-danger">File gagal diupload.</div>';
          }
          
        }
    ?>

  <div class="container text-center putih">
    <div class="row">
    <div class="col"></div>
      <div class="col-12">
          <h1>Buat Kursus</h1>
          <hr>
          <form method="POST" enctype="multipart/form-data" action="">
          <div class="mb-3">
            <span class="input-group-text" id="basic-addon1">Judul Video</span>
            <input type="text" class="form-control" placeholder="Ketikkan Judul Video Anda" name="judul" required>
          </div>
          <?php
            $sql = "SELECT * FROM topik ORDER BY nama_topik ASC";
            $result = $conn->query($sql);
          ?>
          <div class="mb-3">
            <span class="input-group-text" id="basic-addon1">Deskripsi Video</span>
            <input type="text" class="form-control" placeholder="Ketikkan Deskripsi Video Anda" name="deskripsi" required>
          </div>
          <div class="mb-3">
          <label class="input-group-text" for="inputGroupSelect01">Options</label>
          <select class="form-select" id="inputGroupSelect01" name="kategori" required>
            <option selected>Pilih Topik</option>
            <?php
              while ($row = $result->fetch_assoc()) {
                $kategori_id = $row['id'];
                $nama_kategori = $row['nama_topik'];
                echo "<option value='$kategori_id'>$nama_kategori</option>";
              }
              ?>
          </select>

      </div>
      <div class="mb-3">
        <label class="input-group-text" for="inputGroupFile02">Thumbnail Video</label>
        <input type="file" class="form-control" id="inputGroupFile02" name="thumbnail" required>
      </div>
      <div class="mb-3">
        <label class="input-group-text" for="inputGroupFile02">Upload Video</label>
        <input type="file" class="form-control" id="inputGroupFile02" name="video" required>
        <input type="submit" value="Submit" class="tombol" name="submit">
      </div>
      </form>
      </div>
    <div class="col">
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