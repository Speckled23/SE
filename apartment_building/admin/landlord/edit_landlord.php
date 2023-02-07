<?php

   // require_once '../tools/functions.php';
    require_once '../classes/landlord.classes.php';
    require_once '../classes/address.php';

    //resume session here to fetch session values
    session_start();
    /*
        if user is not login then redirect to login page,
        this is to prevent users from accessing pages that requires
        authentication such as the dashboard
    */
    if (!isset($_SESSION['logged-in'])){
        header('location: ../login/login.php');
    }
    //if the above code is false then code and html below will be executed
    $landlord = new Landlord;
    //if add tenants is submitted
    if(isset($_POST['save'])){


        //sanitize user inputs
        $landlord->id = $_POST['landlord-id'];
        $landlord->firstname = htmlentities($_POST['firstname']);
        $landlord->lastname = htmlentities($_POST['lastname']);
        $landlord->email = htmlentities($_POST['email']);
        $landlord->contact_num = $_POST['contact_num'];
        $landlord->address = $_POST['address'];
        $landlord->city = $_POST['city'];
        $landlord->state = $_POST['state'];
        $landlord->zip = $_POST['zip'];
        $landlord->id_doc = $_POST['id_doc'];
        $landlord->fname = $_POST['fname'];
        $landlord->emergency_num = $_POST['emergency_num'];

        if(validate_add_landlord($_POST)){
            if($landlord->add()){
                //redirect user to program page after saving
                header('location: landlord.php');
            }
        }
    }else{
        if($landlord->fetch($_GET['id'])){

            $data = $landlord -> fetch($_GET['id']);

            $landlord->firstname = $data['firstname'];
            $landlord->lastname = $data['lastname'];
            $landlord->email = $data['email'];
            $landlord->contact_num = $data['contact_num'];
            $landlord->address = $data['address'];
            $landlord->city = $data['city'];
            $landlord->state = $data['state'];
            $landlord->zip =$data['zip'];
            $landlord->id_doc =$data['id_doc'];
            $landlord->fname =$data['fname'];
            $landlord->emergency_num =$data['emergency_num'];
        }
    }

    $page_title = 'Admin | Add Landlord';
    $landlord = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';

?>
<div class="home-content">
    <div class = "table-heading">
        <h3 class="table-title">Landlord Details</h3>
        <a href="landlord.php" class ='bx bx-caret-left'>Back</a>
    </div>
    <div class ="add-tenant-container">
    <form class="add-form" action="addprogram.php" method="post"><!-- this is the start of the form -->
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname"  value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>" required =""><br>

        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname"  value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>" required =""><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"  value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required =""><br>

        <label for="contact_num">Contact No.</label>
        <input type="number" id="contact_num" name="contact_num"  value="<?php if(isset($_POST['contact_num'])) { echo $_POST['contact_num']; } ?>" required =""><br>

        <!--  -->
        <label for="address">Address</label>
        <input type="text" id="address" name="address"  value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" required =""><br>

        <label for="city">City</label>
        <?php 
		$obj = new MyClass();
		$row = $obj->getData("select city from city"); 
        ?>
        <select>
            <?php foreach($row as $row){ ?>
                <option><?php echo $row['city'] ?></option>

        <?php  }  ?>

        <label for="state">C</label>
        <input type="text" id="state" name="state" placeholder = "Country" value="<?php if(isset($_POST['state'])) { echo $_POST['state']; } ?>" required =""><br>

        <label for="zip">Zip</label>
        <input type="number" id="zip" name="zip"  value="<?php if(isset($_POST['zip'])) { echo $_POST['zip']; } ?>" required =""><br>

        <label for="id_doc">Identification Document</label>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <div class = "table-heading">
        <h3 class="table-title">Emergency Contact Details</h3>
        </div>


        <label for="fname">Full Name</label>
        <input type="text" id="fname" name="fname"  value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; } ?>" ><br>

        <label for="emergency_num">Contact No.</label>
        <input type="number" id="emergency_num" name="emergency_num"  value="<?php if(isset($_POST['emergency_num'])) { echo $_POST['emergency_num']; } ?>" ><br>

        <input type="submit" class="button" value="Save Landlord" name="save" id="save">
        </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>