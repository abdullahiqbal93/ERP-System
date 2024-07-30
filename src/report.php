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
                                <form id="invoiceReportForm">
                                    <div class="form-group">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="previewReport('invoice')">Preview Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card report-section">
                            <div class="card-body">
                                <h2 class="card-title">Invoice Item Report</h2>
                                <form id="invoiceItemReportForm">
                                    <div class="form-group">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="previewReport('invoiceItem')">Preview Report</button>
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
                                <form id="itemReportForm">
                                    <button type="button" class="btn btn-primary" onclick="previewReport('item')">Preview Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="previewModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="reportPreview"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Custom Script -->
    <script src="../js/script.js"></script>

    <script>
        function previewReport(type) {
    let formId = '';
    let startDateInput = null;
    let endDateInput = null;

    // Determine the form ID and corresponding date inputs based on report type
    if (type === 'invoice') {
        formId = 'invoiceReportForm';
        startDateInput = document.getElementById('startDate');
        endDateInput = document.getElementById('endDate');
    } else if (type === 'invoiceItem') {
        formId = 'invoiceItemReportForm';
        startDateInput = document.getElementById('startDate');
        endDateInput = document.getElementById('endDate');
    } else if (type === 'item') {
        formId = 'itemReportForm';
    }

    // Validate dates if the report type requires date inputs
    if (startDateInput && endDateInput) {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (!startDate || !endDate) {
            alert('Please select both start and end dates.');
            return; 
        }
    }

    // Prepare form data for the request
    const formData = new FormData(document.getElementById(formId));
    formData.append('previewReport', true);
    formData.append('reportType', type);

    // Send data to the server and handle the response
    fetch('crud/report_process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('reportPreview').innerHTML = data;
        document.getElementById('previewModal').style.display = 'block';
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


        document.querySelector('.close').onclick = function() {
            document.getElementById('previewModal').style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target == document.getElementById('previewModal')) {
                document.getElementById('previewModal').style.display = 'none';
            }
        };

        function downloadCSV(reportType) {
    let startDate = document.getElementById('startDate').value;
    let endDate = document.getElementById('endDate').value;
    
    let url = `./crud//report_process.php?downloadCSV=1&reportType=${reportType}&startDate=${startDate}&endDate=${endDate}`;
    
    window.location.href = url;
}
    </script>
</body>
</html>
