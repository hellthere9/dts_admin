<?php
session_start();
include 'roxcon.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check for user credentials
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        // Assuming you're not hashing the password for testing
        if ($password == $row['password']) {
            if ($row['system_admin'] == 1) {
                // Set session variables for the logged-in user
                $_SESSION['user_id'] = $row['users_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['system_admin'] = $row['system_admin'];
                $_SESSION['section_id'] = $row['dts_section_id'];

                // Redirect with a success message to index.php
                header("Location: index.php?login_success=true");
                exit();
            } else {
                // Display alert if invalid credentials or not system admin
                echo "<script>alert('Invalid email, password, or you do not have system admin access.'); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid email, password, or you do not have system admin access.'); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid email, password, or you do not have system admin access.'); window.location.href = 'login.php';</script>";
    }
    

    $stmt->close();
    $conn->close();
};
?>

<!-- Your HTML form stays the same -->



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>DTS</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                    <form method="POST" action="login.php">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" id="email" class="form-control" required>
                                            <label for="email">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" id="password" class="form-control" required>
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="remember" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Me</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
