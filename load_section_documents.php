<?php
// Start session to use session variables
// session_start();
// include 'roxcon.php'; // Include your database connection

// Get the section_id from the session
$section_id = $_SESSION['section_id'];

// Get the current year (this should be defined before the query)
$current_year = date('Y');

// Query to fetch documents based on receiving_section and current year
$query = "SELECT d.doc_id, d.doc_tracking, d.docs_description, s.section_description 
          FROM dts_docs d
          JOIN dts_sections s ON d.receiving_section = s.section_id
          WHERE d.receiving_section = '$section_id'
          AND YEAR(d.datetime_posted) = '$current_year'
          ORDER BY d.doc_id DESC
          LIMIT 50";
$result_docs = mysqli_query($conn, $query);

// Check for errors in the query
if (!$result_docs) {
    die("Error in query: " . mysqli_error($conn));
}
?>

<!-- Bootstrap Table for displaying documents -->
<div class="container mt-5">
    <h2 class="mb-4">Inbox</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tracking Number</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result_docs) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result_docs)): ?>
                    <tr>
                        <td><?php echo $row['doc_tracking']; ?></td>
                        <td><?php echo $row['docs_description']; ?></td>
                        <td>
                            <!-- Actions: View tracking history -->
                            <a href='index.php?page=view_tracking&doc_id=<?php echo $row["doc_id"]; ?>' class='btn btn-info btn-sm'>View Tracking History</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No documents found for your section.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
// Free result set and close the connection
mysqli_free_result($result_docs);
mysqli_close($conn);
?>
