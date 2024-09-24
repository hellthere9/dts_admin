<?php
// Include your database connection file
include 'roxcon.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $section_description = mysqli_real_escape_string($conn, $_POST['section_description']);
    $office_id = intval($_POST['office_id']);
    $initial_receipt = intval($_POST['initial_receipt']);
    $public_view = intval($_POST['public_view']);

    // Insert the new section into the database
    $sql = "INSERT INTO dts_sections (section_description, office_id, initial_receipt, public_view)
            VALUES ('$section_description', $office_id, $initial_receipt, $public_view)";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the sections page with a success message
        header("Location: index.php?page=display_sections&add_success=true");
        exit();
    } else {
        // Handle database errors
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Section</h4>
                </div>
                <div class="card-body">
                    <form action="add_section_handler.php" method="POST">
                        <!-- Section Description -->
                        <div class="form-group mb-3">
                            <label for="section_description">Section Description</label>
                            <input type="text" class="form-control" id="section_description" name="section_description" placeholder="Enter Section Description" required>
                        </div>

                        <!-- Office ID -->
                        <div class="form-group mb-3">
                            <label for="office_id">Office ID</label>
                            <input type="number" class="form-control" id="office_id" name="office_id" value="1" placeholder="Enter Office ID" required>
                        </div>

                        <!-- Initial Receipt -->
                        <div class="form-group mb-3">
                            <label for="initial_receipt">Initial Receipt</label>
                            <input type="number" class="form-control" id="initial_receipt" name="initial_receipt" value="0" required>
                        </div>

                        <!-- Public View -->
                        <div class="form-group mb-3">
                            <label for="public_view">Public View</label>
                            <input type="number" class="form-control" id="public_view" name="public_view" value="0" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Add Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
