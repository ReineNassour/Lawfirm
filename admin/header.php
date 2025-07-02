<header>
    <!-- Top Info Bar -->
    <div class="top-bar py-2" style="background-color: #2c3e50;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 mb-2 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div class="mr-4">
                            <i class="far fa-envelope mr-2"></i>
                            <a href="mailto:info@thefirm.com" class="text-white">info@thefirm.com</a>
                        </div>
                        <div>
                            <i class="fas fa-phone-alt mr-2"></i>
                            <a href="tel:+1234567890" class="text-white">+123 456 7890</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="d-flex justify-content-lg-end justify-content-center">
                        <div class="mr-3">
                            <i class="far fa-clock mr-2"></i>
                            <span class="text-white">Mon - Fri: 8:00 AM - 6:00 PM</span>
                        </div>
                        <div class="social-icons d-none d-lg-block">
                            <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white mx-2"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg py-3" style="background-color: #fff; box-shadow: 0 2px 15px rgba(0,0,0,0.1);">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <span style="font-size: 28px; font-weight: 700; color: #2c3e50;">
                    <i class="fas fa-balance-scale mr-2" style="color: #3498db;"></i>TheFirm
                </span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars" style="color:#1a2236; font-size:28px;"></i>
                </span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php" style="color: #1a2236; font-weight: 500;">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="applicants.php" style="color: #1a2236; font-weight: 500;">Applicants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" style="color: #1a2236; font-weight: 500;">Contacts</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="calendar.php" style="color: #1a2236; font-weight: 500;">Zoom Calendar</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="sessioncalendar.php" style="color: #1a2236; font-weight: 500;">Sessions Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="passedlawyers.php" style="color: #1a2236; font-weight: 500;">Passed Lawyers</a>
                    </li>
                </ul>

                <!-- User Menu - FIXED DROPDOWN -->
                <?php if (isset($_SESSION['admin'])) { ?>
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar mr-2" style="background-color: #3498db; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-info">
                                <span style="color: #1a2236; font-weight: 500;"><?php echo $_SESSION['admin']['fullName']; ?></span>
                                <small class="d-block text-muted">Legal Administrator</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: none; margin-top: 10px;">
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php" style="padding: 10px 20px;"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>
