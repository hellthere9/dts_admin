<?php
// session_start();
// ob_start();  // Start output buffering
?>

<?php
session_start(); // Start the session
ob_start();

// Include the database connection
include 'roxcon.php';

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php"); // Redirect to login page if not logged in
//     exit();
// }

// Check if the user is logged in and is a system admin|| $_SESSION['system_admin'] != 1
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not authorized
    exit();
}

// Fetch user details (optional)
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
// $user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Document Tracking System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Add your favicon -->
        <link rel="icon" href="images/favicon-16x16.png" type="image/x-icon">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php?page=display_section_documents">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                My Documents
                            </a>
                            <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=load_section_documents">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Inbox
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=display_documents">Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=display_users">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=display_sections">Sections</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=google_calendar">Function Rooms Reservation Schedule</a>
                        </li>
                        <li class="nav-item">




                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Links
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="https://www.deped.gov.ph/" target=_blank>DepEd Website</a>
                                    <a class="nav-link" href="https://r10.deped.gov.ph/" target=_blank>R10 Website</a>
                                    <a class="nav-link" href="https://depedph-my.sharepoint.com/:f:/g/personal/ralphsimon_mabulay_deped_gov_ph/EhqTBDr_oolKhdglpMXl6NYBX3yPu0rzi59JJVbkmXk1xw?e=vmfowW" target=_blank>Templates</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <p><?php echo $_SESSION['fullname']; ?></p>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <!-- Content Area -->
            <div class="container-fluid px-4">

                                <?php
                                // Determine which page to load
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    switch ($page) {
                                        case 'display_documents':
                                            include 'display_documents.php';
                                            break;
                                        case 'display_users':
                                            include 'display_users.php';
                                            break;
                                        case 'edit_user':
                                            include 'edit_user.php';
                                            break;
                                        case 'delete_user':
                                            include 'delete_user.php';
                                            break;
                                        case 'view_tracking':
                                            include 'view_tracking_history.php';
                                            break;
                                        case 'display_sections':
                                                include 'display_sections.php';
                                                break;
                                        case 'edit_section':
                                                include 'edit_section.php';
                                                break;  
                                        case 'view_section_users':
                                                    include 'view_section_users.php';
                                                    break; 
                                        case 'add_user':
                                                include 'add_users.php';
                                                break; 
                                        case 'display_section_documents': // Documents made by you
                                                include 'display_section_document.php';
                                                break;
                                        case 'add_section': // New case for Add Section page
                                                include 'add_section_form.php';
                                        break; case 'google_calendar':
                                                include 'google_calendar.php';  // Add this line for the Google Calendar
                                                break;
                                        case 'load_section_documents': // Inbox
                                                include 'load_section_documents.php';
                                                break;
                                        case 'add_document': // Load your new module
                                                include 'add_document.php';
                                                break;
                                    }
                                } else {
                                    include 'display_section_document.php';
                                    // include 'dashboard.php'; // Load the default dashboard
                                }
                                ?>

            </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php ob_end_flush(); // Flush the output buffer ?>
