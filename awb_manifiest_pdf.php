<?php

require_once __DIR__ . '/vendor/autoload.php';
include('class/class_awb.php');

if (isset($_POST['submit'])) {
    $bdate = $_POST['bdate'];

    $result = new DB_awb();
    $records = $result->list_awb_by_date($bdate);

    if (empty($records)) {
        die('No AWB records found for selected date.');
    }

    $mpdf = new \Mpdf\Mpdf([
        'orientation' => 'P',
        'default_font' => 'Lato-Regular',
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_top' => 5,
        'margin_bottom' => 5,
    ]);

    $mpdf->SetAuthor('Mahi');
    $mpdf->SetTitle('Mahi Transport');
    $mpdf->SetSubject('AWB Manifest');
    $mpdf->autoScriptToLang = true;
    $mpdf->baseScript = 1;
    $mpdf->autoLangToFont = true;
    $mpdf->showImageErrors = true;

    $stylesheet = file_get_contents('pdf-style.css');
    $mpdf->WriteHTML($stylesheet, 1);

    $formatted_date = date('d-m-Y', strtotime($bdate));
    $data = '
        <table width="100%" style="border:1px solid #b0b0b0; margin: 0 10px; border-collapse: collapse;">
            <tr>
                <td colspan="7" style="border:1px solid #b0b0b0; padding:10px;">
                    <table width="100%" style="border:none;">
                        <tr>
                            <td style="width:25%; text-align:center; vertical-align:top; border:0;">
                                <img src="https://mahitransport.com/admin/dist/img/logo.png" style="width:100px; height:auto;">
                            </td>
                            <td style="width:75%; text-align:left; padding-left:10px 5px; border:0; vertical-align:top;">
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
                <td colspan="7" style="border:1px solid #b0b0b0; padding:5px 10px; text-align:right;">
                    <b>Date:</b> ' . $formatted_date . '
                </td>
            </tr>
            <tr style="background-color:#24497c; color:#ffffff;">
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">S.No</th>
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">From</th>
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">To</th>
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">AWB No</th>
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">Type</th>
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">Qty</th>
                <th style="border:1px solid #b0b0b0; padding:5px 10px; color:#ffffff;">Total</th>
            </tr>';

    $i = 0;
    $totalQty = 0;
    $grandTotal = 0;

    foreach ($records as $list) {
        $i++;
        $qty = (int)$list["qty"];
        $total = (float)$list["total"];
        $totalQty += $qty;
        $grandTotal += $total;

        $data .= '
            <tr>
                <td style="border:1px solid #b0b0b0; padding:5px 10px;">' . $i . '</td>
                <td style="border:1px solid #b0b0b0; padding:5px 10px;">' . htmlspecialchars($list["consignor"]) . '</td>
                <td style="border:1px solid #b0b0b0; padding:5px 10px;">' . htmlspecialchars($list["consignee"]) . '</td>
                <td style="border:1px solid #b0b0b0; padding:5px 10px;">' . htmlspecialchars($list["awb_no"]) . '</td>
                <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:center;">' . htmlspecialchars($list["type"]) . '</td>
                <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:center;">' . $qty . '</td>
                <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:right;">' . number_format($total, 2) . '</td>
            </tr>';
    }

    $data .= '
        <tr>
            <td colspan="5" style="text-align:right; border:1px solid #b0b0b0; padding:5px 10px;"><strong>Totals</strong></td>
            <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:center;"><strong>' . $totalQty . '</strong></td>
            <td style="border:1px solid #b0b0b0; padding:5px 10px; text-align:right;"><strong>' . number_format($grandTotal, 2) . '</strong></td>
        </tr>

            </table>';

    $mpdf->WriteHTML($data);
    $mpdf->Output('Mahi-Manifest_' . $formatted_date . '.pdf', 'I');
}
