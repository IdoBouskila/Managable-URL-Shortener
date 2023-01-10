<?php

function redirect($location, $error = null) {
    if(isset($error)) {
        header("location: $location?error=$error");
        die();
    }
    
    header("location: $location");
    die();
}