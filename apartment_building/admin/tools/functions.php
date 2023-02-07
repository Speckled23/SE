<?php

function validate_add_tenant($POST){
    if(!validate_firstname($POST) || !validate_lastname($POST) || !validate_contact_num($POST) || !validate_emergency_fname($POST)
     || !validate_emergency_num($POST)){
        return false;
     }
    return true;
}

function validate_tenant($POST){
    if(!isset($POST['tenant'])){
        return false;
    }
    return true;
}

function validate_firstname($POST){
    if(!isset($POST['firstname'])){
        return false;
    }else if(strlen(trim($POST['firstname']))<1){
        return false;
    }
    return true;
}

function validate_lastname($POST){
    if(!isset($POST['firstname'])){
        return false;
    }else if(strlen(trim($POST['firstname']))<1){
        return false;
    }
    return true;
}


function validate_contact_num($POST){
    if(!isset($POST['contact_num'])){
        return false;
    }else if(strlen(trim($POST['contact_num']))<1){
        return false;
    }
    return true;
}

function validate_emergency_fname($POST){
    if(!isset($POST['emergency_fname'])){
        return false;
    }else if(strlen(trim($POST['emergency_fname']))<1){
        return false;
    }
    return true;
}

function validate_emergency_num($POST){
    if(!isset($POST['emergency_num'])){
        return false;
    }else if(strlen(trim($POST['emergency_num']))<1){
        return false;
    }
    return true;
}


?>