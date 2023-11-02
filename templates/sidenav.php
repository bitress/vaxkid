<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Account)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Home</div>
                <!-- Sidenav  (Dashboard)-->

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "" ? 'active' : '' ?>" href="/">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/manage-children.php" ? 'active' : '' ?>" href="/manage-children.php">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Manage Children
                </a>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/view-children.php" ? 'active' : '' ?>" href="/view-children.php">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    View Children Information
                </a>

                <?php /** @var $user User */ if($user->mhoAccessOnly()): ?>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/manage-vaccines.php" ? 'active' : '' ?>" href="/manage-vaccines.php">
                    <div class="nav-link-icon"><i class="fa fa-syringe"></i></div>
                    Manage Vaccines
                </a>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/manage-midwife.php" ? 'active' : '' ?>" href="/manage-midwife.php">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    Manage Midwife
                </a>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/manage-schedule.php" ? 'active' : '' ?>" href="/manage-schedule.php">
                    <div class="nav-link-icon"><i data-feather="calendar"></i></div>
                    Manage Schedules
                </a>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/report.php" ? 'active' : '' ?>" href="/report.php">
                    <div class="nav-link-icon"><i class="fa fa-file"></i></div>
                    Reports
                </a>

                <a class="nav-link <?= $_SERVER['SCRIPT_NAME'] === "/manage-user.php" ? 'active' : '' ?>" href="/manage-user.php">
                    <div class="nav-link-icon"><i class="fa fa-users"></i></div>
                    Manage Users
                </a>

                <?php endif; ?>

            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title"><?= /** @var User $u */
                    htmlentities($u['name'], ENT_QUOTES | ENT_HTML5) ?></div>
            </div>
        </div>
    </nav>
</div>
