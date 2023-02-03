<?php
function validate_firstname($POST){
    if(!isset($POST['code'])){
        return false;
    }else if(strlen(trim($POST['code']))<1){
        return false;
    }
    return true;
}

function validate_program_code_duplicate($POST){
    if(!isset($POST['code'])){
        return false;
    }
    elseif(isset($POST['old-code'])){
        if(strcmp(strtolower($POST['code']), strtolower($POST['old-code'])) == 0){
            return true;
        }else{
            $program = new Program();
            foreach ($program->show() as $value){
                if(strcmp(strtolower($value['code']), strtolower($POST['code'])) == 0){
                    return false;
                }
            }
        }
    }else{
        $program = new Program();
        foreach ($program->show() as $value){
            if(strcmp(strtolower($value['code']), strtolower($POST['code'])) == 0){
                return false;
            }
        }
    }
    return true;
}

function validate_program_desc($POST){
    if(!isset($POST['description'])){
        return false;
    }else if(strlen(trim($POST['description']))<1){
        return false;
    }
    return true;
}

function validate_level($POST){
    if(!isset($POST['level'])){
        return false;
    }else if(strcmp($POST['level'], 'None') == 0){
        return false;
    }
    return true;
}

function validate_cet($POST){
    if(!isset($POST['cet'])){
        return false;
    }else if($POST['cet'] < 55){
        return false;
    }
    return true;
}

function validate_status($POST){
    if(!isset($POST['status'])){
        return false;
    }
    return true;
}


function validate_add_tenants($POST){
    if(!validate_firstname($POST) || !validate_lastname($POST) || !validate_email($POST) ||
     !validate_contact_num($POST) || !validate_status($POST) || !validate_household_type($POST) 
     || !validate_prev_address($POST) || !validate_city($POST) || !validate_state($POST)
     || !validate_zip($POST) || !validate_gender($POST) || !validate_birthdate($POST)
     || !validate_pet_num($POST)
     || !validate_occupants($POST)|| !validate_household_type($POST)|| !validate_household_type($POST)
     || !validate_household_type($POST) || !validate_household_type($POST)|| !validate_household_type($POST)
     || !validate_household_type($POST)|| !validate_household_type($POST)|| !validate_household_type($POST)){
        return false;
     }
    return true;
}

?>