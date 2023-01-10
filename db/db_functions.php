<?php
require_once  __DIR__ . './config.php';

define("CONNECT", $connect);

function execute_query($query, $types = null, ...$params) {
    $stmt = mysqli_stmt_init(CONNECT);
    mysqli_stmt_prepare($stmt, $query);

    // if params passed for binding query
    if(isset($types, $params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if(!$result) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    return $row;

}