<?php

function validateDecrypt($cipher) {
    $errors = array();

    if(empty($cipher['cipher'])) {
        array_push($errors, 'cipher key is required');
    }
    
    return $errors;
}