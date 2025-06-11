<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['numberOfCases'], $_POST['caseYear'], $_POST['caseDescription'])) {
        $numberOfCases = $_POST['numberOfCases'];
        $caseYear = $_POST['caseYear'];
        $caseDescriptions = $_POST['caseDescription'];

        for ($i = 0; $i < count($numberOfCases); $i++) {
            $cases = $numberOfCases[$i];
            $yearOfCase = $caseYear[$i];
            $description = $conn->real_escape_string($caseDescriptions[$i]); 

            // Get latest CV ID
            $sql1 = "SELECT * FROM cv ORDER BY id DESC LIMIT 1";
            $res1 = $conn->query($sql1);
            $row1 = $res1->fetch_assoc();
            $cvid = $row1['id'];

            $sql = "INSERT INTO casewon (nbofcases, year, description, cvid) 
                    VALUES ('$cases', '$yearOfCase', '$description', '$cvid')";
            $conn->query($sql);
        }

        header("Location: techskills.php");
        exit();
    }
}
?>
