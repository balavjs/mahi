<?php
$title = "Airway Bill Update | Mahi Transport";
ob_start();
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
                    <h1>Airway Bill Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="awb_view.php">Airway Bill List</a></li>
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

                    <div class="card">
                        <div class="card-header card-zg">
                            <h3 class="card-title">Update Airway Bill Details</h3>
                        </div>

                        <?php
                        $result_usr = new User();
                        $sql_usr = $result_usr->getonerecord($id);

                        foreach ($sql_usr as $list_data) {
                            $id = $list_data['id'];
                            $name1 = $list_data['fullname'];
                            $role = $list_data['role'];

                            if ($role == 1) {
                        ?>

                                <div class="card-body">


                                    <?php
                                    $result = new DB_awb();

                                    if (isset($_POST['update'])) {

                                        $id = $_GET['id'];
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

                                        $sql = $result->update($id, $bdate, $consignor, $source, $cphone, $sgst, $consignee, $destination, $dphone, $dgst, $type, $qty, $description, $inv_no, $value, $frieght, $loading, $others, $total, $status);

                                        if ($sql) {
                                            $_SESSION['success'] = "Airway Bill updated successfully";
                                            header('location:awb_view.php');
                                        } else {
                                            $_SESSION['error'] = "Airway Bill not updated!";
                                            header('location:awb_view.php');
                                        }
                                    }
                                    ?>

                                    <form method="post">
                                        <?php
                                        $id = $_GET['id'];
                                        $result1 = new DB_awb();
                                        $sql1 = $result1->get_one_awb($id);

                                        while ($row = mysqli_fetch_array($sql1)) {
                                        ?>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label>Airway Bill No</label>
                                                        <input type="text" class="form-control" placeholder="Enter the inv" name="awb_no" value="<?php echo $row['awb_no']; ?>" readonly required>
                                                        <input type="hidden" name="year" value="<?php echo $y1; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                        <input type="date" class="form-control" placeholder="Enter the date" name="bdate" value="<?php echo $row['bdate']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type" required>
                                                            <option value="" selected disabled>-- Select Type --</option>
                                                            <option value="Credit" <?php if ($row['type'] == 'Credit') {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Credit</option>
                                                            <option value="To-Pay" <?php if ($row['type'] == 'To-Pay') {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>To-Pay</option>
                                                            <option value="Paid" <?php if ($row['type'] == 'Paid') {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Paid</option>
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
                                                            <input type="text" class="form-control" placeholder="Enter the consignor name" name="consignor" value="<?php echo $row['consignor']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>From</label>
                                                            <input type="text" class="form-control" placeholder="Enter the from city" name="source" value="<?php echo $row['source']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="number" class="form-control" placeholder="Enter the from mobile" name="cphone" value="<?php echo $row['cphone']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>GST No</label>
                                                            <input type="text" class="form-control" placeholder="Enter the from GST" name="sgst" value="<?php echo $row['sgst']; ?>">
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-6">
                                                    <fieldset class="border p-4" style="border-radius:10px;">
                                                        <legend class="float-none w-auto">Destination</legend>
                                                        <div class="form-group">
                                                            <label>Consignee</label>
                                                            <input type="text" class="form-control" placeholder="Enter the consignee name" name="consignee" value="<?php echo $row['consignee']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>To</label>
                                                            <input type="text" class="form-control" placeholder="Enter the to city" name="destination" value="<?php echo $row['destination']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="number" class="form-control" placeholder="Enter the to mobile" name="dphone" value="<?php echo $row['dphone']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>GST No</label>
                                                            <input type="text" class="form-control" placeholder="Enter the to GST" name="dgst" value="<?php echo $row['dgst']; ?>">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Invoice No</label>
                                                        <input type="text" class="form-control" placeholder="Enter the Inv no" name="inv_no" value="<?php echo $row['inv_no']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="number" class="form-control" placeholder="Qty" name="qty" value="<?php echo $row['qty']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" class="form-control" placeholder="Description" name="description" value="<?php echo $row['description']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Value</label>
                                                        <input type="number" class="form-control" placeholder="Value" name="value" value="<?php echo $row['value']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Frieght Charges</label>
                                                        <input type="number" class="form-control" placeholder="Enter the frieght" name="frieght" value="<?php echo $row['frieght']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Loading Charges</label>
                                                        <input type="number" class="form-control" placeholder="Loading Charges" name="loading" value="<?php echo $row['loading']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Others</label>
                                                        <input type="number" class="form-control" placeholder="Other Charges" name="others" value="<?php echo $row['others']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Total</label>
                                                        <input type="number" class="form-control" placeholder="Total" name="total" value="<?php echo $row['total']; ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- textarea -->
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                <?php
                                        }
                                ?>
                                </div>

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
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <strong>Oops!</strong> You don't have access to view this page.
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