
    <!-- Navigation -->
    <div class="navigation">
        <a class="navbar-brand">
            <img alt="" class="logo vcentered" src="images/logo.png">
            <span class="vcentered"><?php echo $siteowner; ?></span>
            <i class="fa fa-bars text-primary left-nav-toggle pull-right vcentered"></i>
        </a>
        <ul class="nav primary">
            <li>
                <a href="./">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./?fl=prod_lst">
                    <i class="fa fa-medkit"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="./?fl=ordr_lst">
                    <i class="fa fa-book"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="./?fl=cstm_lst">
                    <i class="fa fa-users"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="./?fl=settings">
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>

        <div class="time text-center" style="display: none;">
            <h5 class="current-time2">&nbsp;</h5>
            <h5 class="current-time">&nbsp;</h5>
        </div>
    </div>
    <!-- End of Navigation -->