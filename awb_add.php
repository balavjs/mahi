<?php
ob_start();
$title = "Airway Bill Add | Mahi Transport";
?>

<?php include('header.php'); ?>
<?php include('class/class_awb.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Airway Bills</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Airway Bills</li>
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
              <h3 class="card-title">Add new Airway Bill</h3>
            </div>

            <div class="card-body">

              <?php

              $result_usr = new User();

              $sql_usr = $result_usr->getonerecord($id);

              foreach ($sql_usr as $list_data) {
                $id = $list_data['id'];
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];

                if ($role == 1) {
              ?>

                  <!-- general form elements disabled -->

                  <?php
                  $result = new DB_awb();
                  if (isset($_POST['submit'])) {

                    $awb_no = $_POST["awb_no"];
                    $bdate = $_POST["bdate"];
                    $year = $_POST["year"];
                    $consignor = $_POST["consignor"];
                    $source = $_POST["source"];
                    $cphone = $_POST["cphone"];
                    $sgst = $_POST["sgst"];
                    $consignee = $_POST["consignee"];
                    $destination = $_POST["destination"];
                    $dphone = $_POST["dphone"];
                    $dgst = $_POST["dgst"];
                    $type = $_POST["type"];
                    $qty = $_POST["qty"];
                    $description = $_POST["description"];
                    $inv_no = $_POST["inv_no"];
                    $value = $_POST["value"];
                    $frieght = $_POST["frieght"];
                    $loading = $_POST["loading"];
                    $others = $_POST["others"];
                    $total = $_POST["total"];
                    $status = "1";

                    $sql = $result->insert($awb_no, $bdate, $year, $consignor, $source, $cphone, $sgst, $consignee, $destination, $dphone, $dgst, $type, $qty, $description, $inv_no, $value, $frieght, $loading, $others, $total, $status);

                    if ($sql) {
                      $_SESSION['success'] = "Airwaybill created successfully";
                      header('location:awb_view.php');
                    } else {
                      $_SESSION['error'] = "Airwaybill not created!";
                      header('location:awb_view.php');
                    }
                  }
                  ?>

                  <form method="post" name="myform" onsubmit="return validate()">

                    <?php

                    $year = date('y');

                    // Determine financial year
                    if (date('m') >= 4) {
                      $d = date('Y-m-d', strtotime('+1 years'));
                      $y1 = date('y') . '/' . date('y', strtotime($d));
                      $y2 = date('y') . date('y', strtotime($d));
                    } else {
                      $d = date('Y-m-d', strtotime('-1 years'));
                      $y1 = date('y', strtotime($d)) . '/' . date('y');
                      $y2 = date('y', strtotime($d)) . date('y');
                    }

                    $result = new DB_awb();
                    $sql = $result->list_awb_last1();

                    $max_last_id = 0;
                    foreach ($sql as $list) {
                      $string = $list['awb_no'];
                      $exploded = explode('-', $string);
                      if (!empty($exploded)) {
                        $last_part = end($exploded);
                        // Extract the last 5 digits of the last part
                        $last_id = (int) substr($last_part, -5); // Get only the last 5 digits
                        if ($last_id > $max_last_id) {
                          $max_last_id = $last_id;
                        }
                      }
                    }

                    // Get count for the financial year
                    $sql2 = $result->list_awb_year($y1);
                    $row_cnt = $sql2->num_rows;

                    // Determine next ID
                    if ($row_cnt == 0) {
                      $next_id = 1;
                    } else {
                      $next_id = $max_last_id + 1;
                    }

                    // Ensure next_id is within 4 digits
                    if ($next_id > 99999) {
                      die('Error: ID exceeded maximum 5 digits.');
                    }

                    // Format 4 digits
                    $next_id_padded = str_pad($next_id, 5, '0', STR_PAD_LEFT);

                    // Build new invoice number
                    $new_awb_no = 'MT-' . $y2 . $next_id_padded;

                    // echo "New Invoice No: " . $new_awb_no . "<br>";
                    ?>

                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Airway Bill No</label>
                          <input type="text" class="form-control" placeholder="Enter the inv" name="awb_no" value="<?php echo $new_awb_no; ?>" readonly required>
                          <input type="hidden" name="year" value="<?php echo $y1; ?>" required>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Date</label>
                          <input type="date" class="form-control" placeholder="Enter the date" name="bdate" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Type</label>
                          <select class="form-control" name="type" required>
                            <option value="" selected disabled>-- Select Type --</option>
                            <option value="Credit">Credit</option>
                            <option value="To-Pay">To-Pay</option>
                            <option value="Paid">Paid</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <fieldset class="border p-4" style="border-radius:10px;">
                          <legend class="float-none w-auto">Source</legend>
                          <div class="form-group">
                            <label>Consignor</label>
                            <input type="text" class="form-control" placeholder="Enter the consignor name" name="consignor" required>
                          </div>
                          <div class="form-group">
                            <label>From</label>
                            <input type="text" class="form-control" placeholder="Enter the from city" name="source" required>
                          </div>
                          <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" placeholder="Enter the from mobile" name="cphone">
                          </div>
                          <div class="form-group">
                            <label>GST No</label>
                            <input type="text" class="form-control" placeholder="Enter the from GST" name="sgst">
                          </div>
                        </fieldset>
                      </div>

                      <div class="col-md-6">
                        <fieldset class="border p-4" style="border-radius:10px;">
                          <legend class="float-none w-auto">Destination</legend>
                          <div class="form-group">
                            <label>Consignee</label>
                            <input type="text" class="form-control" placeholder="Enter the consignee name" name="consignee" required>
                          </div>
                          <div class="form-group">
                            <label>To</label>
                            <input type="text" class="form-control" placeholder="Enter the to city" name="destination" required>
                          </div>
                          <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" placeholder="Enter the to mobile" name="dphone">
                          </div>
                          <div class="form-group">
                            <label>GST No</label>
                            <input type="text" class="form-control" placeholder="Enter the to GST" name="dgst">
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Invoice No</label>
                          <input type="text" class="form-control" placeholder="Enter the Inv no " name="inv_no">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Qty</label>
                          <input type="number" class="form-control" placeholder="Qty" name="qty" required>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Description</label>
                          <input type="text" class="form-control" placeholder="Description" name="description" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Value</label>
                          <input type="number" class="form-control" placeholder="Value" name="value">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Frieght Charges</label>
                          <input type="number" class="form-control" placeholder="Enter the frieght" name="frieght" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Loading Charges</label>
                          <input type="number" class="form-control" placeholder="Loading Charges" name="loading" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Others</label>
                          <input type="number" class="form-control" placeholder="Other Charges" name="others" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Total</label>
                          <input type="number" class="form-control" placeholder="Total" name="total" readonly required>
                        </div>
                      </div>
                    </div>
                    <!-- 
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    -->
                    <div class="row">
                      <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                          <button type="submit" class="btn btn-success" name="submit" id="submit">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>

            </div>

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
                        <h3 class="card-title">Airway bill List</h3>
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
  <!-- /.content -->
</div>

<?php include('footer.php'); ?>

<script>
  function calculateTotal() {
    // Read values
    var freight = parseFloat(document.querySelector('input[name="frieght"]').value) || 0;
    var loading = parseFloat(document.querySelector('input[name="loading"]').value) || 0;
    var others = parseFloat(document.querySelector('input[name="others"]').value) || 0;

    // Calculate sum
    var total = freight + loading + others;

    // Set total
    document.querySelector('input[name="total"]').value = total.toFixed(2); // optional 2 decimal
  }

  // Attach event listeners
  document.querySelector('input[name="frieght"]').addEventListener('input', calculateTotal);
  document.querySelector('input[name="loading"]').addEventListener('input', calculateTotal);
  document.querySelector('input[name="others"]').addEventListener('input', calculateTotal);
</script>