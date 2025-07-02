<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id= $_POST['id'];
    $pays = $_POST['pay'];
    $dates = $_POST['date'];

    // Ensure the arrays are the same length
    if (count($pays) == count($dates)) {
        // Loop through each payment and insert into the database
        foreach ($pays as $key => $pay) {
            $date = $dates[$key];
          
            $pay = $conn->real_escape_string($pay);
            $date = $conn->real_escape_string($date);

            $sql = "INSERT INTO payments (date, status, amount, ccontractid)
                    VALUES ('$date', 'UnPaid', '$pay','$id')";
            $conn->query($sql);
        }

        header("Location: paycontract.php?id=" . urlencode($id));
        exit;
        
    } else {
        echo "Error: Payment and Date fields mismatch.";
    }
}

?>