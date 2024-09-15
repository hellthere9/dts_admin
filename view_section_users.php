<?php
include 'roxcon.php'; // Database connection

// Get the section ID from the URL
$section_id = isset($_GET['section_id']) ? (int)$_GET['section_id'] : 0;

if ($section_id > 0) {
    // Query to get the users under this section
    $query = "SELECT users_id, fullname, email, designation FROM users WHERE dts_section_id = $section_id";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='container mt-4'>";
            echo "<h2 class='mb-4'>Users in Section</h2>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Designation</th></tr></thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['users_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
        } else {
            echo "<div class='container mt-4'><p>No users found for this section.</p></div>";
        }
    } else {
        // Output the error if the query fails
        echo "<div class='container mt-4'><p>Error in query: " . mysqli_error($conn) . "</p></div>";
    }
} else {
    echo "<div class='container mt-4'><p>Invalid section ID.</p></div>";
}
?>
