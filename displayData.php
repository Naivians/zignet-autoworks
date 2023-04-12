<?php
include "includes/config.php";
include "functions.php";

// view request

if (isset($_POST['view_request_btn'])) {
    $id = $conn->escape_string($_POST['id']);

    $res = getById("request_form", $id);

    $response = array();
    while ($row = $res->fetch_assoc()) {
        $response = $row;
    }

    echo json_encode($response);
}

// get request form
if (isset($_POST['get_user'])) {
    $res = getData("request_form");
    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Request ID</th>
            <th>Display Name</th>
            <th>company</th>
            <th>model</th>
            <th>cs_number</th>
            <th>schedule</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['request_id'] . '</td>
                        <td>' . $row['display_name'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['cs_number'] . '</td>
                        <td>' . $row['schedule'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <!-- view -->
                            <button class="btn" onclick="viewAdminAccount(' . $row['id'] . ')" >
                                <img src="icons/view.svg" alt="view image" class="text-success">
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

// deleted_user
if (isset($_POST['deleted_user'])) {
    $res = getData("deleted_user");

    $table = '<table class="adminAcc-table">
    <thead>
    <tr>
    <th>User ID</th>
    <th>Display Name</th>
    <th>Username</th>
    <th>Password</th>
    <th>Contact</th>
    <th>Date Added</th>
    <th>Date Modified</th>
    <th>Date Retrieved</th>
    <th>status</th>
    <th>Actions</th>
</tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['display_name'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['contact'] . '</td>
                        <td>' . $row['date_added'] . '</td>
                        <td>' . $row['date_modified'] . '</td>
                        <td>' . $row['date_retrieved'] . '</td>
                        <td>' . $row['active'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->
                            
                            <button class="btn" onclick="retrieved(' . $row['id'] . ')" data-toggle="tooltip" data-placement="bottom" title="Retrieved Button">
                            <i class="bx bxs-download text-success"></i>
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

// filter_transact

if (isset($_POST['filter_transact'])) {

    $columnName = $_POST['columnName'];

    $res = sortBy("transactions_history", $columnName);

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Reciept</th>
            <th>Client"s Name</th>
            <th>CS Number</th>
            <th>Company</th>
            <th>Payment Status</th>
            <th>Date Added</th>
            <th>Date Paid</th>
            <th>Date Retrieved</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td> <img src="uploads/' . $row['reciept'] . '" alt="reciept" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['paymentStatus'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['date_paid'] . '</td>
                        <td>' . $row['dateRetrieved'] . '</td>
                        <td>    
        
                            <!-- three btns for view, edit, and delete -->
                            <button class="btn" onclick="upload_reciept(' . $row['client_id'] . ')">
                                <i class="bx bxs-download text-success"></i>
                            </button>

                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')">
                                <img src="icons/view.svg" alt="view image" class="text-success">
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

    if ($searchBtn == "request_search") {
        $res = search_request($table, $searchItem);
        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Request ID</th>
                    <th>Display Name</th>
                    <th>company</th>
                    <th>model</th>
                    <th>cs_number</th>
                    <th>schedule</th>
                    <th>Actions</th>
                </tr>
            </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['request_id'] . '</td>
                        <td>' . $row['display_name'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['cs_number'] . '</td>
                        <td>' . $row['schedule'] . '</td>
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

    // request_search
    if ($searchBtn == "transact_search") {
        $res = seacrh_client($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
            <thead>
                <tr>
                    <th>Reciept</th>
                    <th>Client"s Name</th>
                    <th>CS Number</th>
                    <th>Company</th>
                    <th>Payment Status</th>
                    <th>Date Added</th>
                    <th>Date Paid</th>
                    <th>Date Retrieved</th>
                    <th>Actions</th>
                </tr>
            </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td> <img src="uploads/' . $row['reciept'] . '" alt="reciept" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['paymentStatus'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['date_paid'] . '</td>
                        <td>' . $row['dateRetrieved'] . '</td>
                        <td>    
        
                            <!-- three btns for view, edit, and delete -->
                            <button class="btn" onclick="upload_reciept(' . $row['client_id'] . ')">
                                <i class="bx bxs-download text-success"></i>
                            </button>

                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')">
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button> 

                            <button class="btn" onclick="updateAccount(' . $row['client_id'] . ')">
                                <img src="icons/edit.svg" alt="view image" class="text-success">
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
    // USERS

    if ($searchBtn == "loginSearch") {
        $res = user_search($table, $searchItem);

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

    // search_client

    if ($searchBtn == "client_search") {
        $res = seacrh_client($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Client"s Name</th>
                        <th>CS Number</th>
                        <th>Model</th>
                        <th>Company</th>
                        <th>Date Added</th>
                        <th>Date Modified</th>
                        <th>Date Retrieved</th>
                        <th>Actions</th>
                    </tr>
                </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td> <img src="uploads/' . $row['img_path'] . '" alt="document form" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>' . $row['retrievedDate'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <!-- view -->
                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')" >
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button>

                            <!-- edit -->   
                            <button class="btn" onclick="viewEditAccount(' . $row['client_id'] . ')">
                                <img src="icons/edit.svg" alt="view image" class="text-primary">
                            </button>

                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['client_id'] . ')">
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



    if ($searchBtn == "search_deleted_client") {
        $res = seacrh_client($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Client"s Name</th>
                        <th>CS Number</th>
                        <th>Model</th>
                        <th>Company</th>
                        <th>Date Added</th>
                        <th>Date Modified</th>
                        <th>Date Retrieved</th>
                        <th>Actions</th>
                    </tr>
                </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td> <img src="uploads/' . $row['img_path'] . '" alt="document form" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>' . $row['retrievedDate'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <button class="btn" onclick="retrieved(' . $row['client_id'] . ')" data-toggle="tooltip" data-placement="bottom" title="Retrieved Button">
                            <i class="bx bxs-download text-success"></i>
                            </button>
                            
                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['client_id'] . ')">
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

    if ($searchBtn == "transact_search") {
        $res = seacrh_client($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
            <thead>
                <tr>
                    <th>Reciept</th>
                    <th>Client"s Name</th>
                    <th>CS Number</th>
                    <th>Company</th>
                    <th>Payment Status</th>
                    <th>Date Added</th>
                    <th>Date Paid</th>
                    <th>Date Retrieved</th>
                    <th>Actions</th>
                </tr>
            </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td> <img src="uploads/' . $row['reciept'] . '" alt="reciept" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['paymentStatus'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['date_paid'] . '</td>
                        <td>' . $row['dateRetrieved'] . '</td>
                        <td>    
        
                            <!-- three btns for view, edit, and delete -->
                            <button class="btn" onclick="upload_reciept(' . $row['client_id'] . ')">
                                <i class="bx bxs-download text-success"></i>
                            </button>

                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')">
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button> 

                            <button class="btn" onclick="updateAccount(' . $row['client_id'] . ')">
                                <img src="icons/edit.svg" alt="view image" class="text-success">
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


    // search_deleted_transactions

    if ($searchBtn == "search_deleted_transactions") {
        $res = seacrh_client($table, $searchItem);

        if ($res->num_rows > 0) {
            $table = '<table class="adminAcc-table">
            <thead>
                <tr>
                    <th>Reciept</th>
                    <th>Client"s Name</th>
                    <th>CS Number</th>
                    <th>Company</th>
                    <th>Payment Status</th>
                    <th>Date Added</th>
                    <th>Date Paid</th>
                    <th>Date Retrieved</th>
                    <th>Actions</th>
                </tr>
            </thead>';

            while ($row = $res->fetch_assoc()) {
                $table .= ' <tr>
                        <td> <img src="uploads/' . $row['reciept'] . '" alt="reciept" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['paymentStatus'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['date_paid'] . '</td>
                        <td>' . $row['dateRetrieved'] . '</td>
                        <td>
                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')">
                                <img src="icons/view.svg" alt="view image" class="text-success">
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


// deleted_user

if (isset($_POST['deleted_client'])) {
    $res = getData("deleted_client_account");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>FORM</th>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>CS Number</th>
            <th>Model</th>
            <th>Company</th>
            <th>Date Added</th>
            <th>Date Modified</th>
            <th>Actions</th>
        </tr>
    </thead>';
    /*
        client_id	img_path	customerName	csNumber	model	company	dateAdded	dateModified	
    */
    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td><img src="uploads/' . $row['img_path'] . '" alt="client_img" class="img"></td>
                        <td>' . $row['client_id'] . '</td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <button class="btn" onclick="retrieved(' . $row['client_id'] . ')" data-toggle="tooltip" data-placement="bottom" title="Retrieved Button">
                            <i class="bx bxs-download text-success"></i>
                            </button>
                            
                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['client_id'] . ')">
                                <img src="icons/delete.svg" alt="view image" class="text-danger">
                            </button>

                        </td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}

// CLIENT INFO
if (isset($_POST['display_client'])) {


    $res = getData("customer");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Document</th>
            <th>Client"s Name</th>
            <th>CS Number</th>
            <th>Model</th>
            <th>Company</th>
            <th>Date Added</th>
            <th>Date Modified</th>
            <th>Date Retrieved</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td> <a href="edit_form.php?id=' . $row['client_id'] . '"><img src="uploads/' . $row['img_path'] . '" alt="document form" class="img"></a> </td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['dateModified'] . '</td>
                        <td>' . $row['retrievedDate'] . '</td>
                        <td>
                            <!-- three btns for view, edit, and delete -->

                            <!-- view -->
                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')" >
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button>

                            <!-- edit -->   
                            <button class="btn" onclick="viewEditAccount(' . $row['client_id'] . ')">
                                <img src="icons/edit.svg" alt="view image" class="text-primary">
                            </button>

                            <!-- delete -->
                            <button class="btn" onclick="askDelete(' . $row['client_id'] . ')">
                                <img src="icons/delete.svg" alt="view image" class="text-danger">
                            </button>

                        </td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}

// display_transaction
if (isset($_POST['display_transaction'])) {


    $res = getData("transactions_history");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Reciept</th>
            <th>Client"s Name</th>
            <th>CS Number</th>
            <th>Company</th>
            <th>Payment Status</th>
            <th>Date Added</th>
            <th>Date Paid</th>
            <th>Date Retrieved</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td> <img src="uploads/' . $row['reciept'] . '" alt="reciept" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['paymentStatus'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['date_paid'] . '</td>
                        <td>' . $row['dateRetrieved'] . '</td>
                        <td>

                            <!-- three btns for view, edit, and delete -->
                        
                            <a href="edit_form.php?transact_id=' . $row['client_id'] . '" class="btn">
                                <i class="bx bxs-download text-success"></i>
                            </a>

                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')">
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button> 
                        </td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}


// deleted_transactions
if (isset($_POST['deleted_transactions'])) {


    $res = getData("deleted_transactions_history");

    $table = '<table class="adminAcc-table">
    <thead>
        <tr>
            <th>Reciept</th>
            <th>Transaction ID</th>
            <th>Client"s Name</th>
            <th>CS Number</th>
            <th>Company</th>
            <th>Payment Status</th>
            <th>Date Added</th>
            <th>Date Paid</th>
            <th>Date Retrieved</th>
            <th>Actions</th>
        </tr>
    </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td> <img src="uploads/' . $row['reciept'] . '" alt="reciept" class="img"></td>
                        <td>' . $row['client_id'] . '</td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['company'] . '</td>
                        <td>' . $row['paymentStatus'] . '</td>
                        <td>' . $row['dateAdded'] . '</td>
                        <td>' . $row['date_paid'] . '</td>
                        <td>' . $row['dateRetrieved'] . '</td>
                        <td>

                            <!-- three btns for view, edit, and delete -->
                        
                            <button class="btn" onclick="viewAdminAccount(' . $row['client_id'] . ')">
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button> 
                        </td>
                    </tr>';
    }
    $table .= "</table>";

    echo $table;
}

// view_reciept
if (isset($_POST['view_reciept'])) {
    $client_id = $conn->escape_string($_POST['id']);

    $res = getBY_clientID("transactions_history", $client_id);


    if ($res->num_rows > 0) {
        $res = $res->fetch_assoc();
        echo $res['reciept'];
    } else {
        echo "empty";
    }
}

if (isset($_POST['filter_client'])) {
    $columnName = $_POST['columnName'];
    $res = sortBy("customer", $columnName);

    $table = '<table class="adminAcc-table">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Client"s Name</th>
                        <th>CS Number</th>
                        <th>Model</th>
                        <th>Company</th>
                        <th>Date Added</th>
                        <th>Date Modified</th>
                        <th>Date Retrieved</th>
                        <th>Actions</th>
                    </tr>
                </thead>';

    while ($row = $res->fetch_assoc()) {
        $table .= ' <tr>
                        <td> <img src="uploads/' . $row['img_path'] . '" alt="document form" class="img"></td>
                        <td>' . $row['customerName'] . '</td>
                        <td>' . $row['csNumber'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['company'] . '</td>
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


// View Client

if (isset($_POST['view_client_btn'])) {

    $id = $conn->escape_string($_POST['id']);

    $res = get_customer_by_clientID("customer", $id);
    $response = array();

    while ($row = $res->fetch_assoc()) {
        $response = $row;
    }

    echo json_encode($response);
}


if (isset($_POST["view_deleted_transact_btn"])) {
    $client_id = $conn->escape_string($_POST['client_id']);
    $res = get_customer_by_clientID("deleted_transactions_history", $client_id);

    if ($res->num_rows > 0) {
        $res = $res->fetch_assoc();
        echo $res['reciept'];
    } else {
        echo "empty";
    }
}



// USERS INFO
if (isset($_POST['view_user_btn'])) {


    $user_id = $conn->escape_string($_POST['id']);

    $res = getBY_userID("user", $user_id);
    $response = array();
    
    while ($row = $res->fetch_assoc()) {
        $response = $row;
    }

    echo json_encode($response);
}
