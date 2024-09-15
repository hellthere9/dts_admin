<?php
// Include the database connection
// include 'roxcon.php';

// Get the document ID from the URL
$doc_id = isset($_GET['doc_id']) ? intval($_GET['doc_id']) : 0;

if ($doc_id > 0) {
    // Query to fetch document details
    $sql_doc = "SELECT * FROM dts_docs WHERE doc_id = '$doc_id'";
    $result_doc = mysqli_query($conn, $sql_doc);
    $document = mysqli_fetch_assoc($result_doc);

    // Query to fetch tracking history
    $sql_tracking = "SELECT * FROM dts_docroutes WHERE document_id = '$doc_id' ORDER BY datetime_forwarded ASC";
    $result_tracking = mysqli_query($conn, $sql_tracking);
} else {
    echo "Invalid Document ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking History for Document #<?php echo $doc_id; ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional styles for print view */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Tracking History for Document #<?php echo $doc_id; ?></h2>

        <!-- Display document details -->
        <div class="card mb-4">
            <div class="card-header">
                Document Details
            </div>
            <div class="card-body">
                <p><strong>Tracking Number:</strong> <?php echo $document['doc_tracking']; ?></p>
                <p><strong>Description:</strong> <?php echo $document['docs_description']; ?></p>
                <p><strong>Origin:</strong> <?php echo $document['origin_school']; ?></p>
                <p><strong>Receiving Section:</strong> <?php echo $document['receiving_section']; ?></p>
            </div>
        </div>

        <!-- Display tracking history -->
        <h3>Tracking History</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>From Section</th>
                    <th>To Section</th>
                    <th>Forwarded Date</th>
                    <th>Received Date</th>
                    <th>Actions Taken</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tracking_row = mysqli_fetch_assoc($result_tracking)): ?>
                    <tr>
                        <td><?php echo $tracking_row['route_fromsection']; ?></td>
                        <td><?php echo $tracking_row['route_tosection']; ?></td>
                        <td><?php echo $tracking_row['datetime_forwarded']; ?></td>
                        <td><?php echo $tracking_row['datetime_route_accepted']; ?></td>
                        <td><?php echo $tracking_row['actions_taken']; ?></td>
                        <td><?php echo $tracking_row['fwd_remarks']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="btn btn-secondary no-print" onclick="window.print()">Print Document</button>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
