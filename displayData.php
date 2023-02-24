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


if (isset($_POST['filterBtn'])) {

    $columnName = $_POST['columnName'];

    $res = sortBy("admins", $columnName);

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

// searchBtn

if (isset($_POST['action'])) {

    $table = $conn->escape_string($_POST['table']);
    $searchItem = $conn->escape_string($_POST['search']);
    $searchBtn = $conn->escape_string($_POST['btn']);

    if ($searchBtn == "loginSearch") {
        $res = liveSearch($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>Admin Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Login Date</th>
                                <th>Logout Date</th>
                            </tr>
                        </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td>' . $row['adminID'] . '</td>
                        <td>' . $row['adminName'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $row['login'] . '</td>
                        <td>' . $row['logout'] . '</td>
                    </tr>';
            }
            $table .= "</table>";

            echo $table;
        } else {
            echo "<h6 class='text-danger'>No data found</h6>";
        }
    }

    if ($searchBtn == "adminSearch") {
        $res = liveSearch($table, $searchItem);

        if ($res->num_rows > 0) {
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
        } else {
            echo "<h6 class='text-danger'>No data found</h6>";
        }
    }


    // deleted admin search
    if ($searchBtn == "deletedSearch") {
        $res = liveSearch($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Admin ID</th>
            <th>Admin Name</th>
            <th>Role</th>
            <th>Username</th>
            <th>Password</th>
            <th>Date Added</th>
            <th>Date Modified</th>
            <th>Actions</th>
        </tr>
    </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td>' . $row['adminID'] . '</td>
                        <td>' . $row['adminName'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <button class="btn" onclick="retrieved(' . $row['adminID'] . ')" data-toggle="tooltip" data-placement="bottom" title="Retrieved Button">
                            <i class="bx bxs-download text-success"></i>
                            </button>

                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['adminID'] . ')">
                                <img src="icons/delete.svg" alt="view image" class="text-danger">
                            </button>

                        </td>
                    </tr>';
            }
            $table .= "</table>";

            echo $table;
        } else {
            echo "<h6 class='text-danger'>No data found</h6>";
        }
    }
}

// ARCHIVES
if (isset($_POST['loginHistoryBtn'])) {

    $res = getData("login_history");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Admin ID</th>
            <th>Admin Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Login Date</th>
            <th>Logout Date</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td>' . $row['adminID'] . '</td>
                        <td>' . $row['adminName'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $row['login'] . '</td>
                        <td>' . $row['logout'] . '</td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}


if (isset($_POST['deletedAdmin'])) {
    $res = getData("deleted_admin_account");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Admin ID</th>
            <th>Admin Name</th>
            <th>Role</th>
            <th>Username</th>
            <th>Password</th>
            <th>Date Added</th>
            <th>Date Modified</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td>' . $row['adminID'] . '</td>
                        <td>' . $row['adminName'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <button class="btn" onclick="retrieved(' . $row['adminID'] . ')" data-toggle="tooltip" data-placement="bottom" title="Retrieved Button">
                            <i class="bx bxs-download text-success"></i>
                            </button>
                            
                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['adminID'] . ')">
                                <img src="icons/delete.svg" alt="view image" class="text-danger">
                            </button>

                        </td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}
?>
