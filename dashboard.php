
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - VaxKid</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/icon/favicon.ico" />
    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="css/loader.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!--    <link rel="stylesheet" href="assets/multi-select/css/bootstrap-multiselect.min.css">-->
    <link rel="stylesheet" href="assets/chosen/chosen.css">
    <style>
        .modal-open .modal-backdrop.in:nth-child(2) { opacity: .5 }
        .modal-backdrop.in { opacity: 0 }
        .required {
          color: red;
        }
    </style>

</head>
<body class="nav-fixed">

<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="dashboard.php">VaxKid</a>
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- Alerts Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="me-2" data-feather="bell"></i>
                    Alerts Center
                </h6>
                    <div id="notificationList"></div>
            </div>
        </li>

        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name userNamePlaceholder"></div>
                        <div class="dropdown-user-details-email emailPlaceholder"></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item load" data-load="view-settings" lmao="#/">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>
                <a class="dropdown-item" id="logout">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>


<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <div class="sidenav-menu-heading">Home</div>
                    <!-- Sidenav  (Dashboard)-->

                    <a class="nav-link load active" lmao="#/dashboard" data-load="dashboard">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                    </a>

                   <a class="nav-link load" lmao="#/manage-children" data-load="manage-children">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Manage Children
                    </a>

                    <a class="nav-link load" data-load="view-children" lmao="#/view-children">
                    <div class="nav-link-icon"><i data-feather="book"></i></div>
                    View Children Information
                    </a>


                    <a class="nav-link load noMidwifeAccess" data-load="view-vaccines" lmao="#/manage-vaccines">
                    <div class="nav-link-icon"><i class="fa fa-syringe"></i></div>
                    Manage Vaccines
                    </a>

                    <a class="nav-link load noMidwifeAccess" data-load="view-midwife" lmao="#/manage-midwife">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    Manage Midwife
                    </a>

                   <a class="nav-link load noMidwifeAccess" data-load="view-schedules" lmao="#/manage-schedules">
                    <div class="nav-link-icon"><i data-feather="calendar"></i></div>
                    Manage Schedules
                    </a>

                   <a class="nav-link load noMidwifeAccess" data-load="view-users" lmao="#/manage-users">
                        <div class="nav-link-icon"><i class="fa fa-users"></i></div>
                        Manage Users
                    </a>

                    <a class="nav-link load noMidwifeAccess" data-load="view-reports" lmao="#/reports">
                    <div class="nav-link-icon"><i class="fa fa-file"></i></div>
                    Reports
                    </a>
                    
                    <div class="sidenav-menu-heading">System</div>

                    <a class="nav-link load noMidwifeAccess" data-load="view-logs" lmao="#/logs">
                    <div class="nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i>    </div>
                    Activity Logs
                    </a>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title userNamePlaceholder"></div>
                </div>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">


        <div id="main"></div>
        <!--        Footer Start        -->
        <footer class="footer-admin mt-auto footer-light">
            <div class="container-xl px-4">
                <div class="row">
                    <div class="col-md-6 small"> </div>
                    <div class="col-md-6 text-md-end small">
                       Copyright © VaxKid 2023
                    </div>
                </div>
            </div>
        </footer>
        <!--        Footer End        -->
    </div>
</div>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--<script src="assets/multi-select/js/bootstrap-multiselect.min.js"></script>-->
<script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="js/sidebar.js"></script>
<script src="assets/chosen/chosen.jquery.min.js"></script>
<script src="js/checkLogin.js"></script>
<script>
    $("#logout").click(function(){

        swal({
            title: "Are you sure you want to logout? ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            . then((willLogout) => {
                if (willLogout) {
                    swal("Logout successfully!",{
                        icon: "success",
                    });
                    setInterval(function() {
                        window.location.href = "logout.php";
                    }, 1000);
                }
            });
    });
</script>
</body>
</html>
