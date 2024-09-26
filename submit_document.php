<?php
// Include the database connection
include 'roxcon.php';
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $doc_type_id = mysqli_real_escape_string($conn, $_POST['doc_type']);
    $docs_description = mysqli_real_escape_string($conn, $_POST['docs_description']);
    $receiving_section = mysqli_real_escape_string($conn, $_POST['section_to']);
    $personnel = mysqli_real_escape_string($conn, $_POST['personnel']); // User selected in To: form

    $track_issuedby_userid = $_SESSION['user_id']; // From session
    $origin_fname = $_SESSION['fullname']; // From session
    $origin_userid = $_SESSION['user_id']; // From session
    $origin_section = $_SESSION['section_id']; // From session
    $datetime_now = date("Y-m-d H:i:s"); // Current datetime
    $active = 1; // Always active

    // Step 1: Insert a new document into the dts_docs table
    $sql_insert = "INSERT INTO dts_docs (doc_type_id, docs_description, origin_fname, origin_userid, origin_section, receiving_section, datetime_posted, datetime_updated, active)
                   VALUES ('$doc_type_id', '$docs_description', '$origin_fname', '$origin_userid', '$origin_section', '$receiving_section', '$datetime_now', '$datetime_now', '$active')";

    if (mysqli_query($conn, $sql_insert)) {
        // Step 2: Get the newly inserted document's ID
        $doc_id = mysqli_insert_id($conn);

        // Step 3: Create the document tracking number (last 2 digits of year + '-' + doc_id)
        $current_year_last2 = date("y");
        $doc_tracking = $current_year_last2 . '-' . $doc_id;

        // Step 4: Update the doc_tracking field for the newly inserted document
        $sql_update_tracking = "UPDATE dts_docs SET doc_tracking = '$doc_tracking' WHERE doc_id = '$doc_id'";
        mysqli_query($conn, $sql_update_tracking);

        // Step 5: Insert the initial tracking history in dts_docroutes
        // Fetch the description of the receiving section for tracking details
        $sql_section = "SELECT section_description FROM dts_sections WHERE section_id = '$receiving_section'";
        $result_section = mysqli_query($conn, $sql_section);
        $section_description = mysqli_fetch_assoc($result_section)['section_description'];

        $sql_insert_route = "INSERT INTO dts_docroutes (document_id, previous_route_id, route_fromuser_id, route_from, route_fromsection_id, route_fromsection, route_tosection_id, route_tosection, route_touser_id, datetime_forwarded)
                             VALUES ('$doc_id', 0, '$origin_userid', '$origin_fname', '$origin_section', '$section_description', '$receiving_section', '$section_description', '$personnel', '$datetime_now')";

        mysqli_query($conn, $sql_insert_route);

        // Redirect to index.php with a success message
        header("Location: index.php?document_added=true");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If form wasn't submitted, redirect back to the form page
    header("Location: add_document.php");
    exit();
}

// Close the connection
mysqli_close($conn);
?>

