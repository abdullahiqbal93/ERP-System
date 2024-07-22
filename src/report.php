<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
                <li>
                    <a href="items.php">Items</a>
                </li>
                <li class="active">
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
                        <span><img width="40" height="40" src="https://img.icons8.com/ios/50/document.png" alt="document" /> Reports</span>
                    </div>
                </div>
            </nav>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card report-section">
                            <div class="card-body">
                                <h2 class="card-title">Invoice Report</h2>
                                <form method="post" action="crud/report_process.php">
                                    <div class="form-group">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="generateInvoiceReport">Generate Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card report-section">
                            <div class="card-body">
                                <h2 class="card-title">Invoice Item Report</h2>
                                <form method="post" action="crud/report_process.php">
                                    <div class="form-group">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="generateInvoiceItemReport">Generate Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card report-section">
                            <div class="card-body">
                                <h2 class="card-title">Item Report</h2>
                                <form method="post" action="crud/report_process.php">
                                    <button type="submit" class="btn btn-primary" name="generateItemReport">Generate Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
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

</body>

</html>
