<?php  
include 'db.php';
?>
 <header class="header" >
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-2">
                 <a href="index.php" class="logo">The<span>Firm</span></a>
             </div>
             <div class="col-lg-10">
                 <nav class="navbar navbar-expand-lg navbar-dark">
                     <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarNav">
                         <ul class="navbar-nav mx-auto">
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php">Home</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="practice.php">Practice Areas</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="attorneys.php">Attorneys</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="cases.php">Cases</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact</a>
                             </li>
                             

                             <li class="nav-item">
                                
                                <?php
                                if(isset($_SESSION['user'])){
                                $sql1 = "SELECT * FROM user WHERE id=" . $_SESSION['user']['id'];
                                $result1 = $conn->query($sql1);
                                $row1 = $result1->fetch_assoc();
                                
                                $sql2 = "SELECT * FROM `case` WHERE userid=" . $row1['id'];
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                
                                if ($row2 && isset($row2['status']) && $row2['status'] == 'Accepted') {
                                    echo '<a class="nav-link" href="track.php">Track Your Case</a>';
                                }
                            }
                                ?>
                             </li>

                             <li class="nav-item">
                                
                                <?php
                                if(isset($_SESSION['user'])){
                                $sql1 = "SELECT * FROM user WHERE id=" . $_SESSION['user']['id'];
                                $result1 = $conn->query($sql1);
                                $row1 = $result1->fetch_assoc();
                                
                                $sql2 = "SELECT * FROM `cv` WHERE userid=" . $row1['id'];
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                
                                if ($row2 && isset($row2['status']) && $row2['status'] == 'Accepted') {
                                    echo '<a class="nav-link" href="application.php">Track Your Application</a>';
                                }
                            }
                                ?>
                             </li>

                         </ul>
                             <?php if (isset($_SESSION['user'])): ?>
                                 <div class="d-flex align-items-center">
                                     <span class="user-welcome">Welcome, <?php echo $_SESSION['user']['fullName']; ?></span>
                                     <a href="logout.php" class="btn btn-outline">Logout</a>
                                 </div>
                             <?php else: ?>
                                 <a href="login.php" class="btn btn-outline">Login</a>
                             <?php endif; ?>
                         </div>
                     </div>
                 </nav>
             </div>
         </div>
     </div>
 </header>

 <style>
 
     :root {
         --primary: #9d8e69;
         --primary-dark: #7d6e49;
         --primary-light: #d5cbb8;
         --secondary: #2e3b4e;
         --secondary-light: #4a5b6e;
         --secondary-dark: #1e2b3e;
         --accent: #a32c38;
         --light: #f8f8f8;
         --dark: #111827;
         --gray: #6b7280;
         --gray-light: #d1d5db;
         --white: #ffffff;
         --header-height: 90px;
     }

     * {
         box-sizing: border-box;
         margin: 0;
         padding: 0;
     }

     body {
         font-family: 'Montserrat', sans-serif;
         font-weight: 400;
         color: var(--secondary-dark);
         line-height: 1.7;
         overflow-x: hidden;
         background-color: var(--light);
         position: relative;
     }

     h1,
     h2,
     h3,
     h4,
     h5,
     h6 {
         font-family: 'Cormorant', serif;
         font-weight: 700;
         line-height: 1.3;
         color: var(--secondary-dark);
     }

     p {
         margin-bottom: 1.5rem;
     }

     a {
         text-decoration: none;
         color: inherit;
         transition: all 0.3s ease;
     }

     img {
         max-width: 100%;
         height: auto;
     }

     .container {
         max-width: 1400px;
         padding: 0 2rem;
     }

     @media (min-width: 1600px) {
         .container {
             max-width: 1520px;
         }
     }

     /* Buttons */
     .btn {
         display: inline-block;
         padding: 12px 30px;
         border-radius: 0;
         font-weight: 600;
         font-size: 14px;
         letter-spacing: 1px;
         text-transform: uppercase;
         transition: all 0.3s ease;
         position: relative;
         overflow: hidden;
         z-index: 1;
     }

     .btn::after {
         content: '';
         position: absolute;
         bottom: 0;
         left: 0;
         width: 100%;
         height: 100%;
         z-index: -2;
     }

     .btn::before {
         content: '';
         position: absolute;
         bottom: 0;
         left: 0;
         width: 0%;
         height: 100%;
         transition: all 0.3s;
         z-index: -1;
     }

     .btn:hover {
         color: #fff;
     }

     .btn:hover::before {
         width: 100%;
     }

     .btn-primary {
         color: #fff;
         background-color: var(--primary);
         border: none;
     }

     .btn-primary::after {
         background-color: var(--primary);
     }

     .btn-primary::before {
         background-color: var(--secondary-dark);
     }

     .btn-secondary {
         color: #fff;
         background-color: var(--secondary);
         border: none;
     }

     .btn-secondary::after {
         background-color: var(--secondary);
     }

     .btn-secondary::before {
         background-color: var(--primary);
     }

     .btn-outline {
         color: var(--primary);
         background-color: transparent;
         border: 1px solid var(--primary);
     }

     .btn-outline::after {
         background-color: transparent;
     }

     .btn-outline::before {
         background-color: var(--primary);
     }

     .btn-outline:hover {
         color: #fff;
     }

     .btn-accent {
         color: #fff;
         background-color: var(--accent);
         border: none;
     }

     .btn-accent::after {
         background-color: var(--accent);
     }

     .btn-accent::before {
         background-color: var(--secondary-dark);
     }

     /* Header */
     .header {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         z-index: 999;
         padding: 25px 0;
         transition: all 0.4s ease;
     }

     .header.sticky {
         position: fixed;
         background-color: rgba(17, 24, 39, 0.95);
         padding: 15px 0;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         animation: fadeInDown 0.5s ease;
     }

     @keyframes fadeInDown {
         from {
             opacity: 0;
             transform: translateY(-100%);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     .header .logo {
         font-family: 'Cormorant', serif;
         font-weight: 700;
         font-size: 32px;
         color: var(--white);
         letter-spacing: 1px;
         margin: 0;
         position: relative;
     }

     .header .logo span {
         color: var(--primary);
     }

     .header .logo::after {
         content: '';
         position: absolute;
         width: 25px;
         height: 2px;
         background-color: var(--primary);
         bottom: -8px;
         left: 0;
     }

     .nav-item {
         margin: 0 10px;
     }

     .nav-link {
         font-size: 14px;
         font-weight: 500;
         text-transform: uppercase;
         letter-spacing: 1px;
         color: var(--white) !important;
         padding: 10px 15px !important;
         position: relative;
     }

     .nav-link::before {
         content: '';
         position: absolute;
         width: 0;
         height: 2px;
         background-color: var(--primary);
         bottom: 5px;
         left: 15px;
         transition: all 0.3s ease;
     }

     .nav-link.active::before,
     .nav-link:hover::before {
         width: calc(100% - 30px);
     }

     .header-actions {
         display: flex;
         align-items: center;
     }

     .header-contact {
         display: flex;
         align-items: center;
         margin-right: 30px;
     }

     .header-contact i {
         font-size: 20px;
         color: var(--primary);
         margin-right: 10px;
     }

     .header-contact-info span {
         display: block;
         font-size: 12px;
         color: var(--gray-light);
     }

     .header-contact-info strong {
         font-size: 14px;
         color: var(--white);
         font-weight: 600;
     }

     .user-welcome {
         color: var(--white);
         font-size: 14px;
         margin-right: 20px;
     }

     /* Hero Section */
     .hero {
         position: relative;
         height: 100vh;
         min-height: 700px;
         display: flex;
         align-items: center;
         overflow: hidden;
         background-color: var(--dark);
     }

     .hero::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: linear-gradient(to right, rgba(17, 24, 39, 0.9), rgba(17, 24, 39, 0.7));
         z-index: 1;
     }

     .hero-slider {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
     }

     .hero-slide {
         width: 100%;
         height: 100%;
         position: relative;
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
     }

     .hero-content {
         position: relative;
         z-index: 2;
         max-width: 700px;
     }

     .hero-subtitle {
         font-size: 16px;
         font-weight: 500;
         color: var(--primary);
         letter-spacing: 3px;
         text-transform: uppercase;
         margin-bottom: 20px;
         position: relative;
         padding-left: 50px;
     }

     .hero-subtitle::before {
         content: '';
         position: absolute;
         width: 40px;
         height: 1px;
         background-color: var(--primary);
         top: 50%;
         left: 0;
     }

     .hero-title {
         font-size: 60px;
         font-weight: 700;
         color: var(--white);
         margin-bottom: 30px;
         line-height: 1.2;
     }

     .hero-text {
         font-size: 18px;
         color: var(--gray-light);
         margin-bottom: 40px;
     }

     .hero-buttons {
         display: flex;
         gap: 20px;
     }

     .hero-pagination {
         position: absolute;
         bottom: 50px;
         right: 50px;
         z-index: 2;
         display: flex;
     }

     .hero-pagination-item {
         width: 30px;
         height: 3px;
         background-color: rgba(255, 255, 255, 0.3);
         margin: 0 5px;
         cursor: pointer;
         transition: all 0.3s ease;
     }

     .hero-pagination-item.active {
         background-color: var(--primary);
         width: 50px;
     }

     /* Features Section */
     .features {
         position: relative;
         margin-top: -80px;
         z-index: 2;
     }

     .feature-card {
         background-color: var(--white);
         padding: 40px 30px;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
         height: 100%;
         transition: all 0.3s ease;
         position: relative;
         overflow: hidden;
         z-index: 1;
         display: flex;
         flex-direction: column;
         align-items: center;
         text-align: center;
     }

     .feature-card::before {
         content: '';
         position: absolute;
         width: 100%;
         height: 0;
         background-color: var(--primary);
         bottom: 0;
         left: 0;
         z-index: -1;
         transition: all 0.3s ease;
     }

     .feature-card:hover::before {
         height: 5px;
     }

     .feature-card:hover {
         transform: translateY(-10px);
         box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
     }

     .feature-icon {
         width: 80px;
         height: 80px;
         background-color: var(--light);
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin-bottom: 25px;
         transition: all 0.3s ease;
     }

     .feature-card:hover .feature-icon {
         background-color: var(--primary-light);
     }

     .feature-icon i {
         font-size: 30px;
         color: var(--primary);
     }

     .feature-title {
         font-size: 22px;
         margin-bottom: 15px;
         position: relative;
         padding-bottom: 15px;
     }

     .feature-title::after {
         content: '';
         position: absolute;
         width: 40px;
         height: 2px;
         background-color: var(--primary);
         bottom: 0;
         left: 50%;
         transform: translateX(-50%);
     }

     .feature-text {
         color: var(--gray);
         margin-bottom: 0;
     }

     /* About Section */
     .about {
         padding: 120px 0;
         position: relative;
         overflow: hidden;
     }

     .about::before {
         content: '';
         position: absolute;
         width: 600px;
         height: 600px;
         background-color: var(--primary-light);
         opacity: 0.3;
         border-radius: 50%;
         top: -300px;
         left: -300px;
         z-index: -1;
     }

     .section-subtitle {
         font-size: 14px;
         font-weight: 600;
         color: var(--primary);
         letter-spacing: 2px;
         text-transform: uppercase;
         margin-bottom: 15px;
         display: block;
     }

     .section-title {
         font-size: 42px;
         margin-bottom: 25px;
         position: relative;
         padding-bottom: 20px;
     }

     .section-title::after {
         content: '';
         position: absolute;
         width: 60px;
         height: 3px;
         background-color: var(--primary);
         bottom: 0;
         left: 0;
     }

     .section-title.text-center::after {
         left: 50%;
         transform: translateX(-50%);
     }

     .about-text {
         margin-bottom: 40px;
     }

     .about-image {
         position: relative;
         z-index: 1;
     }

     .about-image img {
         width: 100%;
         border-radius: 5px;
         box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
     }

     .about-image::before {
         content: '';
         position: absolute;
         width: calc(100% - 40px);
         height: calc(100% - 40px);
         border: 5px solid var(--primary);
         top: 20px;
         left: 20px;
         z-index: -1;
         border-radius: 5px;
     }

     .about-features {
         display: flex;
         flex-wrap: wrap;
         margin-top: 40px;
     }

     .about-feature {
         width: 50%;
         margin-bottom: 30px;
         padding-right: 20px;
     }

     .about-feature-title {
         display: flex;
         align-items: center;
         margin-bottom: 15px;
     }

     .about-feature-icon {
         width: 40px;
         height: 40px;
         background-color: var(--primary-light);
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin-right: 15px;
     }

     .about-feature-icon i {
         font-size: 18px;
         color: var(--primary);
     }

     .about-feature-text {
         font-size: 18px;
         font-weight: 600;
         margin: 0;
     }

     .about-feature-desc {
         color: var(--gray);
         padding-left: 55px;
     }

     /* Team Section */
     .team {
         padding: 120px 0;
         background-color: var(--light);
         position: relative;
         overflow: hidden;
     }

     .team::after {
         content: '';
         position: absolute;
         width: 600px;
         height: 600px;
         background-color: var(--primary-light);
         opacity: 0.3;
         border-radius: 50%;
         bottom: -300px;
         right: -300px;
         z-index: 0;
     }

     .team-card {
         position: relative;
         margin-bottom: 30px;
         z-index: 1;
     }

     .team-image {
         position: relative;
         overflow: hidden;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
     }

     .team-image img {
         width: 100%;
         transition: all 0.5s ease;
     }

     .team-card:hover .team-image img {
         transform: scale(1.1);
     }

     .team-social {
         position: absolute;
         top: 20px;
         right: 20px;
         display: flex;
         flex-direction: column;
         opacity: 0;
         transform: translateX(20px);
         transition: all 0.3s ease;
     }

     .team-card:hover .team-social {
         opacity: 1;
         transform: translateX(0);
     }

     .team-social a {
         width: 40px;
         height: 40px;
         background-color: var(--white);
         display: flex;
         align-items: center;
         justify-content: center;
         margin-bottom: 10px;
         border-radius: 50%;
         color: var(--secondary-dark);
         transition: all 0.3s ease;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
     }

     .team-social a:hover {
         background-color: var(--primary);
         color: var(--white);
     }

     .team-info {
         position: relative;
         background-color: var(--white);
         padding: 30px;
         margin: -50px 20px 0;
         text-align: center;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
         transition: all 0.3s ease;
     }

     .team-card:hover .team-info {
         transform: translateY(-10px);
     }

     .team-name {
         font-size: 22px;
         margin-bottom: 5px;
     }

     .team-position {
         color: var(--primary);
         font-size: 14px;
         text-transform: uppercase;
         letter-spacing: 1px;
         font-weight: 600;
         margin-bottom: 0;
     }

     .team-separator {
         width: 50px;
         height: 2px;
         background-color: var(--primary);
         margin: 15px auto;
     }

     /* Footer */
     .footer {
         background-color: var(--secondary-dark);
         color: var(--gray-light);
         position: relative;
     }

     .footer-top {
         padding: 80px 0 60px;
     }

     .footer-about h3,
     .footer-links h3,
     .footer-contact h3 {
         color: var(--white);
         font-size: 24px;
         margin-bottom: 25px;
         position: relative;
         padding-bottom: 15px;
     }

     .footer-about h3::after,
     .footer-links h3::after,
     .footer-contact h3::after {
         content: '';
         position: absolute;
         width: 50px;
         height: 2px;
         background-color: var(--primary);
         bottom: 0;
         left: 0;
     }

     .footer-about p {
         margin-bottom: 20px;
         line-height: 1.8;
     }

     .footer-links ul {
         list-style: none;
         padding: 0;
         margin: 0;
     }

     .footer-links li {
         margin-bottom: 12px;
     }

     .footer-links a {
         color: var(--gray-light);
         transition: all 0.3s ease;
         display: block;
         position: relative;
         padding-left: 20px;
     }

     .footer-links a::before {
         content: '\f105';
         font-family: 'Font Awesome 6 Free';
         font-weight: 900;
         position: absolute;
         left: 0;
         top: 2px;
         color: var(--primary);
     }

     .footer-links a:hover {
         color: var(--primary);
         padding-left: 25px;
     }

     .footer-contact p {
         margin-bottom: 20px;
         display: flex;
         align-items: flex-start;
     }

     .footer-contact p i {
         color: var(--primary);
         margin-right: 15px;
         margin-top: 5px;
     }

     .footer-social {
         display: flex;
         gap: 15px;
         margin-top: 30px;
     }

     .footer-social a {
         width: 40px;
         height: 40px;
         background-color: rgba(255, 255, 255, 0.1);
         display: flex;
         align-items: center;
         justify-content: center;
         border-radius: 50%;
         color: var(--white);
         transition: all 0.3s ease;
     }

     .footer-social a:hover {
         background-color: var(--primary);
         transform: translateY(-5px);
     }

     .footer-bottom {
         padding: 25px 0;
         border-top: 1px solid rgba(255, 255, 255, 0.1);
         text-align: center;
     }

     .footer-bottom p {
         margin: 0;
         font-size: 14px;
     }

     .footer-bottom a {
         color: var(--primary);
     }

     .footer-menu {
         display: flex;
         justify-content: center;
         gap: 30px;
         margin-bottom: 20px;
     }

     .footer-menu a {
         color: var(--gray-light);
         font-size: 14px;
         transition: all 0.3s ease;
     }

     .footer-menu a:hover {
         color: var(--primary);
     }

     /* Back to Top */
     .back-to-top {
         position: fixed;
         right: 30px;
         bottom: 30px;
         width: 50px;
         height: 50px;
         background-color: var(--primary);
         color: var(--white);
         display: flex;
         align-items: center;
         justify-content: center;
         border-radius: 50%;
         font-size: 18px;
         z-index: 99;
         opacity: 0;
         visibility: hidden;
         transition: all 0.3s ease;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
     }

     .back-to-top.active {
         opacity: 1;
         visibility: visible;
     }

     .back-to-top:hover {
         background-color: var(--secondary-dark);
         color: var(--white);
         transform: translateY(-5px);
     }

     /* Responsive Styles */
     @media (max-width: 1199.98px) {
         .hero-title {
             font-size: 48px;
         }

         .section-title {
             font-size: 36px;
         }

         .about-feature {
             width: 100%;
         }
     }

     @media (max-width: 991.98px) {
         .hero {
             min-height: 600px;
         }

         .hero-title {
             font-size: 40px;
         }

         .header-contact {
             display: none;
         }

         .navbar-collapse {
             background-color: var(--secondary-dark);
             padding: 20px;
             margin-top: 20px;
         }
     }

     @media (max-width: 767.98px) {
         .hero {
             min-height: 500px;
         }

         .hero-title {
             font-size: 32px;
         }

         .hero-subtitle {
             font-size: 14px;
         }

         .hero-text {
             font-size: 16px;
         }

         .section-title {
             font-size: 30px;
         }

         .about::before,
         .team::after {
             display: none;
         }

         .footer-top {
             padding: 60px 0 30px;
         }

         .footer-about,
         .footer-links {
             margin-bottom: 40px;
         }
     }

     @media (max-width: 575.98px) {
         .hero-buttons {
             flex-direction: column;
             gap: 15px;
         }

         .footer-menu {
             flex-wrap: wrap;
             gap: 15px;
         }
     }
 </style>