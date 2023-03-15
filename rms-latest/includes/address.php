<?php
    if($_POST['action'] == 'provinces'){
        require_once '../classes/reference.class.php';
        $ref_obj = new Reference();
        $ref = $ref_obj->get_province($_POST['filter']);
    ?>
        <option value="none">--Select--</option>
    <?php
        foreach($ref as $row){
    ?>
            <option value="<?=$row['provCode']?>"><?=$row['provDesc']?></option>
    <?php
        }
    }
    if($_POST['action'] == 'city'){
        require_once '../classes/reference.class.php';
        $ref_obj = new Reference();
        $ref = $ref_obj->get_City($_POST['filter']);
    ?>
        <option value="none">--Select--</option>
    <?php
        foreach($ref as $row){
    ?>
            <option value="<?=$row['citymunCode']?>"><?=$row['citymunDesc']?></option>
    <?php
        }
    }
    
    if($_POST['action'] == 'barangay'){
        require_once '../classes/reference.class.php';
        $ref_obj = new Reference();
        $ref = $ref_obj->get_brgy($_POST['filter']);
    ?>
        <option value="none">--Select--</option>
    <?php
        foreach($ref as $row){
    ?>
            <option value="<?=$row['brgyCode']?>"><?=$row['brgyDesc']?></option>
    <?php
        }

    }
    ?>
