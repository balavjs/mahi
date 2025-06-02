<?php
ob_start();
include('class/class_awb.php');

if (isset($_POST['export'])) {
    $month = $_POST["month"];
    $year = $_POST["year"];

    $result = new DB_awb();
    $sql = $result->list_awb_by_month_year($month, $year);

    if ($sql && mysqli_num_rows($sql) > 0) {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=AWB_Report_{$month}_{$year}.xls");

        echo "<html><head>
        <meta charset='UTF-8'>
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #a6a6a6; padding: 5px; font-size: 12px; }
            th { background-color: #f4f4f4; font-weight: bold; text-align: center; }
            tr:nth-child(even) { background-color: #f9f9f9; }
        </style>
        </head><body>";

        echo "<table>";
        echo "<tr>
            <th>S.No</th><th>AWB No</th><th>Date</th><th>Consignor</th><th>Source</th><th>Phone</th>
            <th>GST No</th><th>Consignee</th><th>Destination</th><th>Phone</th><th>GST</th>
            <th>Type</th><th>Qty</th><th>Description</th><th>Inv No</th><th>Value</th>
            <th>Frieght</th><th>Loading</th><th>Others</th><th>Total</th>
        </tr>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>";
            echo "<td>{$i}</td>";
            echo "<td>{$row['awb_no']}</td>";
            echo "<td>" . date('d-m-Y', strtotime($row['bdate'])) . "</td>";
            echo "<td>{$row['consignor']}</td>";
            echo "<td>{$row['source']}</td>";
            echo "<td>{$row['cphone']}</td>";
            echo "<td>{$row['sgst']}</td>";
            echo "<td>{$row['consignee']}</td>";
            echo "<td>{$row['destination']}</td>";
            echo "<td>{$row['dphone']}</td>";
            echo "<td>{$row['dgst']}</td>";
            echo "<td>{$row['type']}</td>";
            echo "<td>{$row['qty']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td>{$row['inv_no']}</td>";
            echo "<td>{$row['value']}</td>";
            echo "<td>{$row['frieght']}</td>";
            echo "<td>{$row['loading']}</td>";
            echo "<td>{$row['others']}</td>";
            echo "<td>{$row['total']}</td>";
            echo "</tr>";
            $i++;
        }

        echo "</table>";
        echo "</body></html>";
        exit;
    } else {
        echo "<div class='alert alert-warning'>No records found to export.</div>";
    }
}
