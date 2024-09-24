<?php
// Include the database connection file
// include 'roxcon.php';

// Define the section options
$sections = [
    1 => 'Records Section',
    2 => 'Office of the Regional Director',
    3 => 'Office of the Assistant Regional Director',
    4 => 'Administrative Division',
    5 => 'Curriculum & Learning Management Division',
    6 => 'Education Support Service Division',
    7 => 'Finance Division',
    8 => 'Field & Technical Assistance Division',
    9 => 'Human Resource Development Division',
    10 => 'Policy Planning & Research Division',
    11 => 'Quality Assurance Division',
    12 => 'Learning Resource Management',
    13 => 'Legal Unit',
    14 => 'ICT Unit',
    15 => 'Personnel Section',
    16 => 'Cashier Section',
    17 => 'Accounting Section',
    18 => 'Budget Section',
    19 => 'Asset Management Section',
    20 => 'Commission on Audit',
    21 => 'Records Section (Releasing)',
    23 => 'Public Affairs Unit',
    38 => 'General Services'
];

// Fetch users data
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">
    <a href="index.php?page=add_user" class="btn btn-primary btn-sm">Add</a>    
    Users List</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Designation</th>
                <th scope="col">Section</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
             // Output data of each row
            while($row = $result->fetch_assoc()) {
                 $section_name = $sections[$row['dts_section_id']] ?? 'Unknown';
                echo "<tr>";
                echo "<td>" . $row['users_id'] . "</td>";

                // Check if the user is a system admin and add the image if true
                $admin_image = $row['system_admin'] == 1 ? "<img src='images/admin-panel.png' alt='Admin Panel' style='width: 20px; height: 20px; margin-left: 5px;'>" : "";
                echo "<td>" . $row['fullname'] . " " . $admin_image . "</td>";

                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['designation'] . "</td>";
                echo "<td>" . $section_name . "</td>";
                echo "<td>";
                echo "<a href='index.php?page=edit_user&id=" . $row['users_id'] . "' class='btn btn-sm btn-warning me-2'>Edit</a>";
                echo "<a href='index.php?page=delete_user&id=" . $row['users_id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
                echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
