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

function inactive_users()
{
    global $conn;
    $sql = "SELECT active FROM `user` WHERE `active` = 0";
    return $conn->query($sql);
}

function active_users()
{
    global $conn;
    $sql = "SELECT active FROM `user` WHERE `active` = 1";
    return $conn->query($sql);
}

function is_username_exist($username)
{
    global $conn;
    $sql = "SELECT `username` FROM user WHERE `username` = '$username'";
    return $conn->query($sql);
}

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
    $sql = "SELECT * FROM `$table` WHERE `id` = '$id' ORDER BY date_added ASC ";
    return $conn->query($sql);
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

function getBY_userID($table, $user_id)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `user_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
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

function validateCredential($table, $username)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `username` = ?";
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

function search_request($table, $searchItem)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `user_id` LIKE '%{$searchItem}%' OR `request_id` LIKE '%{$searchItem}%' OR `display_name` LIKE '%{$searchItem}%' OR `address` LIKE '%{$searchItem}%' OR `service` LIKE '%{$searchItem}%' OR `request_status` LIKE '%{$searchItem}%' OR `schedule` LIKE '%{$searchItem}%'";
    return $conn->query($sql);
}

function liveSearch($table, $searchItem)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `adminName` LIKE '%{$searchItem}%' ";
    return $conn->query($sql);
}

function user_search($table, $searchItem)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `user_id` LIKE '%{$searchItem}%' OR `display_name` LIKE '%{$searchItem}%' OR `username` LIKE '%{$searchItem}%' OR `contact` LIKE '%{$searchItem}%' OR `date_added` LIKE '%{$searchItem}%' OR `active` LIKE '%{$searchItem}%'";
    return $conn->query($sql);
}

function seacrh_client($table, $searchItem)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `customerName` LIKE '%{$searchItem}%' ";
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


function insert_form($user_id, $request_id, $display_name, $address, $service, $description_of_service, $request_status, $schedule, $contact)
{
    global $conn, $today;
    
    $sql = "INSERT INTO `request_form` (`user_id`,`request_id` , `display_name`, `address`, `service`, `description_of_service`, `request_status`, `schedule`,`date_added`, `contact`) VALUES(?,?,?,?,?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $user_id, $request_id, $display_name, $address, $service, $description_of_service, $request_status,$schedule,$today, $contact);
    // return true of false
    return $stmt->execute();
}

function insert_user($user_id, $display_name, $username, $password,  $contact, $OTP_code)
{
    global $conn, $today;

    $role = "user";

    $sql = "INSERT INTO `user` (`user_id`, `display_name`, `role`, `username`, `password`, `contact`, `date_added`, `OTP_code`) VALUES(?,?,?,?,?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $user_id, $display_name, $role, $username, $password, $contact, $today, $OTP_code);
    // return true of false
    $stmt->execute();
    return $stmt->insert_id;
}

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

function get_deleted_user($id)
{
    global $conn;

    $sql =  "
    INSERT INTO deleted_user 
    SELECT * FROM user WHERE user.id = '$id';
    ";

    return $conn->query($sql);
}

function get_deleted_request($id)
{
    global $conn;

    $sql =  "
    INSERT INTO deleted_request_form
    SELECT * FROM request_form WHERE request_form.id = '$id';
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

function retrieved_user($user_id, $display_name,$role , $username, $password, $contact, $date_added, $date_modified, $active){
    global $conn, $today;
    $sql = "INSERT INTO `user` (`user_id`, `display_name`,`role`, `username`, `password`, `contact`, `date_added`, `date_modified`, `date_retrieved`, `active`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $user_id, $display_name,$role,$username, $password, $contact, $date_added, $date_modified,$today, $active);

    return $stmt->execute();
}

function retrieved_transactions($client_id, $reciept, $customerName, $csNumber, $paymentStatus, $dateAdded, $date_paid)

{

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


// USERS ACTIVATIONS
function activate($user_id)
{   
    global $conn;
    $sql = "UPDATE `user` SET active = 1  WHERE `user_id` = '$user_id'";
    return $conn->query($sql);
}

function deactivate($user_id)
{
    global $conn;
    $sql = "UPDATE `user` SET active = 0 WHERE `user_id` = '$user_id'";
    return $conn->query($sql);
}

function activate_all()
{
    global $conn;
    $sql = "UPDATE `user` SET active = 1 WHERE `active` = 0";
    return $conn->query($sql);
}

function deactivate_all()
{
    global $conn;
    $sql = "UPDATE `user` SET active = 0 WHERE `active` = 1";
    return $conn->query($sql);
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

    if ($table == "deleted_user") {
        $sql = "DELETE FROM `$table` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}

function delete_user($id)
{
    global $conn;
    $sql = "DELETE FROM `user` WHERE `id` = '$id'";
    return $conn->query($sql);
}

function delete_request($id)
{
    global $conn;
    $sql = "DELETE FROM `request_form` WHERE `id` = '$id'";
    return $conn->query($sql);
}

function delete_archive_request($id)
{
    global $conn;
    $sql = "DELETE FROM `deleted_request_form` WHERE `id` = '$id'";
    return $conn->query($sql);
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

// users
function update_user($user_id, $update_display_name, $update_username, $update_password, $update_contact)
{
    global $conn, $today;

    $sql = "UPDATE `user` SET `display_name` = '$update_display_name', `username` = '$update_username', `password` = '$update_password',`contact`='$update_contact', `date_modified` = '$today' WHERE `user_id` = '$user_id'";

    return $conn->query($sql);
}

