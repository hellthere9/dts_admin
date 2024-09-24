<?php
// Include database connection
// include('roxcon.php');

// Fetch sections from the database
$query = "SELECT * FROM dts_sections ORDER BY section_id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Sections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">
        <a href="index.php?page=add_section" class="btn btn-primary btn-sm">Add</a>
        Sections List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Section ID</th>
                    <th>Section Description</th>
                    <th>Office ID</th>
                    <th>Initial Receipt</th>
                    <th>Public View</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['section_id']; ?></td>
                            <td><?php echo $row['section_description']; ?></td>
                            <td><?php echo $row['office_id']; ?></td>
                            <td><?php echo $row['initial_receipt']; ?></td>
                            <td><?php echo $row['public_view'] == 1 ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $row['active'] == 1 ? 'Active' : 'Inactive'; ?></td>
                            <td>
                                <!-- Edit Section button -->
                                <a href="index.php?page=edit_section&section_id=<?php echo $row['section_id']; ?>" class="btn btn-primary">Edit</a>
                                <!-- View Users in this Section -->
                                <a href="index.php?page=view_section_users&section_id=<?php echo $row['section_id']; ?>" class="btn btn-info">View Users</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No sections found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
