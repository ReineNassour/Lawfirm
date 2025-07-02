<?php
ob_start();
session_start();

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}

include 'header.php';
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Accepted Cases</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/admincss.css" rel="stylesheet">

    <style>
        .location-container {
    max-width: 900px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 8px;
         box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

.map-container {
    margin-bottom: 30px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.location-form {
    padding: 20px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    font-weight: 500;
    color: #333;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 0.75rem;
    font-size: 0.95rem;
    transition: border-color 0.2s ease-in-out;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.form-row {
    display: flex;
    margin-right: -10px;
    margin-left: -10px;
    flex-wrap: wrap;
}

.form-col {
    flex: 0 0 50%;
    padding: 0 10px;
}

.btn-group {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    border-radius: 5px;
    transition: all 0.2s;
}



.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2e59d9;
}
    </style>


</head>

<body>
    <div class="container py-5">

        <div id="map" style="height: 300px; width: 100%;"></div>
        <br><br>

        <?php
        $id = $_GET['pid'];

        $sql = "SELECT * FROM `case` WHERE id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $caseid = $row['id'];
        $userid = $row['userid'];

        $sql1 = "SELECT * FROM user WHERE id='$userid'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        ?>

        <br><br>

                       <form method="post" action="address.php" class="location-form">
                <input type="hidden" name="caseid" value="<?= $caseid; ?>">
                <input type="hidden" name="userid" value="<?= $row1['id']; ?>">

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>To:</label>
                            <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row1['fname'] . " " . $row1['lname']) ?>" readonly />
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="<?= htmlspecialchars($row1['email']) ?>" readonly />
                        </div>
                    </div>
                </div>

                             <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>X (Latitude):</label>
                            <input type="text" id="latitude" name="x" class="form-control" placeholder="Latitude">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Y (Longitude):</label>
                            <input type="text" id="longitude" name="y" class="form-control" placeholder="Longitude">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>City:</label>
                            <input type="text" name="city" class="form-control" placeholder="City...">
                        </div>
                    </div>
                              <div class="form-col">
                        <div class="form-group">
                            <label>Building:</label>
                            <input type="text" name="building" class="form-control" placeholder="Building...">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Street:</label>
                    <input type="text" name="street" class="form-control" placeholder="Street...">
                </div>

                <div class="form-group">
                    <label>Address Details:</label>
                    <textarea class="form-control" name="Adetails" placeholder="Enter address details..." required rows="3"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Session Date:</label>
                            <input type="date" name="date" class="form-control">
                        </div>
             </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Session Time:</label>
                            <input type="time" name="time" class="form-control">
                        </div>
                    </div>
                </div>
               <?php if (isset($_GET['error'])): ?>
    <script>
        alert("<?php echo addslashes($_GET['error']); ?>");
    </script>
<?php endif; ?>




                <div class="form-group">
                    <label>Session Details:</label>
                    <input type="text" name="Sdetails" class="form-control" placeholder="Details about the session">
                </div>

                <div class="form-group">
                    <label>Judge Full Name:</label>
                    <input type="text" name="judge" class="form-control" placeholder="Judge Full Name">
                </div>

                <div class="btn-group">
                    <a href="accepted.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>


  

    <?php  include '../footer.php'; ?>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMggPVt-5XVZ-R_LUNVCjscV7JjQfYeC0&callback=initMap" async defer></script>

    <script>
        function initMap() {
            let map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 37.7749,
                    lng: -122.4194
                }, // Default center (San Francisco)
                zoom: 10,
            });

            let marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map,
                draggable: true,
            });

            google.maps.event.addListener(map, "click", function(event) {
                let lat = event.latLng.lat();
                let lng = event.latLng.lng();
                marker.setPosition(event.latLng);
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
            });
        }
    </script>

</body>

</html>

<?php
ob_end_flush();
?>
