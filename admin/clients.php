<?php 
include '../db.php';
include 'header.php';
?>






    <div class="content">
        <h1>Manage clients</h1>
        <button id="copyEmailBtn">Copy Client Emails</button>

        <?php
        $sql="SELECT * FROM clients";
        $result=$conn->query($sql);
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>

            <?php
            $TOT=0;
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $TOT++;
                   ?>
<tr>
                    <td><?php echo $TOT; ?></td>
                    <td><?=$row['fname']." ".$row['lname'] ; ?></td>
                    <td><?=$row['email'];?></td>
                   
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<!-- The Modal -->
<div id="emailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User Emails</h2>
            <?php
            
            $sql3="SELECT email from clients";
            $res3=$conn->query($sql3);
                              ?>
            <textarea id="emailTextArea" rows="10" cols="50">
                <?php  
             while($row3=$res3->fetch_assoc()){
                echo $row3['email']; ?> <br>
                <?php 
                } ?>
                </textarea>
          
        </div>
     </div>

     <script>
    // Get the modal
    var modal = document.getElementById("emailModal");

    // Get the button that opens the modal
    var btn = document.getElementById("copyEmailBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
        copyEmails();
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Function to copy emails to clipboard
    function copyEmails() {
        var emailTextArea = document.getElementById("emailTextArea");
        emailTextArea.select();
        emailTextArea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(emailTextArea.value).then(function() {
            console.log("Emails copied to clipboard");
        }, function(err) {
            console.error("Could not copy emails: ", err);
        });
    }
</script> 