<section class="home-section">
    <nav>
        <div class="profile-details">
            <i class='bx bx-user-circle'></i>
            <!-- each time you need to output in PHP, use echo -->
            <!-- the $_SESSION['fullname'] is set in login page -->
            <!-- session variables can be accessed anywhere in the page -->
            <span class="admin-name"><?php echo $_SESSION['fullname']?></span>
        </div>
    </nav>
    </nav>