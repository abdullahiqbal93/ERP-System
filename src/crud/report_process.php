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

function previewData($data, $reportType) {
    echo '<table class="table table-striped">';
    echo '<thead>';
    foreach ($data[0] as $header) {
        echo '<th>' . htmlspecialchars($header) . '</th>';
    }
    echo '</thead><tbody>';
    for ($i = 1; $i < count($data); $i++) {
        echo '<tr>';
        foreach ($data[$i] as $cell) {
            echo '<td>' . htmlspecialchars($cell) . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
    echo '<a href="#" class="btn btn-success" onclick="downloadCSV(\'' . $reportType . '\')">Download CSV</a>';
}

if (isset($_POST['previewReport'])) {
    $reportType = $_POST['reportType'];
    $startDate = $_POST['startDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';

    if ($reportType === 'invoice') {
        $query = "SELECT 
                    i.invoice_no AS invoice_number, 
                    i.date, 
                    CONCAT(c.first_name, ' ', c.last_name) AS customer, 
                    d.district AS customer_district, 
                    i.item_count AS item_count, 
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
                    $row['customer'],
                    $row['customer_district'],
                    $row['item_count'],
                    $row['invoice_amount']
                ];
            }
            previewData($data, 'invoice');
        } else {
            echo 'No data found.';
        }
    } elseif ($reportType === 'invoiceItem') {
        $query = "SELECT 
                    i.invoice_no AS invoice_number, 
                    i.date AS invoiced_date, 
                    CONCAT(c.first_name, ' ', c.last_name) AS customer_name, 
                    it.item_name, 
                    it.item_code, 
                    ic.category AS item_category, 
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
                    $row['customer_name'],
                    $row['item_name'],
                    $row['item_code'],
                    $row['item_category'],
                    $row['unit_price']
                ];
            }
            previewData($data, 'invoiceItem');
        } else {
            echo 'No data found.';
        }
    } elseif ($reportType === 'item') {
        $query = "SELECT DISTINCT
                    it.item_name, 
                    ic.category AS item_category, 
                    isc.sub_category AS item_subcategory, 
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
                    $row['item_category'],
                    $row['item_subcategory'],
                    $row['quantity']
                ];
            }
            previewData($data, 'item');
        } else {
            echo 'No data found.';
        }
    }
}

if (isset($_GET['downloadCSV'])) {
    $reportType = $_GET['reportType'];
    $startDate = $_GET['startDate'] ?? '';
    $endDate = $_GET['endDate'] ?? '';

    if ($reportType === 'invoice') {
        $query = "SELECT 
                    i.invoice_no AS invoice_number, 
                    i.date, 
                    CONCAT(c.first_name, ' ', c.last_name) AS customer, 
                    d.district AS customer_district, 
                    i.item_count AS item_count, 
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
                    $row['customer'],
                    $row['customer_district'],
                    $row['item_count'],
                    $row['invoice_amount']
                ];
            }
            outputCSV($data, 'invoice_report.csv');
        }
    } elseif ($reportType === 'invoiceItem') {
        $query = "SELECT 
                    i.invoice_no AS invoice_number, 
                    i.date AS invoiced_date, 
                    CONCAT(c.first_name, ' ', c.last_name) AS customer_name, 
                    it.item_name, 
                    it.item_code, 
                    ic.category AS item_category, 
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
                    $row['customer_name'],
                    $row['item_name'],
                    $row['item_code'],
                    $row['item_category'],
                    $row['unit_price']
                ];
            }
            outputCSV($data, 'invoice_item_report.csv');
        }
    } elseif ($reportType === 'item') {
        $query = "SELECT DISTINCT
                    it.item_name, 
                    ic.category AS item_category, 
                    isc.sub_category AS item_subcategory, 
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
                    $row['item_category'],
                    $row['item_subcategory'],
                    $row['quantity']
                ];
            }
            outputCSV($data, 'item_report.csv');
        }
    }
}
?>
