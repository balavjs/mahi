<?php

require_once __DIR__ . '/vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

$generator = new BarcodeGeneratorPNG();


include('class/class_awb.php');

$result = new DB_awb();

if (isset($_POST['submit'])) {

    $id         = $_POST['id'];

    // a new instance of the library

    //$mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf([
        'orientation' => 'P',
        'default_font' => 'Lato-Regular',
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_top' => 5,
        'margin_bottom' => 5,
    ]);


    //$mpdf->SetCreator(PDF_CREATOR);
    $mpdf->SetAuthor('Mahi');
    $mpdf->SetTitle('Mahi Transport');
    $mpdf->SetSubject('Mahi Transport');
    //$mpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $mpdf->autoScriptToLang = true;
    $mpdf->baseScript = 1;
    $mpdf->autoLangToFont = true;
    $mpdf->showImageErrors = true;

    //$mpdf->shrink_tables_to_fit = 0;
    //$mpdf->autoPageBreak = true;

    // LOAD a stylesheet
    $stylesheet = file_get_contents('pdf-style.css');

    $mpdf->WriteHTML($stylesheet, 1);

    $result = new DB_awb();
    $sql = $result->get_one_awb($id);
    $i = 0;
    foreach ($sql as $list) {

        $awb_no = $list["awb_no"];
        $bdate = date('d-m-Y', strtotime($list['bdate']));
        $year = $list["year"];
        $consignor = $list["consignor"];
        $source = $list["source"];
        $cphone = $list["cphone"];
        $sgst = $list["sgst"];
        $consignee = $list["consignee"];
        $destination = $list["destination"];
        $dphone = $list["dphone"];
        $dgst = $list["dgst"];
        $type = $list["type"];
        $qty = $list["qty"];
        $description = $list["description"];
        $inv_no = $list["inv_no"];
        $value = $list["value"];
        $frieght = $list["frieght"];
        $loading = $list["loading"];
        $others = $list["others"];
        $total = $list["total"];

        $barcodeData = base64_encode($generator->getBarcode($list['awb_no'], $generator::TYPE_CODE_128));

        $data = '';

        $data .= '

            <table id="example1" style="border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;">
                <tr>
                    <td colspan="6" style="border:1px solid #b0b0b0; padding:10px;">
                        <table width="100%" style="border:none;">
                            <tr>
                                <!-- Logo Section -->
                                <td style="width:25%; text-align:center; vertical-align:top; border:0;">
                                    <img src="https://mahitransport.com/admin/dist/img/logo.png" style="width:100px; height:auto;">
                                </td>

                                <!-- Company Info Section -->
                                <td style="width:75%; text-align:left; padding-left:10px 5px; border:0;  vertical-align:top;">
                                    <h2 style="margin:0; font-size:18px;"><b>MAHI TRANSPORT</b></h2>
                                    <p style="margin:5px 0; font-size:12px;">
                                        18/1, Govindarajalu Street, Saravanabhavan Hotel Back Side,<br>
                                        Avinashi Road, Tirupur - 641 602.<br>
                                        <b>Phone:</b> +91 99524 14696<br>
                                        <b>Email-ID:</b> muthuraj@mahitransport.com<br>
                                        <b>GSTIN:</b> 33IUMPM2724K1Z9
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="border:1px solid #b0b0b0; padding:10px;">
                        <b>Date:</b> ' . $bdate . ' 
                    </td>
                    <td colspan="2" style="border:1px solid #b0b0b0; padding:10px; text-align:center;">
                        <b>BOOKING CHALLAN</b>
                    </td>
                    <td colspan="2" style="border:1px solid #b0b0b0; padding:10px; text-align:center;">
                        <div style="text-align: center;">
                            <img src="data:image/png;base64,' . $barcodeData . '" />
                        </div>
                        <b style="font-size:14px;">' . $awb_no . '</b> 
                    </td>
                </tr>

                <tr>
                    <td rowspan="5" colspan="2" style="border:1px solid #b0b0b0; vertical-align:top; padding:10px;">
                        <p>
                            <b>From:</b> ' . $consignor . ' <br>
                            <b>Consignor:</b> ' . $source . ' <br>
                            <b>Phone:</b> ' . $cphone . ' <br>
                            <b>GST No:</b> ' . $sgst . ' 
                        </p>
                    </td>

                    <td rowspan="5" colspan="2" style="border:1px solid #b0b0b0;  vertical-align:top; padding:10px;">
                        <p>
                            <b>To:</b> ' . $consignee . ' <br>
                            <b>Consignor:</b> ' . $destination . ' <br>
                            <b>Phone:</b> ' . $dphone . ' <br>
                            <b>GST No:</b> ' . $dgst . ' 
                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="border:1px solid #b0b0b0; padding:5px 10px; border-top:0;"><b>Type:</b> ' . $type . ' </td>
                </tr>
                <tr>
                    <td style="border:1px solid #b0b0b0; padding:5px 10px;"><b>Freight Charges:</b></td>
                    <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:right;">' . $frieght . ' .00</td>
                </tr>
                <tr>
                    <td style="border:1px solid #b0b0b0; padding:5px 10px;"><b>Loading Charges:</b></td>
                    <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:right;">' . $loading . ' .00</td>
                </tr>
                <tr>
                    <td style="border:1px solid #b0b0b0; padding:5px 10px;"><b>Other Charges:</b></td>
                    <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:right;">' . $others . ' .00</td>
                </tr>
                <tr>
                    <td style="border:1px solid #b0b0b0; padding:10px;"><b>Qty:</b><br> ' . $qty . ' </td>
                    <td style="border:1px solid #b0b0b0; padding:10px;"><b>Description:</b><br> ' . $description . ' </td>
                    <td style="border:1px solid #b0b0b0; padding:10px;"><b>Invoice:</b><br> ' . $inv_no . ' </td>
                    <td style="border:1px solid #b0b0b0; padding:10px;"><b>Value:</b><br> ' . $value . ' </td>
                    <td style="border:1px solid #b0b0b0; padding:10px;"><b>Total:</b></td>
                    <td style="border:1px solid #b0b0b0; padding:10px; text-align:right;">' . $total . ' </td>
                </tr>
                <tr>
                    <td colspan="4" style="border:1px solid #b0b0b0; padding:5px 10px; ">
                        <b>Terms & Conditions</b><br>
                        This Luggage is booked by accepting the terms and conditions of the transport
                        company.<br><br>
                        <b>Delivery Office</b><br>
                         NEAR LIC OFFICE BCKSIDE, CHAMARAJPET BANGALORE-560 018<br>
                        Cell : +91 7975733732, +91 8884853640
                    </td>
                    <td colspan="2" style="border:1px solid #b0b0b0; padding:5px 10px; text-align:center; ">
                        <b>MAHI TRANSPORT</b><br>
                        <img src="https://mahitransport.com/admin/dist/img/sign.jpg" alt="">
                        <br>
                        Auth Sign
                    </td>
                </tr>
            </table>        
        ';
    }

    $mpdf->WriteHtml($data);

    $mpdf->Output($awb_no . '.pdf', 'I');

    //$mpdf->Output();
}
