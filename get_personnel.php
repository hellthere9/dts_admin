<?php
// Include the database connection
include 'roxcon.php';

if (isset($_POST['section_id'])) {
    $section_id = intval($_POST['section_id']);

    // Fetch users based on the selected section
    $query = "SELECT users_id, fullname FROM users WHERE dts_section_id = '$section_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">Select Personnel</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['users_id'] . '">' . $row['fullname'] . '</option>';
        }
    } else {
        echo '<option value="">No personnel found</option>';
    }
}
?>
