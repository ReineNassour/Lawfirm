<?php 
include '../db.php';
include 'header.php';
?>
    <div class="content">
        <h1>Manage Attorneys</h1>
        <button onclick="togglePopup('addPopup')">Add New Attorney</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Attorney 1</td>
                    <td>
                        <button onclick="togglePopup('updatePopup')">Update</button>
                        <button onclick="togglePopup('deletePopup')" class="reject-btn">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

<div class="popup-overlay" onclick="closePopup()"></div>

<div id="addPopup" class="popup">
    <div class="popup-header">Add New Category</div>
    <label for="newCategoryName">Category Name:</label>
    <input type="text" id="newCategoryName">
    <button>Add</button>
    <button onclick="closePopup()">Close</button>
</div>

<div id="updatePopup" class="popup">
    <div class="popup-header">Update Category</div>
    <label for="updateCategoryName">New Name:</label>
    <input type="text" id="updateCategoryName">
    <button>Update</button>
    <button onclick="closePopup()">Close</button>
</div>

<div id="deletePopup" class="popup">
    <div class="popup-header">Delete Category</div>
    <p>Are you sure you want to delete this category?</p>
    <button>Yes</button>
    <button onclick="closePopup()">No</button>
</div>

</body>
</html>