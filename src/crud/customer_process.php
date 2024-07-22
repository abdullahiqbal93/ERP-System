<?php
include '../connection.php';

// Inserting Data
if (isset($_POST["register"])) {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];

    $query = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) 
              VALUES ('$title', '$first_name', '$middle_name', '$last_name', '$contact_no', '$district')";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Customer added successfully!'); window.location.href='../customer.php';</script>";
    } else {
        error_log("MySQL Error: " . mysqli_error($con));
        echo "<script>alert('An error occurred during customer addition. Please try again later.');</script>";
    }
}

// Deleting Data
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["ID"])) {
    $customer_id = $_GET["ID"];
    $deleteQuery = "DELETE FROM customer WHERE id='$customer_id'";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Customer deleted successfully!'); window.location.href='../customer.php';</script>";
    } else {
        error_log("MySQL Error: " . mysqli_error($con));
        echo "An error occurred during deletion. Please try again later.";
    }
}

// Updating Data
if (isset($_POST['customerID'])) {
    $customerID = $_POST['customerID'];
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];


    $updateQuery = "UPDATE customer SET title = '$title', first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name', contact_no = '$contact_no', district = '$district' WHERE id = '$customerID'";
    
    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Customer updated successfully!'); window.location.href='../customer.php';</script>";
    } else {
        error_log("MySQL Error: " . mysqli_error($con));
        echo "<script>alert('An error occurred during update. Please try again later.');</script>";
    }
}
?>
