<?php
session_start();
include 'header.php'; 
include 'db.php';
if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
$userid=$_SESSION['user']['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Practice Areas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Practice Areas" name="keywords">
    <meta content="Explore our comprehensive legal practice areas and specializations" name="description">

   <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Carousel -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="css/practice.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    .alert-info {
    background-color: #f0f8ff; /* A lighter background color */
    color: #000; /* Dark text color */
}

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
     
    }

    .gallery-title {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 30px;
      color: #333;
    }

    .gallery-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 0 20px;
    }

    .gallery-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .gallery-img:hover {
      transform: scale(1.05);
    }

    /* Modal image */
    .modal-img {
      width: 100%;
    }

    .custom-alert {
  display: inline-block;
  background-color: #eef4fa;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  border: 1px solid #cfe2ff;
  max-width: 400px;
  margin: auto;
  animation: fadeIn 0.4s ease-in-out;
}

.custom-alert i {
  color: #0d6efd;
}

@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}

  </style>

</head>

<body>

   <div class="page-header">
        <div class="container">
            <div class="row">
          
            
                <div class="col-12">
                    <h2>Here you can access all your legal documents</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="track.php">Track Case</a>
                        <a href="documents.php">Documents</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<h2 class="gallery-title">Attorneys Documents</h2>

<?php
$caseid=$_GET['id'];
$sql="SELECT * FROM `documents` Where caseid='$caseid'";
$res=$conn->query($sql);
if ($res->num_rows > 0) {
?>

  <div class="gallery-container">
    <?php
while($row=$res->fetch_assoc()){
    $doc=$row['attdoc'];
    $attid=$row['attid'];
    ?>
   <img src="<?= $doc ?>" 
     class="gallery-img" 
     data-bs-toggle="modal" 
     data-bs-target="#imageModal" 
     data-img-src="<?= $doc ?>">
 <?php
}
?>
</div>

  <!-- Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-transparent border-0">
        <img src="<?= $doc ?>" class="modal-img rounded shadow" id="modalImage">
      </div>
    </div>
  </div>
<?php
} else {
    ?>

<div class="text-center mt-5">
  <div class="custom-alert">
    <i class="fas fa-folder-open fa-2x mb-2 text-primary"></i>
    <h5>No Documents Found</h5>
    <p class="text-muted mb-0">There are currently no documents uploaded for this case.</p>
  </div>
</div>


<?php
}
?>

   <div class="card shadow-sm mt-5 no-print">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-upload mr-2 text-primary"></i>Upload &amp; Send Contract
            </h5>
        </div>
        <div class="card-body">
            <form action="SendDocuments.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="mb-2"><i class="fas fa-file-upload mr-1"></i>اختر ملف العقد:</label>
                    <input type="file" name="uploadfile" class="form-control" required>
                </div>
                <input type="hidden" name="caseid" value="<?= $caseid ; ?>">
                <input type="hidden" name="userid" value="<?= $userid ; ?>">
                <input type="hidden" name="attid" value="<?= $attid ; ?>">
                <button type="submit" name="enter" class="btn btn-primary mt-3">
                    <i class="fas fa-paper-plane mr-1"></i> Send Documents
                </button>
            </form>
        </div>
    </div>

  <!-- JavaScript to handle modal image -->
  <script>
    const galleryImages = document.querySelectorAll('.gallery-img');
    const modalImage = document.getElementById('modalImage');

    galleryImages.forEach(img => {
      img.addEventListener('click', () => {
        const src = img.getAttribute('data-img-src');
        modalImage.src = src;
      });
    });
  </script>

</body>
</html>