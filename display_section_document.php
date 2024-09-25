<?php
// Start the session and include database connection
// session_start();
// include 'roxcon.php';

// Retrieve the logged-in user's section ID from the session
$section_id = $_SESSION['section_id']; // Assuming section_id is stored in session

// Query to fetch documents belonging to the logged-in user's section
$sql = "SELECT dts_docs.doc_id, dts_docs.doc_tracking, dts_docs.docs_description, dts_docs.origin_school, dts_sections.section_description AS receiving_section_desc
        FROM dts_docs
        INNER JOIN dts_sections ON dts_docs.receiving_section = dts_sections.section_id
        WHERE dts_docs.origin_section = $section_id
        ORDER BY dts_docs.doc_id DESC
        LIMIT 20";

$result_docs = mysqli_query($conn, $sql);
?>


<!-- Display the documents in a Bootstrap table -->
<div class="container mt-5">
    <h2 class="mb-4">Documents from Your Section</h2>
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Tracking Number</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result_docs) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result_docs)): ?>
                    <tr>
                        <td><?php echo $row['doc_tracking']; ?></td>
                        <td><?php echo $row['docs_description']; ?></td>
                        <td>
                            <!-- Link to view tracking history -->
                            <a href='index.php?page=view_tracking&doc_id=<?php echo $row['doc_id']; ?>' class='btn btn-info btn-sm'>View Tracking History</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No documents found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>