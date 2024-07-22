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
                <li class="active">
                    <a href="customer.php">Customers</a>
                </li>
                <li>
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
                        <span><img width="40" height="40" src="https://img.icons8.com/ios/50/user.png" alt="user" /> Customers</span>
                    </div>
                </div>
            </nav>

            <div class="heading">
                        <h3>Search Customers</h3>
                        <input type="text" id="customerSearch" class="form-control" placeholder="Enter Customer Name....." onkeyup="filterCustomers()">
                    </div>

          
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addCustomerModal">
                Add Customers
            </button>
            <br><br>

            <div class="tbl">
                <?php include 'connection.php';

               
               $districtQuery = "SELECT * FROM district WHERE active = 'yes' ORDER BY district";
               $districtResult = mysqli_query($con, $districtQuery);

                $selectQuery = "SELECT * FROM customer ORDER BY id ASC";
                $result = mysqli_query($con, $selectQuery);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped table-bordered' style='width: 100%;'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>
                    <th style='width: 3%;'>ID</th>
                    <th style='width: 7%;'>Title</th>
                    <th style='width: 15%;'>First Name</th>
                    <th style='width: 15%;'>Middle Name</th>
                    <th style='width: 15%;'>Last Name</th>
                    <th style='width: 15%;'>Contact No</th>
                    <th style='width: 15%;'>District</th>
                    <th style='width: 30%;'>Actions</th>
                </tr>";
                    echo "</thead>";
                    echo "<tbody id='customerTableBody'>";
                    while ($record = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$record['id']}</td>";
                        echo "<td>{$record['title']}</td>";
                        echo "<td>{$record['first_name']}</td>";
                        echo "<td>{$record['middle_name']}</td>";
                        echo "<td>{$record['last_name']}</td>";
                        echo "<td>{$record['contact_no']}</td>";
                        echo "<td>{$record['district']}</td>";
                        echo "<td><a href='#' class='btn btn-primary btn-sm edit-btn' data-toggle='modal' data-target='#editCustomerModal' data-customerid='{$record['id']}'>Edit</a>  ";
                        echo "<a href='crud/customer_process.php?action=delete&ID={$record['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";

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

            <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog"
                aria-labelledby="addCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCustomerModalLabel">Customer Registration</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="crud/customer_process.php" method="post">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                <select class="form-control" name="title" required>
                                    <option value="">Select Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" required pattern="[A-Za-z\s]+" title="First name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" class="form-control" name="middle_name" pattern="[A-Za-z\s]*" title="Middle name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required pattern="[A-Za-z\s]+" title="Last name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="contact_no">Contact Number</label>
                                    <input type="text" class="form-control" name="contact_no" required pattern="\d{10}" title="Contact number should be exactly 10 digits">
                                </div>
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <select class="form-control" name="district" required>
                                        <option value="">Please Select</option>
                                        <?php
                                        if ($districtResult && mysqli_num_rows($districtResult) > 0) {
                                            while ($district = mysqli_fetch_assoc($districtResult)) {
                                                echo "<option value='{$district['id']}'>{$district['district']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
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


      
        <div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog"
            aria-labelledby="editCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                               
                                <form action="crud/customer_process.php" method="post">
                                <div class="form-group">
                                        <label for="title">Title</label>
                                    <select class="form-control" name="title" required>
                                        <option value="">Select Title</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editFirstName">First Name</label>
                                    <input type="text" class="form-control" id="editFirstName" name="edit_first_name" required pattern="[A-Za-z\s]+" title="First name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="editMiddleName">Middle Name</label>
                                    <input type="text" class="form-control" id="editMiddleName" name="edit_middle_name" pattern="[A-Za-z\s]*" title="Middle name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="editLastName">Last Name</label>
                                    <input type="text" class="form-control" id="editLastName" name="edit_last_name" required pattern="[A-Za-z\s]+" title="Last name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="editContactNo">Contact Number</label>
                                    <input type="text" class="form-control" id="editContactNo" name="edit_contact_no" required pattern="\d{10}" title="Contact number should be exactly 10 digits">
                                </div>
                                <div class="form-group">
                                    <label for="editDistrict">District</label>
                                    <select class="form-control" id="editDistrict" name="edit_district" required>
                                        <?php
                                        if ($districtResult && mysqli_num_rows($districtResult) > 0) {
                                            while ($district = mysqli_fetch_assoc($districtResult)) {
                                                echo "<option value='{$district['district']}'>{$district['district']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
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
                    var customerID = $(this).data('customerid');
                    // AJAX request to fetch customer data
                    $.ajax({
                        url: 'crud/update_customer.php',
                        type: 'POST',
                        data: { customerID: customerID },
                        success: function (response) {
                            $('#editCustomerModal').html(response);
                        }
                    });
                });
            });
        </script>


</body>

</html>