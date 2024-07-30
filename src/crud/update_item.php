<?php
include '../connection.php';

if (isset($_POST['itemID'])) {
    $itemID = $_POST['itemID'];
    $selectQuery = "SELECT * FROM item WHERE id = '$itemID'";
    $result = mysqli_query($con, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        ?>
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Edit Item Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="crud/item_process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="itemID" value="<?php echo $record['id']; ?>">

                        <div class="form-group">
                            <label for="edit_item_code">Item Code</label>
                            <input type="text" class="form-control" id="edit_item_code" name="item_code" value="<?php echo $record['item_code']; ?>" required pattern="[A-Za-z0-9]{1,10}" title="Item Code should be alphanumeric and up to 10 characters long">
                        </div>
                        <div class="form-group">
                            <label for="edit_item_name">Item Name</label>
                            <input type="text" class="form-control" id="edit_item_name" name="item_name" value="<?php echo $record['item_name']; ?>" required pattern="[A-Za-z\s]{1,50}" title="Item Name should be letters and spaces, and up to 50 characters long">
                        </div>

                        <div class="form-group">
                            <label for="editItemCategory">Item Category</label>
                            <select class="form-control" id="editItemCategory" name="item_category" required>
                                <option value="">Select Category</option>
                                <?php
                                $sql = "SELECT id, category FROM item_category";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $selected = ($record['item_category'] == $row['id']) ? 'selected' : '';
                                        echo "<option value='" . $row['id'] . "' $selected>" . $row['category'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No Category found</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editItemSubcategory">Item Subcategory</label>
                            <select class="form-control" id="editItemSubcategory" name="item_subcategory" required>
                                <option value="">Select Subcategory</option>
                                <?php
                                $sql = "SELECT id, sub_category FROM item_subcategory";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $selected = ($record['item_subcategory'] == $row['id']) ? 'selected' : '';
                                        echo "<option value='" . $row['id'] . "' $selected>" . $row['sub_category'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No Subcategory found</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_quantity">Quantity</label>
                            <input type="number" class="form-control" id="edit_quantity" name="quantity" value="<?php echo $record['quantity']; ?>" required min="1" title="Quantity must be a positive number">
                        </div>
                        <div class="form-group">
                            <label for="edit_unit_price">Unit Price</label>
                            <input type="number" class="form-control" id="edit_unit_price" name="unit_price" value="<?php echo $record['unit_price']; ?>" required min="1" step="0.01" title="Unit Price must be a positive number with up to two decimal places">
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
