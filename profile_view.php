<?php
$title = "Profile | Mahi Transport";
?>

<?php include('header.php'); ?>
<?php include('class/class_users.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Profile</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th width="240px">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $result = new DB_user();
                    $sql = $result->get_one_user($id);
                    $i = 0;
                    foreach ($sql as $list) {
                      $i++;

                      $before = rand(10000, 90000);
                      $after = rand(10000, 90000);
                      //print rand(10000, 90000); 
                      //print rand(10000, 90000);
                    ?>

                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list['emp_id']; ?></td>
                        <td><?php echo $list['fname']; ?> <?php echo $list['lname']; ?></td>
                        <td><?php echo $list['email']; ?></td>
                        <td><?php echo $list['phone']; ?></td>



                        <td>
                          <a href="profile_detail.php?id=<?php echo $before . $list['id'] . $after; ?>" target="_blank"><button class="btn btn-success"><i class="nav-icon fas fa-eye"></i></button></a>
                          <a href="profile_edit.php?id=<?php echo $before . $list['id'] . $after; ?>"><button class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></button></a>
                          <a href="profile_password.php?id=<?php echo $before . $list['id'] . $after; ?>"><button class="btn btn-secondary"> Change Password</button></a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>S.No</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
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
          title: 'Mahi Transport - User Profiles',
          exportOptions: {
            columns: ':not(:last-child)',
          }
        },
        {
          extend: 'csvHtml5',
          text: '<i class="far fa-file-alt"></i> CSV',
          titleAttr: 'CSV',
          title: 'Mahi Transport - User Profiles',
          exportOptions: {
            columns: ':not(:last-child)',
          }
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="far fa-file-pdf"></i> PDF',
          titleAttr: 'PDF',
          title: 'Mahi Transport - User Profiles',
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