<?php

/* tenant validation */
function validate_first_name($POST) {
   $first_name = strip_tags(trim($POST['first_name']));
   if (preg_match('/[^A-Za-z\s-]/', $first_name)) {
     // Returns false if the string contains anything other than letters, spaces or dashes.
     return false;
   }
   return true;
 }

 function validate_middle_name($POST) {
   $middle_name = strip_tags(trim($POST['middle_name']));
   if (preg_match('/[^A-Za-z\s-]/', $middle_name)) {
     // Returns false if the string contains anything other than letters, spaces or dashes.
     return false;
   }
   return true;
 }

function validate_last_name($POST) {
   $last_name = strip_tags(trim($POST['last_name']));
   if (preg_match('/[^A-Za-z\s-]/', $last_name)) {
     // Returns false if the string contains anything other than letters, spaces or dashes.
     return false;
   }
   return true;
}

function validate_date_birth($POST) {
   // Sanitize the date input and convert to a timestamp
   $timestamp = strtotime(filter_var(trim($POST['date_of_birth']), FILTER_SANITIZE_STRING));
 
   // Calculate the age of the person based on the timestamp
   $age = (int) ((time() - $timestamp) / 31536000); // 31536000 = 1 year in seconds
 
   // Check if the person is 18 years old or above
   if ($age >= 18) {
     // If the person is 18 years old or above, return the sanitized date
     return true;
   } else {
     // If the person is under 18 years old, return false
     return false;
   }
 }

function validate_email($POST) {
  // Remove any tags and white space from the email address
  $email = filter_var(trim($POST['email']), FILTER_SANITIZE_EMAIL);

  // Validate the email address
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // If the email address is valid, return it
    return true;
  } else {
    // If the email address is not valid, return false
    return false;
  }
}

function validate_contact_num($POST) {
  // Remove all non-digit characters from the input using a regular expression
  $digits = preg_replace('/[^0-9]/', '', $POST['contact_no']);

  // Check if the input contains only digits
  if (preg_match('/^[0-9]+$/', $digits)) {
    // If the input contains only digits, return the sanitized input
    return true;
  } else {
    // If the input contains non-digit characters, return false
    return false;
  }
}

function validate_prev_address($POST){
     // Remove all non-letter, non-digit characters from the input using a regular expression
  $letters_digits = preg_replace('/[^a-zA-Z0-9]/', '', $POST['previous_address']);

  // Check if the input contains only letters and digits using a regular expression
  if (preg_match('/^[a-zA-Z0-9]+$/', $letters_digits)) {
    // If the input contains only letters and digits, return the sanitized input
    return true;
  } else {
    // If the input contains non-letter, non-digit characters, return false
    return false;
  }
}
function validate_address($POST){
  // Remove all non-letter, non-digit characters from the input using a regular expression
$letters_digits = preg_replace('/[^a-zA-Z0-9]/', '', $POST['address']);

// Check if the input contains only letters and digits using a regular expression
if (preg_match('/^[a-zA-Z0-9]+$/', $letters_digits)) {
 // If the input contains only letters and digits, return the sanitized input
 return true;
} else {
 // If the input contains non-letter, non-digit characters, return false
 return false;
}
}

function validate_region($POST){
   if(!isset($POST['region'])){
       return false;
   }else if(strcmp($POST['region'], 'None') == 0){
       return false;
   }
   return true;
}

function validate_prov($POST){
   if(!isset($POST['provinces'])){
       return false;
   }else if(strcmp($POST['provinces'], 'None') == 0){
       return false;
   }
   return true;
}

function validate_city($POST){
  if(!isset($POST['city'])){
      return false;
  }else if(strcmp($POST['city'], 'None') == 0){
      return false;
  }
  return true;
}

function validate_sex($POST){
   if(!isset($POST['sex'])){
      return false;
  }else if(strcmp($POST['sex'], 'None') == 0){
      return false;
  }
  return true;
}

function validate_has_pet($POST){
   if(!isset($POST['has_pet'])){
      return false;
   }
   return true;
}

function validate_pet_type($POST){
   $type_of_pet = strip_tags(trim($POST['type_of_pet']));
   if (preg_match('/[^A-Za-z\s-]/', $type_of_pet)) {
     // Returns false if the string contains anything other than letters, spaces or dashes.
     return false;
   }
   return true;
}

function validate_civil_status($POST){
   if(!isset($POST['relationship_status'])){
      return false;
  }else if(strcmp($POST['relationship_status'], 'None') == 0){
      return false;
  }
  return true;
}

function validate_is_smoking($POST){
   if(!isset($POST['is_smoking'])){
       return false;
   }
   return true;
}

function validate_house($POST){
   if(!isset($POST['type_of_household'])){
       return false;
   }else if(strcmp($POST['type_of_household'], 'None') == 0){
       return false;
   }
   return true;
}

function validate_full_name($POST) {
   $emergency_contact_person = strip_tags(trim($POST['emergency_contact_person']));
   if (preg_match('/[^A-Za-z\s-]/', $emergency_contact_person)) {
     // Returns false if the string contains anything other than letters, spaces or dashes.
     return false;
   }
   return true;
 }

 function validate_econtact_no($POST) {
   // Remove all non-digit characters from the input using a regular expression
   $emergency_contact_number = preg_replace('/[^0-9]/', '', $POST['emergency_contact_number']);
 
   // Check if the input contains only digits
   if (preg_match('/^[0-9]+$/', $emergency_contact_number)) {
     // If the input contains only digits, return the sanitized input
     return true;
   } else {
     // If the input contains non-digit characters, return false
     return false;
   }
 }
 



function validate_tenants($POST) {
  if (!validate_first_name($POST) || !validate_middle_name($POST) || !validate_last_name($POST) || !validate_email($POST) || !validate_contact_num($POST) || !validate_sex($POST) || !validate_has_pet($POST) || !validate_date_birth($POST) || !validate_prev_address($POST) || !validate_region($POST) || !validate_prov($POST) || !validate_pet_type($POST) || !validate_civil_status($POST) || !validate_is_smoking($POST) || !validate_house($POST) || !validate_city($POST) || !validate_full_name($POST) || !validate_econtact_no($POST)){
    return false;
  }
  return true;
}



function validate_add_landlord($post) {
  if (!validate_first_name($post) || !validate_middle_name($post) || !validate_last_name($post) || !validate_email($post) || !validate_contact_num($post) || !validate_date_birth($post) || !validate_address($post) || !validate_region($post) || !validate_prov($post) || !validate_city($post) || !validate_full_name($post) || !validate_econtact_no($post)){
    return false;
  }
  return true;
}



?>