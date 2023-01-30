<div class="side-bar">
<div class="logo-details">
        <span class="logo-name"></span>
        <i class='bx bx-menu'></i>
    </div>
    <ul class="nav-links">
        <li>
            <a href="../admin/dashboard.php" class="<?php echo $dashboard; ?>"title="Dashboard">

            <i class='bx bxs-widget'></i>    
            <span class="links-name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="../tenants/tenants.php" class="<?php echo $tenants; ?>"title="Tenants">
            <i class='bx bx-user'></i>
                <span class="links-name">Tenants</span>
            </a>
        </li>
        <li>
            <a href='../landlord/landlord.php' class="<?php echo $landlord; ?>"title="landlord">
            <i class='bx bxs-user-rectangle' ></i>
                <span class="links-name">Landlords</span>
            </a>
        </li>
        <li>
        <a href="../properties/properties.php" class="<?php echo $properties; ?>"title="properties">

        <i class='bx bx-building-house'></i>        
        <span class="links-name">Properties</span>
            </a>
        </li>
        <li>
            <a href="../p_units/p_units.php" class="<?php echo $p_units; ?>"title="#">
            <i class='bx bx-home-alt-2'></i>
                <span class="links-name">Property Units</span>
            </a>
        </li>
        <li>
            <a href="../leases/leases.php" class="<?php echo $leases; ?>"title="#">

            <i class='bx bxs-key'></i>
            <span class="links-name">Leases</span>
            </a>
        </li>
        <li>
            <a href="../invoice/invoice.php" class="<?php echo $invoice; ?>"title="Setting">

            <i class='bx bxs-book-content'></i> 
            <span class="links-name">Invoice</span>
            </a>
        </li>
        <li>
            <a href="../reports/reports.php" class="<?php echo $reports; ?>"title="Setting">

            <i class='bx bxs-objects-vertical-bottom'></i>
            <span class="links-name">Reports</span>
            </a>
        </li>
        <li>
            <a href="../tickets/tickets.php" class="<?php echo $tickets; ?>"title="Setting">

            <i class='bx bxs-rename'></i>
            <span class="links-name">Tickets</span>
            </a>
        </li>
        <li>
            <a href="../c_events/c_events.php" class="<?php echo $c_events; ?>"title="Setting">
            <i class='bx bx-calendar'></i>
                <span class="links-name">Calendar Events</span>
            </a>
        </li>
        <li>
            <a href="../m_user/m_user.php" class="<?php echo $m_user; ?>"title="Setting">
            <i class='bx bx-user-plus' ></i>
                <span class="links-name">Manage User</span>
            </a>
        </li>
        <li>
            <a href="../setting/settings.php" class="<?php echo $settings; ?>"title="Setting">
            <i class='bx bx-cog'></i>
                <span class="links-name">Settings</span>
            </a>
        </li>
        <li>
            <a href="../terms/terms.php" class="<?php echo $terms; ?>"title="Setting">
            <i class='bx bxs-book-bookmark'></i>
                <span class="links-name">Terms & Condition</span>
            </a>
        </li>


        <li id="logout-link">
            <a class="logout-link" href="../../login/logout.php" title="Logout">
            <i class='bx bx-log-out'></i>
                <span class="links-name">Logout</span>
            </a>
        </li>
    </ul>
</div>

<!--<div id="logout-dialog" class="dialog" title="Logout">
    <p><span>Are you sure you want to logout?</span></p>
</div>-->

<script>
    $(document).ready(function() {
        $("#logout-dialog").dialog({
            resizable: false,
            draggable: false,
            height: "auto",
            width: 400,
            modal: true,
            autoOpen: false
        });
        $(".logout-link").on('click', function(e) {
            e.preventDefault();
            var theHREF = $(this).attr("href");

            $("#logout-dialog").dialog('option', 'buttons', {
                "Yes" : function() {
                    window.location.href = theHREF;
                },
                "No" : function() {
                    $(this).dialog("close");
                }
            });

            $("#logout-dialog").dialog("open");
        });
    });
</script>