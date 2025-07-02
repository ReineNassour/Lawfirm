<?php
include 'db.php';

    error_reporting(0);

         $msg = "";

  if (isset($_POST['enter'])) {
	
	$caseid = $_POST['caseid'];
    $attid = $_POST['attid'];
    $userid = $_POST['userid'];
	
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./img/" . $filename;

	

	// Get all the submitted data from the form
	$sql = "INSERT INTO documents(userdoc,attdoc,time,caseid,userid,attid) 
    VALUES ('$folder',' ',NOW(),'$caseid', '$userid' , '$attid')";

	// Execute query
	mysqli_query($conn, $sql);

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		header("Location: documents.php?id=" . urlencode($caseid));
                            exit;

	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
}  

?>