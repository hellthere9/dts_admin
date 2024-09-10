<?php
// Include the database connection
include 'roxcon.php';

// Initialize search query
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
}

// Query to fetch documents with the receiving section description, ordered by doc_id DESC and limited to 100
$sql_docs = "
    SELECT d.*, s.section_description AS receiving_section_desc
    FROM dts_docs d
    LEFT JOIN dts_sections s ON d.receiving_section = s.section_id
    WHERE d.doc_tracking LIKE '%$search_query%' OR d.docs_description LIKE '%$search_query%'
    ORDER BY d.doc_id DESC
    LIMIT 100
";
$result_docs = mysqli_query($conn, $sql_docs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Tracking System</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Document Tracking System</h2>

        <!-- Search Form -->
        <form method="POST" class="mb-4">
            <div class="form-row">
                <div class="col-md-8">
                    <input type="text" name="search_query" class="form-control" placeholder="Search by tracking number or description" value="<?php echo htmlspecialchars($search_query); ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" name="search" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document ID</th>
                    <th>Tracking Number</th>
                    <th>Description</th>
                    <th>Origin</th>
                    <th>Receiving Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result_docs) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result_docs)): ?>
                        <tr>
                            <td><?php echo $row['doc_id']; ?></td>
                            <td><?php echo $row['doc_tracking']; ?></td>
                            <td><?php echo $row['docs_description']; ?></td>
                            <td><?php echo $row['origin_school']; ?></td>
                            <td><?php echo $row['receiving_section_desc']; ?></td>
                            <td>
                                <!-- Link to view tracking history -->
                                <a href="view_tracking_history.php?doc_id=<?php echo $row['doc_id']; ?>" class="btn btn-info">
                                    View Tracking History
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No documents found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
