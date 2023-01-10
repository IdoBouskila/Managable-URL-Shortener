<?php 
require_once '../db/db_functions.php';

function is_form_valid($username, $plaintext_password) {
    if(strlen($username) && strlen($plaintext_password)) {
        return true;
    }

    return false;   
}

function is_user_exist($username) {
    $row = execute_query(
        "SELECT * FROM users
        WHERE username = ?",
        's', $username
    );

    if(!$row) {
        return false;
    }

    return true;
}

function create_user($username, $plaintext_password) {
    $hashed_password = password_hash($plaintext_password, PASSWORD_DEFAULT);

    execute_query(
        "INSERT INTO users (username, password)
        VALUES(?, ?)",
        'ss',
        $username, $hashed_password
    );
}

function attempt_login($username, $plaintext_password) {
    $user = execute_query(
        "SELECT * FROM users
        WHERE username = ?",
        's',
        $username
    );

    if(!$user) {
        return null;
    }

    return password_verify($plaintext_password, $user['password'])
    ? $user['id']
    : null;



}
