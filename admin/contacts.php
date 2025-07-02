<?php 
include '../db.php';
include 'header.php';
?>
    <div class="content">
        <h1>Contact Page</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>sami</td>
                    <td>sami@gmail</td>
                    <td>Hello, I am sami</td>
                    <td>
                        <button>Accept</button>
                        <button class="reject-btn">Reject</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

<div class="popup-overlay" onclick="closePopup()"></div>

<div id="addPopup" class="popup">
    <div class="popup-header">Add New Item</div>
    <label for="newItemName">Item Name:</label>
    <input type="text" id="newItemName">
    <button>Add</button>
    <button onclick="closePopup()">Close</button>
</div>

<div id="updatePopup" class="popup">
    <div class="popup-header">Update Item</div>
    <label for="updateItemName">New Name:</label>
    <input type="text" id="updateItemName">
    <button>Update</button>
    <button onclick="closePopup()">Close</button>
</div>

<div id="deletePopup" class="popup">
    <div class="popup-header">Delete Item</div>
    <p>Are you sure you want to delete this category?</p>
    <button>Yes</button>
    <button onclick="closePopup()">No</button>
</div>

</body>
</html>