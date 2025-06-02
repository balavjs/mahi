<?php

require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

$generator = new BarcodeGeneratorPNG();

$title = "Airway Bill Details | Mahi Transport";
?>

<?php include('header.php'); ?>
<?php include('class/class_awb.php'); ?>

<style>
    .barcode div {
        margin: 0 auto;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Consulting RFQ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="awb_view.php">Airway Bill</a></li>
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

        if ($role == 1) {
    ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header card-zg">
                                    <h3 class="card-title">Airway Bill Details</h3>
                                </div>

                                <div class="card-body">
                                    <a href="awb_view.php">
                                        <button class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back to AWB List</button>
                                    </a><br><br>

                                    <table id="example1" class="table table-bordered">

                                        <?php
                                        $id = $_GET['id'];
                                        $result = new DB_awb();
                                        $sql = $result->get_one_awb($id);
                                        $i = 0;
                                        foreach ($sql as $list) {
                                            $i++;

                                        ?>
                                            <tr style="vertical-align: middle;">
                                                <td colspan="6">
                                                    <div class="row">
                                                        <div class="col-sm-3 text-center">
                                                            <img src="dist/img/logo.png">
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <h4><b>MAHI TRANSPORT</b></h4>
                                                            <p>18/1, Govindarajalu Street, Saravanabhavan Hotel Back Side,
                                                                Avinashi Road, Tirupur - 641 602.<br>
                                                                Phone: +91 99524 14696<br>
                                                                Email-ID: muthuraj@mahitransport.com<br>
                                                                GSTIN: 33IUMPM2724K1Z9
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">
                                                    <b>Date:</b> <?php echo date('d-m-Y', strtotime($list['bdate'])); ?>
                                                </td>
                                                <td colspan="2" class="text-center">
                                                    <b>BOOKING CHALLAN</b>
                                                </td>
                                                <td colspan="2" class="text-center" style="margin: 0 auto;">
                                                    <?php
                                                    $barcodeData = base64_encode($generator->getBarcode($list['awb_no'], $generator::TYPE_CODE_128));
                                                    ?>
                                                    <div style="text-align: center;">
                                                        <img src="data:image/png;base64,<?= $barcodeData ?>" alt="Barcode" />
                                                    </div>
                                                    <b>Airway Bill No:</b> <?php echo $list['awb_no']; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td rowspan="5" colspan="2">
                                                    <p style="line-height: 2;">
                                                        <b>From:</b> <?php echo $list['consignor']; ?><br>
                                                        <b>Consignor:</b> <?php echo $list['source']; ?><br>
                                                        <b>Phone:</b> <?php echo $list['cphone']; ?><br>
                                                        <b>GST No:</b> <?php echo $list['sgst']; ?>
                                                    </p>

                                                </td>
                                                <td rowspan="5" colspan="2">
                                                    <p style="line-height: 2;">
                                                        <b>To:</b> <?php echo $list['consignee']; ?><br>
                                                        <b>Consignor:</b> <?php echo $list['destination']; ?><br>
                                                        <b>Phone:</b> <?php echo $list['dphone']; ?><br>
                                                        <b>GST No:</b> <?php echo $list['dgst']; ?>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><b>Type:</b> <?php echo $list['type']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Frieght Charges:</b></td>
                                                <td class="text-right"><?php echo $list['frieght']; ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td><b>Loading Charges:</b></td>
                                                <td class="text-right"><?php echo $list['loading']; ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td><b>Other Charges:</b></td>
                                                <td class="text-right"><?php echo $list['others']; ?>.00</td>
                                            </tr>

                                            <tr>
                                                <td><b>Qty:</b> <?php echo $list['qty']; ?></td>
                                                <td><b>Description:</b> <?php echo $list['description']; ?></td>
                                                <td><b>Invoice:</b> <?php echo $list['inv_no']; ?></td>
                                                <td><b>Value:</b> <?php echo $list['value']; ?></td>
                                                <td><b>Total:</b></td>
                                                <td class="text-right"><?php echo $list['total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <b>Terms & Conditions</b><br>
                                                    This Luggage is booked by accepting the terms and conditions of the transport
                                                    company.<br>
                                                    <b>Delivery Office</b><br>
                                                    NEAR LIC OFFICE BCKSIDE, CHAMARAJPET BANGALORE-560 018<br>
                                                    Cell : +91 7975733732, +91 8884853640
                                                </td>
                                                <td colspan="2" class="text-center">
                                                    <b>MAHI TRANSPORT</b><br>
                                                    <img src="dist/img/sign.jpg" alt="">
                                                    <br>
                                                    Auth Sign
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </table>

                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <form method="post" action="awb_pdf.php" target="_blank">
                                                <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                                                <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Export PDF" name="submit" style="margin-right: 3px;" target="_blank"><i class="fas fa-file-pdf"></i>&nbsp; Download PDF</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header card-zg">
                                    <h3 class="card-title">Airway Bill Details</h3>
                                </div>

                                <!-- /.card-header -->
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