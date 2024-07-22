<?php
include '../connection.php';

// Inserting Data
if (isset($_POST["register"])) {
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $query = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
              VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Item added successfully!'); window.location.href='../items.php';</script>";
    } else {
        error_log("MySQL Error: " . mysqli_error($con));
        echo "<script>alert('An error occurred during item addition. Please try again later.');</script>";
    }
}

// Deleting Data
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["ID"])) {
    $item_id = $_GET["ID"];
    $deleteQuery = "DELETE FROM item WHERE id='$item_id'";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Item deleted successfully!'); window.location.href='../items.php';</script>";
    } else {
        error_log("MySQL Error: " . mysqli_error($con));
        echo "An error occurred during deletion. Please try again later.";
    }
}

// Updating Data
if (isset($_POST['itemID'])) {
    $itemID = $_POST['itemID'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $updateQuery = "UPDATE item SET item_code = '$item_code', item_name = '$item_name', item_category = '$item_category', item_subcategory = '$item_subcategory', quantity = '$quantity', unit_price = '$unit_price' WHERE id = '$itemID'";
    
    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Item updated successfully!'); window.location.href='../items.php';</script>";
    } else {
        error_log("MySQL Error: " . mysqli_error($con));
        echo "<script>alert('An error occurred during update. Please try again later.');</script>";
    }
}
?>
