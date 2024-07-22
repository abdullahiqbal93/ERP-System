<?php
include '../connection.php';

function outputCSV($data, $filename = 'report.csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $filename);
    $output = fopen('php://output', 'w');
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}

if (isset($_POST['generateInvoiceReport'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $query = "SELECT 
                i.invoice_no AS invoice_number, 
                i.date, 
                c.first_name, 
                c.last_name, 
                d.district, 
                i.item_count, 
                i.amount AS invoice_amount 
              FROM 
                invoice i
                JOIN customer c ON i.customer = c.id
                JOIN district d ON c.district = d.id
              WHERE 
                i.date BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = [
            ['Invoice Number', 'Date', 'Customer', 'Customer District', 'Item Count', 'Invoice Amount']
        ];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                $row['invoice_number'], 
                $row['date'], 
                $row['first_name'] . ' ' . $row['last_name'], 
                $row['district'], 
                $row['item_count'], 
                $row['invoice_amount']
            ];
        }
        outputCSV($data, 'invoice_report.csv');
    } else {
        echo "<p class='text-center'>No records found for the selected date range.</p>";
    }
}

if (isset($_POST['generateInvoiceItemReport'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $query = "SELECT 
                i.invoice_no AS invoice_number, 
                i.date AS invoiced_date, 
                c.first_name, 
                c.last_name, 
                it.item_name, 
                it.item_code, 
                ic.category, 
                it.unit_price
              FROM 
                invoice i
                JOIN customer c ON i.customer = c.id
                JOIN invoice_master im ON i.invoice_no = im.invoice_no
                JOIN item it ON im.item_id = it.id
                JOIN item_category ic ON it.item_category = ic.id
              WHERE 
                i.date BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = [
            ['Invoice Number', 'Invoiced Date', 'Customer Name', 'Item Name', 'Item Code', 'Item Category', 'Item Unit Price']
        ];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                $row['invoice_number'], 
                $row['invoiced_date'], 
                $row['first_name'] . ' ' . $row['last_name'], 
                $row['item_name'], 
                $row['item_code'], 
                $row['category'], 
                $row['unit_price']
            ];
        }
        outputCSV($data, 'invoice_item_report.csv');
    } else {
        echo "<p class='text-center'>No records found for the selected date range.</p>";
    }
}

if (isset($_POST['generateItemReport'])) {
    $query = "SELECT 
                DISTINCT it.item_name, 
                ic.category, 
                isc.sub_category, 
                it.quantity
              FROM 
                item it
                JOIN item_category ic ON it.item_category = ic.id
                JOIN item_subcategory isc ON it.item_subcategory = isc.id";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = [
            ['Item Name', 'Item Category', 'Item Subcategory', 'Item Quantity']
        ];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                $row['item_name'], 
                $row['category'], 
                $row['sub_category'], 
                $row['quantity']
            ];
        }
        outputCSV($data, 'item_report.csv');
    } else {
        echo "<p class='text-center'>No records found.</p>";
    }
}
?>
