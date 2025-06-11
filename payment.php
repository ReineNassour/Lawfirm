<?php
session_start();
include 'checkStatus.php';
include 'header.php';
if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>TheFirm | Our Attorneys</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="Law Firm, Legal Services, Attorneys, Legal Team" />
    <meta name="description" content="Meet our expert team of attorneys specializing in various legal practices" />
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Google Font & libs -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/attorneystyle.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/payment.css" rel="stylesheet">
    <link href="./css/apply.css" rel="stylesheet">

    <style>
        .page-header{height:200px;display:flex;align-items:center;justify-content:center;padding:20px 0}
        #canvas{border:2px solid #000;background:#fff;touch-action:none}
        #signature-pad{margin-top:20px;text-align:center}
    </style>
</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header"><div class="container"></div></div>
    <!-- Page Header End -->

<?php
$id = $_GET['id'];
$sql1 = "SELECT * FROM `ccontract` WHERE caseid='$id'";
$res1 = $conn->query($sql1);

if ($res1->num_rows == 0) { ?>
    <div class="row"><div class="col-12">
        <div class="application-message text-center">
            <i class="fas fa-hourglass-half"></i>
            <h1>This Case Has No Case Contract Yet To See The Payment Contract, Please Wait.</h1>
            <p class="mb-4">You have already submitted a Case and your attorney is currently preparing the contract.</p>
            <a href="track.php" class="btn btn-primary">Back</a>
        </div>
    </div></div>
    <br><br><br>
<?php  include 'footer.php';
 exit;
 }

$row1 = $res1->fetch_assoc(); 
$caseid=$row1['caseid']; 
$contractid=$row1['id'];
$img=$row1['paycontractimg'];

$sql3 = "SELECT * FROM `case` WHERE id='$caseid'";  
$row3 = $conn->query($sql3)->fetch_assoc();
$userid=$row3['userid'];
 $catid=$row3['categoryid'];
 $desc=$row3['description'];
 $attid=$row3['attid'];

$sql5 = "SELECT * FROM `category` WHERE id='$catid'";
 $catname = $conn->query($sql5)->fetch_assoc()['name'];

$sql4 = "SELECT * FROM `user` WHERE id='$userid'"; 
   $row4 = $conn->query($sql4)->fetch_assoc();
$fname=$row4['fname'];
 $lname=$row4['lname'];
$username= $fname . ' ' . $lname;

$sql9 = "SELECT * FROM `payments` WHERE ccontractid='$contractid'";
$res9 = $conn->query($sql9);

if ($res9->num_rows == 0){ ?>
   <div class="row"><div class="col-12">
        <div class="application-message text-center">
            <i class="fas fa-hourglass-half"></i>
            <h1>Your Payment Contract Is Being Prepared By Your Attorney, Please Wait.</h1>
        </div>
    </div></div><br>
<?php } else { 
    if($img ==0){
    ?>

    <div class="steps-box" style="text-align: center;">
   <h1>Steps to Complete the Payment Contract:</h1>
       1- Sign the contract.<br>
       2- Capture a photo of the signed contract.<br>
       3- Send the Payment contract to your attorney.<br>
   
</div>

 <?php
 $sql5 = "SELECT * FROM `user` WHERE id='$attid'"; 
   $row5 = $conn->query($sql5)->fetch_assoc();
   $attid = $row5['id'];
$fname=$row5['fname'];
 $lname=$row5['lname'];
 $attname= $fname . ' ' . $lname;

 $sql8 = "SELECT * FROM `attcontract` WHERE attid='$attid'"; 
   $row8 = $conn->query($sql8)->fetch_assoc();
   $percent = $row8['salary'];

   $amount = $row1['total'];
   $date = date('Y-m-d');
$result = ($percent / 100) * $amount;
 ?>
<div class="container payment-container ">
  <div id="capture-area"
       style="max-width:800px;margin:auto;background:#fff;padding:30px;border-radius:12px;
              font-family:'Arial',sans-serif;direction:rtl;text-align:right;
              box-shadow:0 0 15px rgba(0,0,0,0.1); border:1px solid #e0e0e0;">

    <h2 style="text-align:center;color:#2c3e50;margin-bottom:25px;">عقد أتعاب محاماة</h2>

    <p><strong>بين:</strong><br>
      <strong>المحامي:</strong> <?= $attname; ?> <br>
      <strong>الموكل:</strong> <?= $username; ?>
    </p>

    <p><strong>١. الموضوع:</strong><br>
      توكيل المحامي لمتابعة قضية تتعلق بـ <?= $desc; ?> وتمثيل الموكل أمام الجهات القضائية والرسمية.
    </p>

    <p><strong>٢. الأتعاب:</strong><br>
      تُحدد الأتعاب بمبلغ <strong>[<?= $result; ?>]</strong> ل.ل / دولار، تُدفع حسب الاتفاق ولا تشمل المصاريف القضائية.
    </p>

    <p><strong>٣. النفقات:</strong><br>
      يتحمّل الموكل كافة النفقات الإدارية والقضائية.
    </p>

    <p><strong>٤. مدة التوكيل:</strong><br>
      يبدأ العقد من تاريخ توقيعه وينتهي بانتهاء المهمة القانونية أو بإنهاء التوكيل.
    </p>

    <p><strong>٥. فسخ العقد:</strong><br>
      لأي طرف الحق بفسخ العقد بعد دفع المستحقات عن الأعمال المنجزة حتى تاريخ الفسخ.
    </p>

    <p><strong>٦. القانون المُطبق:</strong><br>
      يخضع هذا العقد لأحكام القوانين اللبنانية وأي نزاع يُحال إلى نقابة المحامين في <strong>[بيروت / طرابلس]</strong>.
    </p>

    <p><strong>التوقيع:</strong><br><?= $username; ?></p>

    <!-- Signature canvas -->
    <div class="my-4 text-center">
      <label class="d-block mb-2 font-weight-bold">التوقيع:</label>
      <canvas id="signature-pad" width="600" height="150"
              style="border:1px solid #ccc; max-width:100%; height:150px;"></canvas>
    </div>

    <!-- Action buttons -->
    <div class="text-center mt-3">
      <button type="button" class="btn btn-danger no-capture" id="btnClear">Clear Signature</button>
      <button type="button" class="btn btn-primary no-capture" id="btnExportPng">Capture As A Photo</button>
      <p class="mt-2">تاريخ: <?= $date; ?></p>
    </div>
  </div>
</div>

<!-- Upload box -->
<div class="card shadow-sm mt-5 no-print">
  <div class="card-header bg-white">
     <h5 class="mb-0"><i class="fas fa-upload mr-2 text-primary"></i>Upload &amp; Send Contract</h5>
  </div>
  <div class="card-body">
     <form action="Paymentimg.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label class="mb-2"><i class="fas fa-file-upload mr-1"></i>اختر ملف العقد:</label>
          <input type="file" name="uploadfile" class="form-control" required>
        </div>
        <input type="hidden" name="caseid" value="<?= $caseid; ?>">
        <input type="hidden" name="signature_image" id="signature-image">
        <button type="submit" name="enter" class="btn btn-primary mt-3">
           <i class="fas fa-paper-plane mr-1"></i> Send Documents
        </button>
      </form>
  </div>
</div>
<?php
 } else {
    ?>
<div style="text-align: center;">
            <img src="./<?= $img ; ?>" width="60%" height="80%" alt="Contract Image" />
        </div>
<br><br>
       
    <?php
 }
 ?>


 <?php
 } ?>
<!-- Back button -->
<div class="text-center my-4">
  <a href="track.php?id=<?= $caseid; ?>" class="btn btn-black btn-action">
     <i class="fas fa-file-contract mr-1"></i> Back
  </a>
</div>

<!-- html2canvas -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
/* ======== Signature Pad ======== */
const canvas = document.getElementById('signature-pad');
const ctx = canvas.getContext('2d');
canvas.width = canvas.offsetWidth;
canvas.height = canvas.offsetHeight;
ctx.strokeStyle='#000'; ctx.lineWidth=2; ctx.lineCap='round';
let drawing=false;
canvas.addEventListener('mousedown',e=>{drawing=true;ctx.beginPath();ctx.moveTo(e.offsetX,e.offsetY);});
canvas.addEventListener('mousemove',e=>{if(!drawing)return;ctx.lineTo(e.offsetX,e.offsetY);ctx.stroke();});
['mouseup','mouseleave'].forEach(evt=>canvas.addEventListener(evt,()=>{drawing=false;ctx.closePath();}));
document.getElementById('btnClear').addEventListener('click',()=>ctx.clearRect(0,0,canvas.width,canvas.height));

/* ======== Capture PNG ======== */
document.getElementById('btnExportPng').addEventListener('click',()=>{
   const hide = [
     document.querySelector('header'),
     document.querySelector('footer'),
     ...document.querySelectorAll('.no-print, .no-capture'),
   ];
   hide.forEach(el=>el&& (el.style.display='none'));

   const captureArea=document.getElementById('capture-area');
   html2canvas(captureArea,{scale:2,useCORS:true}).then(cv=>{
       const link=document.createElement('a');
       link.href=cv.toDataURL('image/png');
       link.download='case-contract.png';
       link.click();
       hide.forEach(el=>el&&(el.style.display=''));
   });
});

/* ======== Save signature with form ======== */
document.querySelector('form')?.addEventListener('submit',()=>{
   document.getElementById('signature-image').value = canvas.toDataURL('image/png');
});
</script>
</body>
</html>
