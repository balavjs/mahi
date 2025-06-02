<?php
$title = "Airway Bill | Mahi Transport";
?>

<?php include('header.php'); ?>
<?php include('class/class_users.php'); ?>
<?php include('class/class_awb.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Airway Bill List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <?php

  $result_usr = new User();
  $sql_usr = $result_usr->getonerecord($id);

  foreach ($sql_usr as $list_data) {
    $id = $list_data['id'];
    $name1 = $list_data['fullname'];
    $role = $list_data['role'];

  ?>

    <?php
    if ($role == 1) {
    ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Airway Bill List</h3>
                </div>
                <div class="card-header">
                  <a href="awb_add.php">
                    <button class="btn btn-success">Add New Airway Bill</button>
                  </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th style="max-width:140px">AWB No</th>
                        <th style="max-width:115px">Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th style="max-width:130px">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $result = new DB_awb();
                      $sql = $result->list_awb();
                      $i = 0;
                      foreach ($sql as $list) {
                        $i++;

                      ?>

                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $list['awb_no']; ?></td>
                          <td><?php echo date('d-m-Y', strtotime($list['bdate'])); ?></td>
                          <td><?php echo $list['consignor'] . " - " . $list['source']; ?></td>
                          <td><?php echo $list['consignee'] . " - " . $list['destination']; ?></td>

                          <td>
                            <a href="awb_detail.php?id=<?php echo $list['id']; ?>" target="_blank"><button class="btn btn-success"><i class="nav-icon fas fa-eye"></i></button></a>
                            <a href="awb_edit.php?id=<?php echo $list['id']; ?>"><button class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></button></a>
                            <a href="awb_delete.php?id=<?php echo $list['id']; ?>" class="btn btn-danger btn-del">
                              <i class="nav-icon far fa-trash-alt"></i>
                            </a>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>S.No</th>
                        <th>AWB No</th>
                        <th>Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

    <?php
    } else {
    ?>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Users List</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">

                  <div class="alert alert-danger" role="alert">
                    <strong>Oops!</strong> You don't have access to view this page.
                  </div>
                  <h4></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  <?php
    }
  }
  ?>
  <!-- /.content -->
</div>



<?php include('footer.php'); ?>

<!-- Page specific script -->
<script>
  $(function() {
    $('#example1').DataTable({
      dom: 'lfrtip',
      buttons: [

        {
          extend: 'excelHtml5',
          text: '<i class="far fa-file-excel"></i> Excel',
          titleAttr: 'Export to Excel',
          title: 'Mahi Transport - AWB',
          exportOptions: {
            columns: ':not(:last-child)',
          }
        },
        {
          extend: 'csvHtml5',
          text: '<i class="far fa-file-alt"></i> CSV',
          titleAttr: 'CSV',
          title: 'Mahi Transport - AWB',
          exportOptions: {
            columns: ':not(:last-child)',
          }
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="far fa-file-pdf"></i> PDF',
          titleAttr: 'PDF',
          title: 'Mahi Transport - AWB',
          exportOptions: {
            columns: ':not(:last-child)',
          },
        },
      ],

      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ]
    });


  });
</script>


<script src="dist/js/sweetalert2.all.min.js"></script>

</script>

<?php
if (isset($_SESSION['success'])) {
?>
  <script type="text/javascript">
    Swal.fire({
      title: "Success!",
      text: "<?php echo $_SESSION['success']; ?>!",
      icon: "success",
    });
  </script>
<?php
  unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
?>
  <script type="text/javascript">
    Swal.fire({
      title: "Oops!",
      text: "<?php echo $_SESSION['error']; ?>!",
      icon: "error",
    });
  </script>
<?php
  unset($_SESSION['error']);
}
?>

<script type="text/javascript">
  $('.btn-del').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href; // only redirect
      }
    });
  });
</script>