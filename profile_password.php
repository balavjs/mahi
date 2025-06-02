<?php
ob_start();
$title = "Profile Password Update | Mahi Transport";
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

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Profile password update</h3>
            </div>

            <?php

            $result_usr = new User();
            $sql_usr = $result_usr->getonerecord($id);

            foreach ($sql_usr as $list_data) {
              $id = $list_data['id'];
              $name1 = $list_data['fullname'];
              $role = $list_data['role'];
            ?>

              <div class="card-body">
                <!-- general form elements disabled -->

                <?php
                $result = new DB_user();

                if (isset($_POST['update'])) {

                  $str = $_GET['id'];
                  $str1 = substr($str, 5, -5);
                  $id = $str1;

                  $pass = md5($_POST['pass']);

                  $sql = $result->update_profile_pass($id, $pass);

                  if ($sql) {
                    $_SESSION['success'] = "Password updated successfully";
                    header('location:profile_view.php');
                  } else {
                    $_SESSION['error'] = "Password not updated!";
                    header('location:profile_view.php');
                  }
                }
                ?>

                <script type="text/javascript">
                  function validate() {
                    var firstpassword = document.myform.pass.value;
                    var secondpassword = document.myform.pass1.value;

                    if (firstpassword == secondpassword) {
                      return true;
                    } else if (firstpassword.length < 6) {
                      alert("Password must be at least 6 characters long.");
                      return false;
                    } else {
                      alert("password must be same!");
                      return false;
                    }
                  }
                </script>

                <form method="post" name="myform" onsubmit="return validate()">

                  <?php
                  $str = $_GET['id'];

                  $str1 = substr($str, 5, -5);
                  //echo $str1;

                  $id = $str1;
                  //$id = $_GET['id'];

                  $result1 = new DB_user();
                  $sql1 = $result1->get_one_user($id);

                  while ($row = mysqli_fetch_array($sql1)) {

                  ?>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="Enter the password" name="pass" required>
                        </div>

                        <div class="form-group">
                          <label>Re Password</label>
                          <input type="password" class="form-control" placeholder="Enter the password" name="pass1" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                          <button type="submit" class="btn btn-success" name="update">Update Password</button>
                        </div>
                      </div>
                    </div>
                </form>
              </div>
            <?php
                  }
            ?>
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