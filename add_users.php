<?php
// Include the database connection file
include 'roxcon.php';

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

// Initialize variables for error and success messages
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Do not hash the password
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $designation = $_POST['designation'] ?? 'Employee';
    $dts_admin = $_POST['dts_admin'] ?? 0;
    $dts_section_id = $_POST['dts_section_id'];
    $staff_id = $_POST['staff_id'] ?? 0;
    $station_id = $_POST['station_id'] ?? 1;
    $school_head = $_POST['school_head'] ?? 'No';
    $ict_coordinator = $_POST['ict_coordinator'];
    $property_custodian = $_POST['property_custodian'] ?? 'No';
    $user_type = $_POST['user_type'];
    $system_admin = $_POST['system_admin'] ?? 0;
    $approved = $_POST['approved'] ?? 1;
    $active = $_POST['active'] ?? 1;

    // Prepare SQL query
    $sql = "INSERT INTO users (fullname, email, password, first_name, middle_name, last_name, sex, designation, dts_admin, dts_section_id, staff_id, station_id, school_head, ict_coordinator, property_custodian, user_type, system_admin, approved, active) 
            VALUES ('$fullname', '$email', '$password', '$first_name', '$middle_name', '$last_name', '$sex', '$designation', $dts_admin, $dts_section_id, $staff_id, $station_id, '$school_head', '$ict_coordinator', '$property_custodian', '$user_type', $system_admin, $approved, $active)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $success_message = "New user added successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Add New User</h2>

    <?php
    if ($error_message) {
        echo "<div class='alert alert-danger'>$error_message</div>";
    }
    if ($success_message) {
        echo "<div class='alert alert-success'>$success_message</div>";
    }
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" id="fullname" name="fullname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select id="sex" name="sex" class="form-select" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" id="designation" name="designation" class="form-control" value="Employee">
        </div>

        <div class="mb-3">
            <label for="dts_section_id" class="form-label">Section</label>
            <select id="dts_section_id" name="dts_section_id" class="form-select" required>
                <?php
                foreach ($sections as $id => $section) {
                    echo "<option value='$id'>$section</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="ict_coordinator" class="form-label">ICT Coordinator</label>
            <select id="ict_coordinator" name="ict_coordinator" class="form-select" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">User Type</label>
            <input type="text" id="user_type" name="user_type" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>

        <a href="display_users.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<!-- Include Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
