<?php
session_start();
include_once 'class/class_user.php';
$user = new User();

$id = $_SESSION['id'];

if (!$user->get_session()) {
  header("location:login.php");
}

if (isset($_GET['logout'])) {
  $user->user_logout();
  header("location:login.php");
}
//echo $user->get_fullname($uid);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo isset($title) ? $title : "Mahi | Mahi Transport"; ?>
  </title>
  <link rel="icon" type="image/x-icon" href="dist/img/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <style type="text/css">
    .dataTables_length {
      display: contents;

    }

    .dataTables_length label {
      margin-left: 20px;
    }

    .dataTables_length .custom-select-sm {
      font-size: 100%;
    }

    #profile_image {
      width: 2.5em;
      border-radius: 4px;
      border: 1px solid #c2c7d0;
    }

    .user-panel {
      align-items: center;
    }

    .nav li a,
    .user-panel a,
    .nav p {
      font-family: 'Play', sans-serif !important;
      font-weight: 600;
    }

    .brand-text,
    .navbar-light .navbar-nav .nav-link {
      font-family: 'Play', sans-serif;
      font-weight: 600 !important;
    }

    .navbar-light .navbar-nav .nav-link {
      color: #17353d !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="120" width="120">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <img src="dist/img/logo.png">
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=logout" role="button">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-purple elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image elevation-1">
        <span class="brand-text font-weight-light">Mahi Transport</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <?php

            $result1 = new User();
            $sql1 = $result1->getonerecord($id);

            while ($row = mysqli_fetch_array($sql1)) {
              $profile_image = $row['profile_image'];

              if ($profile_image != "") {
            ?>
                <img src="uploads/img/<?php echo $profile_image; ?>" class="elevation-2" alt="User Image" id="profile_image">
              <?php
              } else {
              ?>
                <img src="dist/img/placeholder.jpg" class="elevation-2" alt="User Image" id="profile_image">
            <?php
              }
            }
            ?>
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $user->get_fullname($id); ?> </a>
          </div>
        </div>

        <?php

        $result_usr = new User();
        $sql_usr = $result_usr->getonerecord($id);

        foreach ($sql_usr as $list_data) {
          $id = $list_data['id'];
          $name1 = $list_data['fullname'];
          $role = $list_data['role'];

        ?>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="awb_view.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Airway Bill
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="awb_search.php" class="nav-link">
                  <i class="nav-icon fas fa-file-csv"></i>
                  <p>
                    Manifiest
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="profile_view.php" class="nav-link">
                  <i class="nav-icon fas fa-user-alt"></i>
                  <p>
                    My Profile
                  </p>
                </a>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
    <?php
        }
    ?>
    <!-- /.sidebar -->
    </aside>

    <style type="text/css">
      #example1_filter label {
        float: right;
        margin-bottom: 20px;
      }

      #example1_filter {
        display: contents;
      }
    </style>