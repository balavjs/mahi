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

        <?php
        $result = new DB_user();
        if (isset($_POST['submit'])) {

          $email = $_POST['email'];
          $code = rand(11111, 99999);

          $sql = $result->update_pass_code($email, $code);

          if ($sql) {


            $to = $email;
            $from = 'info@mahitansport.com';
            $fromName = 'Mahi Transport';

            $subject = 'Reset Password';

            $htmlContent = ' 
                <html> 
                <head> 
                    <title>Welcome to Mahi Transport</title> 
                </head> 
                <body> 
                    <table style="border: 1px solid #a6a6a6; width: 500px; border-collapse: collapse;" > 
                        <tr> 
                            <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                              <img src="dist/img/logo.png">
                            </th>
                        </tr>
                        <tr> 
                            <td colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                              <b>Reset Password</b><br><br>
                              Password reset for your email OTP is: <b>' . $code . '</b>
                            </td>
                        </tr>                                                 
                    </table> 
                </body> 
                </html>';

            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Additional headers 
            $headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
            $headers .= 'Cc:' . $participants . "\r\n";

            // Send email 
            if (mail($to, $subject, $htmlContent, $headers)) {
              //echo 'Email has sent successfully.'; 
              header("location:forgot_password_otp.php");
            } else {
              //echo 'Email sending failed.'; 
            }
          } else {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Email not exist.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <?php

          }
        }
        ?>

        <form action="" method="post" name="login">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-dark btn-block btn-flat" name="submit">Send</button>
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