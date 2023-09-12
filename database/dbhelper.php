<?php
require_once 'config.php';

function execute($sql): void
{
    $conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    if ($conn->connect_error) {
        var_dump($conn->connect_error);
        die();
    }
    //query
    mysqli_query($conn, $sql);

    //close connection
    mysqli_close($conn);
    return;
}

//SQL select
function executeResult($sql, $isSingle = false)
{
    $data = null;

    $conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    if ($conn->connect_error) {
        var_dump($conn->connect_error);
        die();
    }
    //query
    $resultset = mysqli_query($conn, $sql);

    if ($isSingle == true) {
        $data = mysqli_fetch_array($resultset, 1);
    } else {
        $data = [];
        while (($row = mysqli_fetch_array($resultset, 1)) != null) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);

    return $data;
}
