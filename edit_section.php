<?php
// Include database connection
// include('roxcon.php');

// Check if section_id is passed
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];

    // Fetch the section data
    $query = "SELECT * FROM dts_sections WHERE section_id = $section_id";
    $result = mysqli_query($conn, $query);
    $section = mysqli_fetch_assoc($result);
}

// Update the section when form is submitted
if (isset($_POST['update_section'])) {
    $section_description = $_POST['section_description'];
    $office_id = $_POST['office_id'];
    $initial_receipt = $_POST['initial_receipt'];
    $public_view = isset($_POST['public_view']) ? 1 : 0;
    $active = isset($_POST['active']) ? 1 : 0;

    // Update query
    $query = "UPDATE dts_sections SET section_description = '$section_description', office_id = $office_id, initial_receipt = $initial_receipt, public_view = $public_view, active = $active WHERE section_id = $section_id";
    
    if (mysqli_query($conn, $query)) {
        // Redirect to display_sections.php after successful update
        header("Location: index.php?page=display_sections");
        exit();
    } else {
        echo "Error updating section: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Section</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="section_description" class="form-label">Section Description</label>
                <input type="text" name="section_description" id="section_description" class="form-control" value="<?php echo $section['section_description']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="office_id" class="form-label">Office ID</label>
                <input type="number" name="office_id" id="office_id" class="form-control" value="<?php echo $section['office_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="initial_receipt" class="form-label">Initial Receipt</label>
                <input type="number" name="initial_receipt" id="initial_receipt" class="form-control" value="<?php echo $section['initial_receipt']; ?>" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="public_view" id="public_view" <?php echo $section['public_view'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="public_view">Public View</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="active" id="active" <?php echo $section['active'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <button type="submit" name="update_section" class="btn btn-primary">Update Section</button>
            <a href="index.php?page=display_sections" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
