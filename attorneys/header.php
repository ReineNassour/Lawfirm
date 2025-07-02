
        <header>
            <!-- Top Info Bar -->
            <div class="top-bar py-2" style="background-color: #1a2236;">
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
                                    <span>Mon - Fri: 8:00 AM - 6:00 PM</span>
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
                        <span style="font-size: 28px; font-weight: 700; color: #1a2236;">
                            <i class="fas fa-balance-scale mr-2" style="color: #007bff;"></i>TheFirm
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
                                <a class="nav-link px-3" href="index.php" style="color: #1a2236; font-weight: 500;">All Cases</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link px-3" href="finishedcases.php" style="color: #1a2236; font-weight: 500;">Old Cases</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" href="calendar.php" style="color: #1a2236; font-weight: 500;">Zoom Calendar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" href="calendarSession.php" style="color: #1a2236; font-weight: 500;">Sessions Calendar</a>
                            </li>
                        </ul>

                        <!-- User Menu -->
                        <?php if (isset($_SESSION['attorney'])) { ?>
                            <div class="user-menu dropdown">
                                <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar mr-2" style="background-color: #e9ecef; width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user" style="color: #495057;"></i>
                                    </div>
                                    <div class="user-info">
                                        <span style="color: #1a2236; font-weight: 500;"><?php echo $_SESSION['attorney']['fullName']; ?></span>
                                        <input type="hidden" name="attid" value="<?= $_SESSION['attorney']['id']; ?>">
                                        <small class="d-block text-muted">Attorney</small>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                                </div>
                            </div>
                            <?php } 
                                ?>
                    </div>
                </div>
            </nav>
        </header>