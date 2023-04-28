<?php
require "config.php";


if (isset($_POST['save'])) {
  $topik = $_POST['topik'];
  $sql_check = "SELECT * FROM topik WHERE nama_topik = ?";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bind_param("s", $topik);
  $stmt_check->execute();
  $result_check = $stmt_check->get_result();

  if (mysqli_num_rows($result_check) > 0) {
      $response = array('message' => 'Kategori sudah pernah ada.');
  } else {
      $sql = "INSERT INTO topik (nama_topik) VALUES (?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $topik);
      $stmt->execute();
      $response = array('message' => 'Kategori berhasil ditambahkan.');

      $sql = "SELECT * FROM topik ORDER BY nama_topik ASC";
      $result = $conn->query($sql);
      $categoryList = array();
      while ($row = $result->fetch_assoc()) {
        $categoryList[] = $row;
      }
      $response['categoryList'] = $categoryList;
  }

  echo json_encode($response);
  exit;
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
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script src="https://kit.fontawesome.com/0d35f3ceae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <title>Admin</title>
    <link href="../bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#addCategoryForm').submit(function(event) {
              event.preventDefault();
              var category = $('#categoryInput').val();

              $.ajax({
                  url: 'tambah_topik.php',
                  type: 'POST',
                  data: {
                      save: true,
                      topik: category
                  },
                  dataType: 'json',
                  success: function(response) {
                      if (response.message === 'Kategori berhasil ditambahkan.') {
                          var categoryList = response.categoryList;
                          $('#categoryInput').val('');
                          categoryList.sort(function(a, b) {
                              var nama_topikA = a.nama_topik.toUpperCase();
                              var nama_topikB = b.nama_topik.toUpperCase();
                              if (nama_topikA < nama_topikB) {
                                  return -1;
                              }
                              if (nama_topikA > nama_topikB) {
                                  return 1;
                              }
                              return 0;
                          });
                          var categoryTableBody = $('#categoryTableBody');
                          categoryTableBody.empty();
                          $.each(categoryList, function(index, category) {
                              categoryTableBody.append('<tr><td>' + category.nama_topik + '</td></tr>');
                          });
                          alert(response.message);
                      } else {
                          alert(response.message);
                      }
                  },
                  error: function(xhr, status, error) {
                      console.log(xhr.responseText);
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
            <a class="nav-link" aria-current="page" href="admin.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href="tambah_topik.php">
              <span data-feather="file" class="align-text-bottom"></span>
              Tambah Topik
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Topik</h1>
      </div>

      <h5>Topik Yang Sudah Ada</h5>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
            <tbody id="categoryTableBody">
                <?php
                  $sql = "SELECT * FROM topik ORDER BY nama_topik ASC";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                    $nama_topik = $row['nama_topik'];
                    echo "<tr><td>$nama_topik</td></tr>";
                  }
                ?>
            </tbody>
        </table>
    </div>

    <h5 style="margin-top:20px;">Tambah Topik</h5>
    <form method="POST" enctype="multipart/form-data" id="addCategoryForm">
        <div style="margin-left:0px; margin-top:10px; width:70%">
            <input class="form-control" type="text" placeholder="nama topik" name="topik" id="categoryInput">
        </div>  
        <div>
            <button class="button5" style=" margin-top:40px;" name="save" id="saveCategoryButton">Save</button>
        </div>
    </form>
</body>
</html>