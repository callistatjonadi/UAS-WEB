<?php
require "config.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM video WHERE user_id = '$user_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
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
    
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <script src="https://kit.fontawesome.com/0d35f3ceae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <title>Admin</title>
    <link href="../bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function(){
        $(".terima-btn").click(function(){
          var id_video = $(this).data("id"); 
        //   var clickedCard = $(this).closest('.card');
          $.post("edit_pembelajaran.php", 
          {
            id_video_terima: id_video
          },
          function(data, status){
            if (data == "success") {
              alert("Video Diterima.");
            //   clickedCard.find('.bi-check-lg').show();
              location.reload();
            }
          });
        });

      $(".tolak-btn").click(function(){
        var id_video = $(this).data("id");
        $.post("edit_pembelajaran.php",
        {
          id_video_tolak: id_video
        },
        function(data, status){
            if (data == "success") {
              alert("Video Ditolak.");
            //   clickedCard.find('.bi-check-lg').show();
              location.reload();
            }
        });
        });
        
      });
      

    </script>


    <style>
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
      .profil{
        border-radius: 50%;
      }
      .icon {
        display: inline-block;
        vertical-align: middle;
        margin-right: 5px;
       }
    </style>

    

</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Company name</a>
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

    <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tambah_topik.php">
              <span data-feather="file" class="align-text-bottom"></span>
              Tambah Topik
            </a>
          </li>

        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
      </div>
      
      <div id="tab-panel-3" class="tab-panel">
                <div class="container">
                      <div class="row kanan">
                      <?php 
                          if(isset($_GET['get_id_user'])){
                            $id_user = $_GET['get_id_user'];
                            $sql = "SELECT * FROM video WHERE user_id = '$id_user'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();

                          if(mysqli_num_rows($result) > 0){
                            while($row_video = $result->fetch_assoc()){
                              $video_id = $row_video['id'];
                            //   $user_id = $row_video['user_id'];
                            //   $sql_user = "SELECT * FROM student WHERE id = '$user_id'";
                            //   $stmt_user = $conn->prepare($sql_user);
                            //   $stmt_user->execute();
                            //   $result_user = $stmt_user->get_result();
                            //   $row_user = $result_user->fetch_assoc();
                            ?>
                              <div class="card" style="margin-right:20px; margin-bottom:20px; width:18rem;">
                              <a href="admin_video.php?get_id_video=<?= $video_id; ?>">  
                                <img src="media/<?=$row_video['thumbnail']; ?>" class="card-img-top" alt="..." style="margin-top: 12px; height: 200px;">
                              </a>
                              <div class="card-body">
                                <h5 class="card-title tengah"><?=$row_video['judul']; ?></h5>
                                <p class="card-text" style="height: 40px;"><?=$row_video['deskripsi']; ?></p>
                                <div class="d-flex flex-row">
                                    <button class="btn btn-success terima-btn" type="button" data-id="<?= $video_id; ?>" style="width: 45%; margin-right: 23px;">Terima</button>
                                    <button class="btn btn-danger tolak-btn" type="button" data-id="<?= $video_id; ?>" style="width: 45%;">Tolak</button>

                                </div>
                                <p>
                                    <?php if ($row_video['status'] == 'terima'){ ?>
                                    <i class="icon bi bi-check-lg text-success ms-auto align-self-center d-block" style="margin-top: 10px; margin-bottom: -15px; font-size: 20px;"> Diterima</i> 
                                    <?php } elseif ($row_video['status'] == 'pending'){ ?>
                                        <i class="icon bi bi-clock text-warning ms-auto align-self-center d-block" style="margin-top: 10px; margin-bottom: -15px; font-size: 20px;">  Pending</i> 
                                    <?php } elseif ($row_video['status'] == 'tolak'){ ?>
                                      <i class="icon bi bi-x-lg text-danger ms-auto align-self-center d-block" style="margin-top: 10px; margin-bottom: -15px; font-size: 20px;">  Ditolak</i> 
                                    <?php } ?>
                                </p>
                              </div>
                              </div>
                            <?php
                            }
                            }
                            }
                            ?>
                          </div>
                      </div>
                    
                </div>      


      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
              <td>text</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>placeholder</td>
              <td>irrelevant</td>
              <td>visual</td>
              <td>layout</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>data</td>
              <td>rich</td>
              <td>dashboard</td>
              <td>tabular</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>information</td>
              <td>placeholder</td>
              <td>illustrative</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>text</td>
              <td>random</td>
              <td>layout</td>
              <td>dashboard</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>dashboard</td>
              <td>irrelevant</td>
              <td>text</td>
              <td>placeholder</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>dashboard</td>
              <td>illustrative</td>
              <td>rich</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>placeholder</td>
              <td>tabular</td>
              <td>information</td>
              <td>irrelevant</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
              <td>text</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>placeholder</td>
              <td>irrelevant</td>
              <td>visual</td>
              <td>layout</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>data</td>
              <td>rich</td>
              <td>dashboard</td>
              <td>tabular</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>information</td>
              <td>placeholder</td>
              <td>illustrative</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>text</td>
              <td>placeholder</td>
              <td>layout</td>
              <td>dashboard</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>dashboard</td>
              <td>irrelevant</td>
              <td>text</td>
              <td>visual</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>dashboard</td>
              <td>illustrative</td>
              <td>rich</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>random</td>
              <td>tabular</td>
              <td>information</td>
              <td>text</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
    
</body>
</html>