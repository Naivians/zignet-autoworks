<?php

include "includes/config.php";
include "includes/date.php";

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

function retrievedAdmin($adminName, $username, $password, $role, $dateAdded, $dateModified)
{
    global $conn, $today;

    $sql = "INSERT INTO `admins` (`adminName`, `role`, `username`, `password`, `dateAdded`,`dateModified`,`retrievedDate`) VALUES(?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $adminName, $role, $username, $password, $dateAdded, $dateModified,$today);

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
    global $conn, $today;
    $loginDate = $today;

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
// END OF UPDATE

function logout($adminID)
{
    global $conn, $today;

    $logoutDate = $today;

    $sql = "UPDATE `login_history` SET `logout`=? WHERE `loginID`=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $logoutDate, $adminID);
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
