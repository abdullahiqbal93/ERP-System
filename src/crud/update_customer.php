<?php
include '../connection.php';

if (isset($_POST['customerID'])) {
    $customerID = $_POST['customerID'];
    $selectQuery = "SELECT * FROM customer WHERE id = '$customerID'";
    $result = mysqli_query($con, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        ?>
    
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="crud/customer_process.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="customerID" value="<?php echo $record['id']; ?>">

                                <div class="form-group">
                                        <label for="editTitle">Title</label>
                                    <select class="form-control" id="editTitle" name="title" required>
                                        <option value="">Select Title</option>
                                        <option value="Mr" <?php echo ($record['title'] == 'Mr') ? 'selected' : ''; ?>>Mr</option>
                                        <option value="Mrs" <?php echo ($record['title'] == 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
                                        <option value="Miss" <?php echo ($record['title'] == 'Miss') ? 'selected' : ''; ?>>Miss</option>
                                        <option value="Dr" <?php echo ($record['title'] == 'Dr') ? 'selected' : ''; ?>>Dr</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editFirstName">First Name</label>
                                    <input type="text" class="form-control" id="editFirstName" name="first_name" value="<?php echo $record['first_name']; ?>" required pattern="[A-Za-z\s]+" title="First name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="editMiddleName">Middle Name</label>
                                    <input type="text" class="form-control" id="editMiddleName" name="middle_name" value="<?php echo $record['middle_name']; ?>" pattern="[A-Za-z\s]*" title="Middle name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="editLastName">Last Name</label>
                                    <input type="text" class="form-control" id="editLastName" name="last_name" value="<?php echo $record['last_name']; ?>" required pattern="[A-Za-z\s]+" title="Last name should only contain letters">
                                </div>
                                <div class="form-group">
                                    <label for="editContactNo">Contact Number</label>
                                    <input type="text" class="form-control" id="editContactNo" name="contact_no" value="<?php echo $record['contact_no']; ?>" required pattern="\d{10}" title="Contact number should be exactly 10 digits">
                                </div>
                                <div class="form-group">
                                    <label for="editDistrict">District</label>
                                    <select class="form-control" name="district" required>
                                        <option value="">Please Select</option>
                                        <?php
                                        $sql = "SELECT id,district FROM district";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $selected = ($record['district'] == $row['id']) ? 'selected' : '';
                                                echo "<option value='" . $row['id'] . "' $selected>" . $row['district'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No District found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edit_register">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>