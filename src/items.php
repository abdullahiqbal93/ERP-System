<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="wrapper">
  
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>ERP SYSTEM</h3>
            </div>
            <ul class="list-unstyled components">
         
                <li>
                    <a href="../index.php">Dashboard</a>
                </li>
                <li>
                    <a href="customer.php">Customers</a>
                </li>
                <li class="active">
                    <a href="items.php">Items</a>
                </li>
                <li>
                    <a href="report.php">Reports</a>
                </li>
            </ul>
        </nav>
    
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <div class="heading">
                        <span><img width="40" height="40" src="https://img.icons8.com/ios/50/box.png" alt="box" /> Items</span>
                    </div>
                </div>
            </nav>

            <div class="heading">
                        <h3>Search Items</h3>
                        <input type="text" id="itemSearch" class="form-control" placeholder="Enter Item Name....." onkeyup="filterItems()">
                    </div>

      
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addItemModal">
                Add Items
            </button>
            <br><br>

            <div class="tbl">
                <?php include 'connection.php';

  
                $categoryQuery = "SELECT * FROM item_category ORDER BY category";
                $categoryResult = mysqli_query($con, $categoryQuery);

                $subcategoryQuery = "SELECT * FROM item_subcategory ORDER BY sub_category";
                $subcategoryResult = mysqli_query($con, $subcategoryQuery);

                $selectQuery = "SELECT * FROM item ORDER BY id ASC";
                $result = mysqli_query($con, $selectQuery);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped table-bordered' style='width: 100%;'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>
                        <th style='width: 3%;'>ID</th>
                        <th style='width: 12%;'>Item Code</th>
                        <th style='width: 25%;'>Item Name</th>
                        <th style='width: 10%;'>Category</th>
                        <th style='width: 10%;'>Subcategory</th>
                        <th style='width: 10%;'>Quantity</th>
                        <th style='width: 15%;'>Unit Price</th>
                        <th style='width: 20%;'>Actions</th>
                    </tr>";
                    echo "</thead>";
                    echo "<tbody id='itemTableBody'>";
                    while ($record = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$record['id']}</td>";
                        echo "<td>{$record['item_code']}</td>";
                        echo "<td>{$record['item_name']}</td>";
                        echo "<td>{$record['item_category']}</td>";
                        echo "<td>{$record['item_subcategory']}</td>";
                        echo "<td>{$record['quantity']}</td>";
                        echo "<td>{$record['unit_price']}</td>";
                        echo "<td><a href='#' class='btn btn-primary btn-sm edit-btn' data-toggle='modal' data-target='#editItemModal' data-itemid='{$record['id']}'>Edit</a>  ";
                        echo "<a href='crud/item_process.php?action=delete&ID={$record['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";

                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p class='text-center'>No records found.</p>";
                }
                ?>
            </div>

            <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog"
                aria-labelledby="addItemModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addItemModalLabel">Item Registration</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="crud/item_process.php" method="post">
                                <div class="form-group">
                                    <label for="item_code">Item Code</label>
                                    <input type="text" class="form-control" name="item_code" required pattern="[A-Za-z0-9]{1,10}" title="Item Code should be alphanumeric and up to 10 characters long">
                                </div>
                                <div class="form-group">
                                    <label for="item_name">Item Name</label>
                                    <input type="text" class="form-control" name="item_name" required pattern="[A-Za-z\s]{1,50}" title="Item Name should be letters, and up to 50 characters long">
                                </div>
                                <div class="form-group">
                                    <label for="item_category">Category</label>
                                    <select class="form-control" name="item_category" required>
                                    <option value="">Please Select</option>
                                        <?php
                                        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                                echo "<option value='{$category['id']}'>{$category['category']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="item_subcategory">Subcategory</label>
                                    <select class="form-control" name="item_subcategory" required>
                                    <option value="">Please Select</option>
                                        <?php
                                        if ($subcategoryResult && mysqli_num_rows($subcategoryResult) > 0) {
                                            while ($subcategory = mysqli_fetch_assoc($subcategoryResult)) {
                                                echo "<option value='{$subcategory['id']}'>{$subcategory['sub_category']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" required min="1" title="Quantity must be a positive number">
                                </div>
                                <div class="form-group">
                                    <label for="unit_price">Unit Price</label>
                                    <input type="number" class="form-control" name="unit_price" required min="1" step="0.01" title="Unit Price must be a positive number with up to two decimal places">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog"
            aria-labelledby="editItemModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editItemModalLabel">Edit Item Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                                <form action="crud/item_process.php" method="post">
                                <div class="form-group">
                                    <label for="edit_item_code">Item Code</label>
                                    <input type="text" class="form-control" id="edit_item_code" name="item_code" required pattern="[A-Za-z0-9]{1,10}" title="Item Code should be alphanumeric and up to 10 characters long">
                                </div>
                                <div class="form-group">
                                    <label for="edit_item_name">Item Name</label>
                                    <input type="text" class="form-control" id="edit_item_name" name="item_name" required pattern="[A-Za-z\s]{1,50}" title="Item Name should be letters, and up to 50 characters long">
                                </div>
                                <div class="form-group">
                                    <label for="edit_item_category">Category</label>
                                    <select class="form-control" id="edit_item_category" name="item_category" required>
                                        <?php
                                        mysqli_data_seek($categoryResult, 0); 
                                        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                                echo "<option value='{$category['id']}'>{$category['category']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_item_subcategory">Subcategory</label>
                                    <select class="form-control" id="edit_item_subcategory" name="item_subcategory" required>
                                        <?php
                                        mysqli_data_seek($subcategoryResult, 0);
                                        if ($subcategoryResult && mysqli_num_rows($subcategoryResult) > 0) {
                                            while ($subcategory = mysqli_fetch_assoc($subcategoryResult)) {
                                                echo "<option value='{$subcategory['id']}'>{$subcategory['sub_category']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_quantity">Quantity</label>
                                    <input type="text" class="form-control" id="edit_quantity" name="quantity" required min="1" title="Quantity must be a positive number">
                                </div>
                                <div class="form-group">
                                    <label for="edit_unit_price">Unit Price</label>
                                    <input type="text" class="form-control" id="edit_unit_price" name="unit_price" required min="1" step="0.01" title="Unit Price must be a positive number with up to two decimal places">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary edit" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary edit" name="edit_register">Save
                                    Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <!-- Custom Script -->
        <script src="../js/script.js"></script>

        <script>
            $(document).ready(function () {
                $('.edit-btn').click(function () {
                    var itemID = $(this).data('itemid');
                   
                    $.ajax({
                        url: 'crud/update_item.php',
                        type: 'POST',
                        data: { itemID: itemID },
                        success: function (response) {
                            $('#editItemModal').html(response);
                        }
                    });
                });
            });
        </script>


</body>

</html>