<?php
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

function validate_add_landlord($POST){
    if(!validate_firstname($POST) || !validate_lastname($POST) || !validate_email($POST) ||
     !validate_contact_num($POST) || !validate_address($POST) || !validate_city($POST) 
     || !validate_state($POST) || !validate_zip($POST) || !validate_id_doc($POST)
     || !validate_fname($POST) || !validate_emergency_num($POST)){
        return false;
     }
    return true;
}

?>