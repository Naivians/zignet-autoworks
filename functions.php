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

function getById($table, $id){
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

// check if username already exists
function checkForUsername($username)
{
    global $conn;
    $sql = "SELECT * FROM `admins` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("s", $username);
    $stmt->execute();
    $rows = $stmt->get_result();
    $rows = $rows->num_rows;

    return $rows;

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
// UPDATE
// DELETE
function deleteData($table, $id){
    global $conn;

    $sql = "DELETE FROM `$table` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param('i', $id);
    return $stmt->execute();
}
