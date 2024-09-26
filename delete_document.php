<?php
// Include the database connection
include 'roxcon.php';
session_start();

// Get the document ID from the URL
$doc_id = isset($_GET['doc_id']) ? intval($_GET['doc_id']) : 0;

if ($doc_id > 0) {
    // Start by deleting the tracking history for the document
    $sql_delete_tracking = "DELETE FROM dts_docroutes WHERE document_id = '$doc_id'";
    if (mysqli_query($conn, $sql_delete_tracking)) {
        // Now delete the document itself
        $sql_delete_document = "DELETE FROM dts_docs WHERE doc_id = '$doc_id'";
        if (mysqli_query($conn, $sql_delete_document)) {
            // Redirect to the section documents page with a success message
            header("Location: index.php?page=display_section_documents&delete_success=true");
            exit();
        } else {
            echo "Error deleting document: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting tracking history: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Document ID.";
    exit();
}

// Close the connection
mysqli_close($conn);
?>
