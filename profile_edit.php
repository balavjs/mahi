<?php
ob_start();
$title = "Profile Update | Zriya Solutions";
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
              <h3 class="card-title">Profile Update</h3>
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

                  define('SITE_ROOT', realpath(dirname(__FILE__)));

                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $phone = $_POST['phone'];
                  $address = $_POST['address'];
                  //$role = $_POST['role'];
                  //$status = $_POST['status'];
                  $profile_image1 = $_FILES['profile_image']['name'];

                  if ($profile_image1 != "") {
                    $profile_image1  = "profile" . time() . $_FILES['profile_image']['name'];
                    move_uploaded_file($_FILES['profile_image']['tmp_name'], SITE_ROOT . "/uploads/img/" . $profile_image1);

                    $profile_image = $profile_image1;
                  } else {
                    $sql1 = $result->get_one_user($id);
                    foreach ($sql1 as $list_app) {
                      $profile_image = $list_app['profile_image'];
                    }
                  }

                  $sql = $result->update_profile($id, $fname, $lname, $phone, $address, $profile_image);

                  if ($sql) {
                    $_SESSION['success'] = "Profile updated successfully";
                    header('location:profile_view.php');
                  } else {
                    $_SESSION['error'] = "Profile not updated!";
                    header('location:profile_view.php');
                  }
                }
                ?>



                <form method="post" enctype="multipart/form-data">

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
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Profile Image</label><br>
                          <?php
                          if ($row['profile_image'] != "") { ?>
                            <img src="uploads/img/<?php echo $row['profile_image']; ?>" width="180" height="200" style="border: 2px solid #b0b2b5; border-radius: 4px; box-shadow: 0px 2px 5px #a59f9f;">
                          <?php
                          } else {
                          ?>
                            <img src="dist/img/placeholder.jpg" width="180" height="200" style="border: 2px solid #b0b2b5; border-radius: 4px; box-shadow: 0px 2px 5px #a59f9f;">
                          <?php
                          }
                          ?><br><br>
                          Size: (180 X 200) PX<br><br>
                          <input type="file" class="form-control-file" name="profile_image" id="imgInp" accept="image/*">

                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" placeholder="Enter the first name" name="fname" value="<?php echo $row['fname']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" placeholder="Enter the last name" name="lname" value="<?php echo $row['lname']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" required disabled>
                        </div>
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="number" class="form-control" placeholder="Enter the phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Address</label>
                          <textarea class="form-control" rows="3" placeholder="Enter the address" name="address" required><?php echo $row['address']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-success" name="update">Update</button>
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