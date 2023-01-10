<?php 
require_once __DIR__ . './auth_functions.php';
require_once '../db/db_functions.php';
require_once '../helpers.php';

session_start();

function sign_up_user($username, $plaintext_password) {
    if(!is_form_valid($username, $plaintext_password)) {
        redirect(
            './register.php',
            'Fields cannot be empty'
        );
    }
    
    if(is_user_exist($username)) {
        redirect(
            './register.php',
            'Username already in use'
        );
    }

    create_user($username, $plaintext_password);
}


function handle_login($username, $plaintext_password) {
    if(!is_form_valid($username, $plaintext_password)) {
        redirect(
            './login.php',
            'Fields cannot be empty'
        );
    }

    if(! $id = attempt_login($username, $plaintext_password)) {
        redirect(
            './login.php',
            'The username or password is incorrect'
        );
    }
    
    $_SESSION['id'] = $id;
    redirect('../index.php');
}