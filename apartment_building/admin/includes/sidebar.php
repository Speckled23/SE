<div class="sidebar">
      <ul class="nav-links">
        <li>
          <a href="../admin/dashboard.php" class="active">
            <i class='bx bx-grid-alt box' title="Dashboard"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../tenants/tenants.php" >
            <i class='bx bx-user box' title="Tenant"></i>
            <span class="links_name">Tenants</span>
          </a>
        </li>
        <li>
          <a href="../landlord/landlord.php">
            <i class='bx bxs-user-rectangle box' title="Landlord" ></i>
            <span class="links_name">Landlord</span>
          </a>
        </li>
        <li>
          <a href="../properties/properties.php">
            <i class='bx bx-building-house box' title="Properties"></i>
            <span class="links_name">Properties</span>
          </a>
        </li>
        <li>
          <a href="../p_units/p_units.php">
            <i class='bx bx-home-alt-2 box' title="Property Units"></i>
            <span class="links_name">Property Units</span>
          </a>
        </li>
        <li>
          <a href="../lease/lease.php">
            <i class='bx bxs-key box' title="Leases"></i>
            <span class="links_name">Leases</span>
          </a>
        </li>
        <li>
          <a href="../admin/invoice.php">
            <i class='bx bxs-book-content box' title="Invoice"></i>
            <span class="links_name">Invoice</span>
          </a>
        </li>
        <li>
          <a href="../admin/reports.php">
            <i class='bx bxs-objects-vertical-bottom box' title="Reports"></i>
            <span class="links_name">Reports</span>
          </a>
        </li>
        <li>
          <a href="../admin/tickets.php">
            <i class='bx bxs-rename box' title="Penalties"></i>
            <span class="links_name">Penalties</span>
          </a>
        </li>
         <li>
          <a href="../admin/c_events.php">
            <i class='bx bx-calendar box' title="Calendar Events"></i>
            <span class="links_name">Calendar Events</span>
          </a>
        </li>
         <li>
          <a href="../admin/m_user.php">
            <i class='bx bx-user-plus box' title="Manage Users" ></i>
            <span class="links_name">Manage User</span>
          </a>
        </li>
         <li>
          <a href="../admin/settings.php">
            <i class='bx bx-cog box' title="Settings"></i>
            <span class="links_name">Settings</span>
          </a>
        </li>
        <li>
          <a href="../admin/terms.php">
            <i class='bx bxs-book-bookmark box' title="Terms and Condition"></i>
            <span class="links_name">Terms and Condition</span>
          </a>
        </li>

        <li class="log_out">
          <a href="../../index.php">
            <i class='bx bx-log-out box' title="Logout"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
      </div>
</nav>
</section>

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

