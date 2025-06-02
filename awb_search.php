<?php
$title = "Manifiest | Mahi Transport";
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
                    <h1>Airway Bill Search</h1>
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
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">AWB Search</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Select Date</label>
                                                    <input type="date" class="form-control" placeholder="Enter the date" name="bdate" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 align-self-end">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block" name="submit">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->

                                <?php
                                $result = new DB_awb();
                                if (isset($_POST['submit'])) {
                                    $bdate = $_POST["bdate"];

                                    $sql = $result->list_awb_by_date($bdate);

                                    if ($sql && mysqli_num_rows($sql) > 0) {
                                        // echo $bdate;
                                ?>

                                        <div class="card-body">
                                            <h4 class="text-danger">Searched AWB List for <b><?php echo $bdate; ?></b></h4>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form method="post" action="awb_manifiest_pdf.php" target="_blank">
                                                        <input type="hidden" name="bdate" value="<?php echo $bdate; ?>">
                                                        <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Export PDF" name="submit" style="margin-right: 3px;" target="_blank"><i class="fas fa-file-download"></i>&nbsp; Export PDF</button>
                                                    </form>
                                                </div>
                                            </div><br>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th style="max-width:140px">AWB No</th>
                                                        <th style="max-width:115px">Date</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th style="max-width:130px">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $sql = $result->list_awb_by_date($bdate);

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

                                                            <td><?php echo $list['total']; ?></td>
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
                                                        <th>Total</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    <?php
                                    } else {
                                    ?>
                                        <div class="card-body">
                                            <h4 class="text-danger">Searched AWB List for <b><?php echo $bdate; ?></b></h4>
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Oops!</strong> No AWB's found on searched creteria!.
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
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
                                    <h3 class="card-title">AWB List</h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oops!</strong> You don't have access to view this page.
                                    </div>
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