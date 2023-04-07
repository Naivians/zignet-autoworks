<?php

include "includes/config.php";
include "includes/date.php";

// DATES
function todays_client()
{
    global $conn, $year, $month, $date;
    $sql = "SELECT * FROM `customer` WHERE dateAdded=CURDATE();";
    return $conn->query($sql);
}


// /*check_schedule
// $queryWeek = "SELECT count(*) as `week` from `patient_visits` where YEARWEEK(`visit_date`) = YEARWEEK('$date');";
// $queryYear = "SELECT count(*) as `year` from `patient_visits` where YEAR(`visit_date`) = YEAR('$date');";
// $queryMonth = "SELECT count(*) as `month` from `patient_visits` where YEAR(`visit_date`) = $year and MONTH(`visit_date`) = $month;";
// $sql = "SELECT count(*) as `month` FROM `tbl_patient` WHERE YEAR(`patient_preffered_day_treatment`) = '$year' AND  MONTH('patient_preffered_day_treatment') = $month;";
// select * from users where MONTH(order_date) = MONTH(now()) and YEAR(order_date) = YEAR(now());
// */
function current_week_client()
{
    global $conn, $year, $month, $date;
    $sql = "SELECT * FROM customer WHERE YEARWEEK(dateAdded) = YEARWEEK(NOW());";
    return $conn->query($sql);
}

function current_month_client()
{
    global $conn, $year, $month, $date;
    $sql = "SELECT * FROM customer WHERE MONTH(dateAdded)=MONTH(now()) and YEAR(dateAdded)=YEAR(now());";
    return $conn->query($sql);
}

function current_year_client()
{
    global $conn, $year, $month, $date;
    $sql = "SELECT * FROM customer WHERE YEAR(dateAdded) = YEAR(CURRENT_DATE())";
    return $conn->query($sql);
}




// RETRIEVE
function getData($table)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    $res = $conn->query($sql);

    return $res;
}

function getById($table, $id)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function getBY_clientID($table, $client_id)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `client_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $client_id);
    $stmt->execute();
    return $stmt->get_result();
}



function get_customer_by_clientID($table, $client_id)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `client_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $client_id);
    $stmt->execute();
    return $stmt->get_result();
}


function retrievedById($table, $id)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `adminID` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

// check if username already exists
function checkForUsername($username)
{
    global $conn;
    $sql = "SELECT * FROM `admins` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $rows = $stmt->get_result();
    $rows = $rows->num_rows;
    return $rows;
}

function validateCredential($username)
{
    global $conn;
    $sql = "SELECT * FROM `admins` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result();
}

function sortBy($table, $column)
{
    global $conn;
    $sql = "SELECT * FROM `$table` ORDER BY $column ASC";
    return $conn->query($sql);
}

function liveSearch($table, $searhcItem)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `adminName` LIKE '%{$searhcItem}%' ";
    return $conn->query($sql);
}

function seacrh_client($table, $searhcItem)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `customerName` LIKE '%{$searhcItem}%' ";
    return $conn->query($sql);
}

function retrievedAdmin($adminName, $username, $password, $role, $dateAdded, $dateModified)
{
    global $conn, $today;

    $sql = "INSERT INTO `admins` (`adminName`, `role`, `username`, `password`, `dateAdded`,`dateModified`,`retrievedDate`) VALUES(?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $adminName, $role, $username, $password, $dateAdded, $dateModified, $today);

    // return true of false
    return $stmt->execute();
}


// END OF RETIREVAL


// INSERT
function addAdmin($adminName, $username, $password, $role)
{
    global $conn, $today;

    $sql = "INSERT INTO `admins` (`adminName`, `role`, `username`, `password`, `dateAdded`) VALUES(?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $adminName, $role, $username, $password, $today);

    // return true of false
    return $stmt->execute();
}

function loginHistory($adminID, $adminName, $username, $role)
{
    // adminID	adminName	username	role	login = date today	
    global $conn, $login_date;
    $loginDate = $login_date;

    $sql = "INSERT INTO `login_history` (`adminID`, `adminName`,`username`,`role`,`login`) VALUES(?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $adminID, $adminName, $username, $role, $loginDate);
    // return true of false
    $stmt->execute();
    return $stmt->insert_id;
}

function getDeletedAdminaccount($adminID, $adminName, $role, $username, $password, $dateAdded, $dateModified)
{
    global $conn, $today;

    $sql = "INSERT INTO `deleted_admin_account` (`adminID`, `adminName`, `role`, `username`, `password`, `dateAdded`, `dateModified`) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $adminID, $adminName, $role, $username, $password, $dateAdded, $dateModified);
    $stmt->execute();
}



function get_deleted_client($client_id)
{
    global $conn;

    $sql =  "
    INSERT INTO deleted_client_account 
    SELECT * FROM customer WHERE customer.client_id = '$client_id';
    ";

    return $conn->query($sql);
}

function get_deleted_transactions($client_id)
{
    global $conn;
    $sql = " INSERT INTO deleted_transactions_history
    SELECT * FROM transactions_history WHERE transactions_history.client_id = '$client_id';";
    return $conn->query($sql);
}

function insert_client_data($client_id, $img_path, $customerName, $csNumber, $model, $company)
{
    // 	
    global $conn, $today;
    $sql = "INSERT INTO `customer` (`client_id`, `img_path`, `customerName`, `csNumber`, `model`, `company`, `dateAdded`) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $client_id, $img_path, $customerName, $csNumber, $model, $company, $today);

    return $stmt->execute();
}
// customerName	csNumber	paymentStatus	dateAdded	
function insert_client_transactions($client_id, $reciept, $customerName, $csNumber, $company, $paymentStatus)
{
    // 	
    global $conn, $today;
    $sql = "INSERT INTO `transactions_history` (`client_id`, `reciept`, `customerName`, `csNumber`, `company` ,`paymentStatus`, `dateAdded`) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $client_id, $reciept, $customerName, $csNumber, $company, $paymentStatus, $today);

    return $stmt->execute();
}

function retrieved_client($client_id, $img_path, $customerName, $csNumber, $model, $company, $dateAdded, $dateModified)
{
    global $conn, $today;
    $sql = "INSERT INTO `customer` (`client_id`, `img_path`, `customerName`, `csNumber`, `model`, `company`, `dateAdded`, `dateModified`, `retrievedDate`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $client_id, $img_path, $customerName, $csNumber, $model, $company, $dateAdded, $dateModified, $today);

    return $stmt->execute();
}

function retrieved_transactions($client_id, $reciept, $customerName, $csNumber, $paymentStatus, $dateAdded, $date_paid)

{
    /**
     * 	
    client_id	
    reciept	
    customerName	
    csNumber	
    paymentStatus	
    dateAdded	
    date_paid	
    dateRetrieved
     */

    global $conn, $today;
    $sql = "INSERT INTO `transactions_history` (`client_id`, `reciept`, `customerName`, `csNumber`,`paymentStatus`, `dateAdded`, `date_paid`,`dateRetrieved`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $client_id, $reciept, $customerName, $csNumber, $paymentStatus, $dateAdded, $date_paid, $today);

    return $stmt->execute();
}
// END OF INSERTION

// UPDATE
function updateAdminAccount($updateId, $adminName, $username, $password, $role)
{
    global $conn, $today;

    $sql = "UPDATE `admins` SET `adminName`=?, `role`=?, `username`=?, `password`=?, `dateModified`=? WHERE `id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $adminName, $role, $username, $password, $today, $updateId);
    // return true of false
    return $stmt->execute();
}

function update_img($img_path, $img_id)
{
    global $conn, $today;

    $sql = "UPDATE `customer` SET `img_path`=? WHERE `client_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $img_path, $img_id);
    // return true of false
    return $stmt->execute();
}

function update_transact_img($img_path, $img_id)
{
    global $conn, $today;

    $sql = "UPDATE `transactions_history` SET `reciept` = ?, `paymentStatus` = 'paid', `date_paid` = '$today' WHERE `client_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $img_path, $img_id);
    // return true of false
    return $stmt->execute();
}

// END OF UPDATE
function logout($adminID)
{
    global $conn, $login_date;
    
    $sql = "UPDATE `login_history` SET `logout`=? WHERE `loginID`=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $login_date, $adminID);
    // return true of false
    $stmt->execute();
}

// DELETE
function deleteData($table, $id)
{
    global $conn;

    if ($table == "admins") {
        $sql = "DELETE FROM `$table` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    if ($table == "deleted_admin_account") {
        $sql = "DELETE FROM `$table` WHERE `adminID` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}

// delete from multiple tables
function delete_client_and_transactions($client_id)
{
    global $conn;
    $sql = "DELETE transactions_history, customer
    FROM transactions_history
    INNER JOIN customer ON transactions_history.client_id = customer.client_id
    WHERE transactions_history.client_id='$client_id';";

    return $conn->query($sql);
}

function permanently_deleted_client_and_transactions($client_id)
{
    global $conn;
    $sql = "DELETE deleted_transactions_history, deleted_client_account
    FROM deleted_transactions_history
    INNER JOIN deleted_client_account ON deleted_transactions_history.client_id = deleted_client_account.client_id
    WHERE deleted_transactions_history.client_id='$client_id';";

    return $conn->query($sql);
}

function update_client_and_transactions($client_id, $model, $company, $customer_name, $cs_number)
{
    global $conn, $today;
    $sql = "UPDATE customer, transactions_history SET customer.customerName = '$customer_name', customer.csNumber = '$cs_number', customer.model='$model', customer.company='$company', customer.dateModified='$today', transactions_history.customerName='$customer_name', transactions_history.csNumber = '$cs_number', transactions_history.company = '$company' WHERE customer.client_id='$client_id' AND transactions_history.client_id='$client_id';";

    return $conn->query($sql);
}
