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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
      
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>ERP SYSTEM</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="index.php">Dashboard</a>
                </li>
                <li>
                    <a href="src/customer.php">Customers</a>
                </li>
                <li>
                    <a href="src/items.php">Items</a>
                </li>
                <li>
                    <a href="src/report.php">Reports</a>
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
                        <span><img width="40" height="40" src="https://img.icons8.com/ios/50/graph.png" alt="graph" /> Dashboard</span>
                    </div>
                </div>
            </nav>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header"><i class="fas fa-users"></i> Customers</div>
                            <div class="card-body">
                                <h5 class="card-title">Total Customers</h5>
                                <?php
                                include 'src/connection.php';
                                $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM customer");
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <p class="card-text"><?php echo $row['count']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header"><i class="fas fa-box"></i> Items</div>
                            <div class="card-body">
                                <h5 class="card-title">Total Items</h5>
                                <?php
                                $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM item");
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <p class="card-text"><?php echo $row['count']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header"><i class="fas fa-file-invoice"></i> Invoices</div>
                            <div class="card-body">
                                <h5 class="card-title">Total Invoices</h5>
                                <?php
                                $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM invoice");
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <p class="card-text"><?php echo $row['count']; ?></p>
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
    <script src="js/script.js"></script>


</body>

</html>
