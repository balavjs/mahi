<?php
$title = "Dashboard | Mahi Transport";
?>

<?php include('header.php'); ?>
<?php include('class/class_awb.php'); ?>

<?php

$result_usr = new User();

$sql_usr = $result_usr->getonerecord($id);

foreach ($sql_usr as $list_data) {
  $id = $list_data['id'];
  $name1 = $list_data['fullname'];
  $role = $list_data['role'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php

    $result = new DB_awb();
    if ($role == 1) {
      $sql = $result->list_awb();
    } else {
      $sql = $result->get_one_awb($id);
    }
    $num_awb = mysqli_num_rows($sql);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <?php
          if ($role == 1) {
          ?>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info" style="background-color: #214477 !important;">
                <div class="inner">
                  <h3><?php echo $num_awb; ?></h3>
                  <p>Airway Bills</p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="awb_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php
          }
        }
?>

  </div>
  <!-- /.content-wrapper -->

  <?php include('footer.php'); ?>