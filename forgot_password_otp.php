<?php
session_start();
include_once 'class/class_users.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mahi Transport | Log in</title>
  <link rel="icon" type="image/x-icon" href="dist/img/favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .title_div {
      max-width: 850px !important;
      margin: 0 auto !important;
      margin-top: 7% !important;
      text-align: center;
      background-color: rgba(255, 255, 255, 0.3);
      padding: 20px;
    }

    .title_div h2 {
      color: #7b0304 !important;
    }

    .login-box-msg {
      /*color:#ff0000 !important;*/
      font-weight: 600 !important;
      font-size: 20px !important;
    }

    .login-box {
      /*margin-top: 20% !important;*/
    }

    .login-page {
      background-position: center top;
      background-repeat: no-repeat;
      background-size: cover !important;
    }

    .login-card-body,
    .register-card-body,
    .login-box .card {
      background-color: rgba(255, 255, 255, 0.3);
    }
  </style>
</head>

<body class="hold-transition login-page">

  <div class="login-box">

    <div class="card">
      <div class="card-body login-card-body">
        <img src="dist/img/logo.png" alt="Logo" class="" style="max-width: 70%; display: block; margin: 0 auto; padding-bottom: 10px;">
        <p class="login-box-msg text-dark">Welcome To Mahi Transport</p>
        <div class="alert alert-success">
          <strong>Success!</strong> OTP Sent to your Email ID.
        </div>
        <?php
        $result = new DB_user();
        if (isset($_POST['submit'])) {

          $pass = md5($_POST['pass']);
          $code  = $_POST['code'];

          $sql = $result->update_pass_otp($code, $pass);
          if ($sql) {
        ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Password updated successfully. Click here to <a href="login.php">Login</a>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="window.location.href='login.php'">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          <?php
          } else {
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Password not updated.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <?php

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
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="OTP" name="code">
            <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pass">
            <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Re-Password" name="pass1">
            <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-dark btn-block btn-flat" name="submit">Update</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


      </div>
      <!-- /.login-card-body -->
    </div>

  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>