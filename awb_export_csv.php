<?php
ob_start();
include('class/class_awb.php');

if (isset($_POST['export'])) {
    $month = $_POST["month"];
    $year = $_POST["year"];

    $result = new DB_awb();
    $sql = $result->list_awb_by_month_year($month, $year); // should return mysqli_result

    if ($sql && mysqli_num_rows($sql) > 0) {
        // Set CSV headers
        header("Content-Type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=AWB_Report_{$month}_{$year}.csv");

        // Open output stream
        $output = fopen("php://output", "w");

        // Output CSV column headers
        fputcsv($output, ['S.No', 'AWB No', 'Date', 'Consignor', 'Source', 'Phone', 'GST No', 'Consignee', 'Destination', 'Phone', 'GST', 'Type', 'Qty', 'Description', 'Inv No', 'Value', 'Frieght', 'Loading', 'Others', 'Total']);

        // Loop through rows
        $i = 0;
        while ($row = mysqli_fetch_assoc($sql)) {
            $i++;
            fputcsv($output, [
                $i,
                $row['awb_no'],
                date('d-m-Y', strtotime($row['bdate'])),
                $row['consignor'],
                $row['source'],
                $row['cphone'],
                $row['sgst'],
                $row['consignee'],
                $row['destination'],
                $row['dphone'],
                $row['dgst'],
                $row['type'],
                $row['qty'],
                $row['description'],
                $row['inv_no'],
                $row['value'],
                $row['frieght'],
                $row['loading'],
                $row['others'],
                $row['total'],
            ]);
        }

        fclose($output);
        exit;
    } else {
        echo "<div class='alert alert-warning'>No records found to export.</div>";
    }
}
