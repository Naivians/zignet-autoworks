<?php
include "includes/config.php";
include "functions.php";

if (isset($_POST['getBtn'])) {


    $res = getData("admins");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Admin Name</th>
            <th>Role</th>
            <th>Username</th>
            <th>Password</th>
            <th>Date Added</th>
            <th>Date Modified</th>
            <th>Date Retrieved</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td>' . $row['adminName'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>' . $row['retrievedDate'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <!-- view -->
                            <button class="btn" onclick="viewAdminAccount(' . $row['id'] . ')" >
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button>

                            <!-- edit -->   
                            <button class="btn" onclick="viewEditAccount(' . $row['id'] . ')">
                                <img src="icons/edit.svg" alt="view image" class="text-primary">
                            </button>

                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['id'] . ')">
                                <img src="icons/delete.svg" alt="view image" class="text-danger">
                            </button>

                        </td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}


if (isset($_POST['viewBtn'])) {
    $id = $conn->escape_string($_POST['id']);

    $res = getById("admins", $id);
    $response = array();

    while ($row = $res->fetch_assoc()) {
        $response = $row;
    }

    echo json_encode($response);
}

if (isset($_POST['viewEditBtn'])) {
    $id = $conn->escape_string($_POST['id']);
    $res = getById("admins", $id);
    $response = array();

    while ($row = $res->fetch_assoc()) {
        $response = $row;
    }
    
    echo json_encode($response);
}
