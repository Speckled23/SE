<section class="home-section">
<nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
      </div>
        <div class="profile-details">
            <i class='bx bx-user-circle'></i>
            <!-- each time you need to output in PHP, use echo -->
            <!-- the $_SESSION['fullname'] is set in login page -->
            <!-- session variables can be accessed anywhere in the page -->
            <span class="admin-name"><?php echo $_SESSION['fullname']; ?></span>
        </div>
    </nav>
    </nav>

    <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>   