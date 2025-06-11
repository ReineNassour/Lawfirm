<?php
session_start();
include 'checkStatus.php';
include 'db.php';

if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Case Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Book Case" name="keywords">
    <meta content="Book a consultation with our expert attorneys" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>


    <!-- Animation -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Carousel -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="css/book.css" rel="stylesheet">
    <link href="css/apply.css" rel="stylesheet">


<style>
     .page-header {
    height: 200px;
    display: flex;
    align-items: center; 
    justify-content: center;
   
    padding: 20px 0;
}

      #canvas {
  border: 2px solid #000;
  background-color: #fff;
  touch-action: none; /* Prevent scrolling on touch devices while drawing */
}

#signature-pad {
  text-align: center;
  margin-top: 20px;
}

    /* This will make sure it's visible */
.no-print {
    display: block !important;
}


     .steps-box {
        background-color: #fff8e1;
        border-left: 6px solid #ffc107;
        border-radius: 8px;
        padding: 15px 20px;
        margin-top: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #5d4037;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        
    }

    
</style>

</head>

<body>
    <!-- Header included here -->
    <?php include 'header.php'; ?>

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                
               
            </div>
        </div>
    </div>
    <!-- Page Header End -->


<?php

$caseid=$_GET['id'];

$sql3 = "SELECT * FROM `ccontract` where caseid='$caseid'";
    $res3 = $conn->query($sql3);
    if ($res3->num_rows == 0) {
       
        ?>
        <div class="row">
                        <div class="col-12">
                            <div class="application-message">
                                <i class="fas fa-hourglass-half"></i>
                                <h1>This Case Has No Case Contract Yet, Please Wait.</h1>
                                <p class="mb-4">You have already submitted a Case and Your Attorney is currently Preparing The Contract. Please be patient as we process It.</p>
                                <a href="track.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
        <br><br><br>
        <?php
        include 'footer.php';
        exit;
    } else{
    $row3 = $res3->fetch_assoc();
$status=$row3['status'];
$contractid=$row3['id'];
if ($status == 'Accepted') {

    $sql = "SELECT * FROM `case` where id='$caseid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $userid = $row['userid'];
    $attid=$row['attid'];
    $img=$row['caseContractimg'];

    $sql2 = "SELECT * FROM user where id='$attid'";
    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_assoc();
    $address = $row2['address'];
    $attname = $row2['fname'] . " " . $row2['lname'];

    $sql1 = "SELECT * FROM `user` where id='$userid'";
    $res1 = $conn->query($sql1);
    $row1 = $res1->fetch_assoc();
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    $email = $row1['email'];

    $sql5 = "SELECT * FROM `payments` where ccontractid='$contractid'";
    $res5 = $conn->query($sql5);
    if ($res5->num_rows > 0) {
?>

   

        <div class="wrapper">
            <!-- Main Content Start -->
            <div class="container dashboard-container">
              

                <?php
if($img == 0) {
                ?>
<div id="capture-only">
    <!-- This is where your contract content goes -->
    <div class="contract-card">
        <form method="post" dir="rtl">
<div id="capture-area">
    <div id="contract-only">

<div class="steps-box" style="text-align: center;">
   <h1>Steps to Complete the Case Contract:</h1>
       1- Sign the contract.<br>
       2- Capture a photo of the signed contract.<br>
       3- Send the Case contract to your attorney.<br>
   
</div>


                <div class="contract-card">
                    <form method="post" dir="rtl">
                        <p>
                            <strong style="font-size: 20px;">وكالة قانونية</strong>
                            <br><br>
                            أنا الموقع أدناه:
                            <br>
                        <div class="form-group">
                            <label>:الاسم</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($row1['fname'] . " " . $row1['lname']); ?>" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label>:رقم الهوية</label>
                            <input type="text" name="id_number" value="" placeholder="[رقم الهوية]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>:العنوان</label>
                            <input type="text" name="address" value="<?= htmlspecialchars($row1['address']); ?>" readonly class="form-control">
                        </div>
                        <br>
                        أوكل بموجب هذه الوثيقة:
                        <br>
                        <div class="form-group">
                            <label>:أستاذ/أستاذة</label>
                            <input type="text" name="attorney_name" value="<?= htmlspecialchars($attname); ?>" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label>:العنوان</label>
                            <input type="text" name="attorney_address" placeholder="<?= htmlspecialchars($address); ?>" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label>:رقم الهاتف</label>
                            <input type="text" name="attorney_phone" placeholder="<?= htmlspecialchars($row2['phonenum']); ?>" class="form-control">
                        </div>
                        <br>
                        لتمثيلي في الأمور التالية:
                        <ul class="contract-list">
                            <li>تقديم الدعاوى أو الدفاع عنها أمام المحاكم المختصة.</li>
                            <li>التوقيع على جميع المستندات القانونية المتعلقة بالقضية/القضايا.</li>
                            <li>التفاوض في تسوية القضايا أو الاتفاقيات.</li>
                            <li>التوقيع على عقود واتفاقيات باسم الموكل.</li>
                        </ul>
                        <div class="form-group">
                            <label>:المدة</label>
                            <input type="text" name="duration" value="" placeholder="[حدد المدة]" class="form-control">
                        </div>
                        <br>
                        الشروط: لا يوجد شروط إضافية أو قيود على نطاق التفويض، ويمكن للمحامي اتخاذ جميع الإجراءات القانونية اللازمة بناءً على تقديره.
                        <br><br>
                        <!-- 1️⃣  Signature Area  -->
<div class="form-group mt-3">
    <label>:التوقيع</label><br>

    <!-- Canvas where the user draws -->
    <canvas id="signature-pad"
            width="600" height="150"
            style="border:1px solid #ccc; width:40%; height:150px;"></canvas>

    <!-- Buttons -->
    <!-- Buttons (excluded from screenshot) -->
<div class="mt-3">
    <input type="hidden" name="signature_image" id="signature-image">

    <button type="button" class="btn btn-danger no-capture" id="btnClear">Clear Signature</button>
    <button type="button" class="btn btn-primary no-capture" id="btnExportPng">Capture as a Photo</button>


</div>

  </form>
    </div>
</div>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <!-- (optional) hidden field if you also want to POST the signature -->
    <input type="hidden" name="signature_image" id="signature-image">
</div> </div> 

<!-- 2️⃣  html2canvas (for PNG download) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                       
                        <br><br>
                        <div class="form-group">
                            <label>:الاسم</label>
                            <input type="text" name="sign_name" value="<?= htmlspecialchars($row1['fname'] . " " . $row1['lname']); ?>" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label>:التاريخ</label>
                            <input type="text" name="sign_date" value="<?= htmlspecialchars($row['startdate']); ?>" readonly class="form-control">
                        </div>
                        </p>
                        
                    </form>
                </div>
</div>
<br><br>
 <div class="card shadow-sm mt-5 no-print">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-upload mr-2 text-primary"></i>Upload &amp; Send Contract
            </h5>
        </div>
        <div class="card-body">
            <form action="updatecontract.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="mb-2"><i class="fas fa-file-upload mr-1"></i>اختر ملف العقد:</label>
                    <input type="file" name="uploadfile" class="form-control" required>
                </div>
                <input type="hidden" name="caseid" value="<?= $caseid ; ?>">
                <button type="submit" name="enter" class="btn btn-primary mt-3">
                    <i class="fas fa-paper-plane mr-1"></i> Send Documents
                </button>
            </form>
        </div>
    </div>

  <?php
   }
  else {
?>


 <div style="text-align: center;">
            <img src="./<?= $img ; ?>" width="80%" height="80%" alt="Contract Image" />
        </div>
<br><br>
        <div style="text-align: center;">
            <a href="track.php" class="btn btn-primary">Back</a>
        </div>

<?php
 
}
} else {
    ?>
                    <div class="row">
    <div class="col-12">
        <div class="application-message">
            <i class="fas fa-hourglass-half"></i>
            <h1>Your Case Contract Will Be Ready for Signing Soon</h1>
            <p class="mb-4">You will soon be able to sign your Case Contract along with your Payment Contract. Please note that your attorney is preparing Your Payment Contract. Kindly wait while we finalize the documents.</p>
            <a href="track.php" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>

    <?php
}
 }  
  else {
        ?>
                     <div class="row">
                        <div class="col-12">
                            <div class="application-message">
                                <i class="fas fa-hourglass-half"></i>
                                <h1>Your Case Contract Is Not Accepted Yet, Please Wait.</h1>
                                <p class="mb-4">Your Case Contract has Not Been Accepted yet. Your Attorney is Currently Working On it. Please wait while we complete the process.</p>
                                <a href="track.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>

       <?php
  }
}
    ?>
    
            <!-- Main Content End -->
<br><br><br>
           <?php
            include 'footer.php';
           ?>
            <!-- Footer End -->
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>

        <!-- Template Javascript -->
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>


<script>
    // Signature drawing setup
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';

    let drawing = false;

    canvas.addEventListener('mousedown', e => {
        drawing = true;
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener('mousemove', e => {
        if (!drawing) return;
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
    });

    ['mouseup', 'mouseleave'].forEach(evt => {
        canvas.addEventListener(evt, () => {
            drawing = false;
            ctx.closePath();
        });
    });

    // ✅ Clear Signature Button
    document.getElementById('btnClear').addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    // Export PNG (html2canvas)
    document.getElementById('btnExportPng').addEventListener('click', () => {
        const elementsToHide = [
            document.querySelector('header'),
            document.querySelector('footer'),
            document.querySelector('.no-print'),
            document.getElementById('btnClear'),
            document.getElementById('btnExportPng'),
            document.getElementById('translateButton'),
            document.getElementById('language-toggle')
        ];

        elementsToHide.forEach(el => {
            if (el) el.style.display = 'none';
        });

        const stepsBox = document.querySelector('.steps-box');
        if (stepsBox) stepsBox.style.display = 'block';

        const captureArea = document.getElementById('capture-only');

        html2canvas(captureArea, {
            scale: 2,
            useCORS: true
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.href = imgData;
            link.download = 'case-contract.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Restore hidden elements
            elementsToHide.forEach(el => {
                if (el) el.style.display = '';
            });
        });
    });

    // Save signature to hidden input when form is submitted
    document.querySelector('form')?.addEventListener('submit', () => {
        document.getElementById('signature-image').value = canvas.toDataURL('image/png');
    });
</script>


    </body>
    </html>
