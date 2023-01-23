

<div class="side-bar">
    <div class="logo-details" title="Admin">

        <span class="logo-name">Admin</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="../admin/dashboard.php" class="<?php echo $dashboard; ?>"title="Dashboard">

                <span class="links-name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="../admin/tenants.php" class="<?php echo $tenants; ?>"title="">

                <span class="links-name">Tenants</span>
            </a>
        </li>
        <li>
            <a href="../admin/landlord.php" class="<?php echo $landlords; ?>"title="#">

                <span class="links-name">Landlords</span>
            </a>
        </li>
        <li>
        <a href="../admin/properties.php" class="<?php echo $properties; ?>"title="#">

                <span class="links-name">Properties</span>
            </a>
        </li>
        <li>
            <a href="../admin/p_units.php" class="<?php echo $p_units; ?>"title="#">

                <span class="links-name">Property Units</span>
            </a>
        </li>
        <li>
            <a href="../lease/lease.php" class="<?php echo $lease; ?>"title="#">

                <span class="links-name">Leases</span>
            </a>
        </li>
        <li>
            <a href="../admin/invoice.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Invoice</span>
            </a>
        </li>
        <li>
            <a href="../admin/reports.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Reports</span>
            </a>
        </li>
        <li>
            <a href="../admin/tickets.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Tickets</span>
            </a>
        </li>
        <li>
            <a href="../admin/c_events.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Calendar Events</span>
            </a>
        </li>
        <li>
            <a href="../admin/m_user.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Manage User</span>
            </a>
        </li>
        <li>
            <a href="../admin/settings.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Settings</span>
            </a>
        </li>
        <li>
            <a href="../admin/terms.php" class="<?php echo $invoice; ?>"title="Setting">

                <span class="links-name">Terms & Condition</span>
            </a>
        </li>



        <hr class="line">
        <li id="logout-link">
            <a class="logout-link" href="../login/logout.php" title="Logout">

                <span class="links-name">Logout</span>
            </a>
        </li>
    </ul>
</div>

<div id="logout-dialog" class="dialog" title="Logout">
    <p><span>Are you sure you want to logout?</span></p>
</div>

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