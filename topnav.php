

    <!-- Header -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div id="navbar" class="navbar-collapse">
                <ul class="breadcrumb">
                    <li class="breadcrumb-home"><a href=""><i class="fa fa-home"></i></a>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!--<li>
                        <form class="search-form form-group has-feedback">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search...">
                        </form> 
                    </li>-->
                    <li class="dropdown" id="notifications-toggle">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">
                            <i class="fa fa-bell"></i>
                            <?php
                                if(count(getLowStock()) > 0)
                                {
                                    echo '<span class="label label-danger notification-label">'.count(getLowStock()).'</span>';
                                }
                            ?>
                        </a>
                        <ul class="list-unstyled notifications dropdown-menu">
                            <?php
                                if(count(getLowStock()) > 0)
                                {
                                    for($i = 0; $i < count(getLowStock()); $i++)
                                    {
                                        echo '<li>';
                                            echo '<i class="fa fa-plus-square small-icon text-center vcentered"></i>';
                                            echo '<span class="notification-title vcentered"> ';
                                                echo '<b> '.getProdDtl(getLowStock()[$i])['name'].' </b> '.getProdDtl(getLowStock()[$i])['pckg'].' low stock.';
                                            echo '</span>';
                                            echo '<span class="notification-time text-muted">  '.getProdDtl(getLowStock()[$i])['stkqty'].' left</span>';
                                        echo '</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                    <li class="profile">
                        <a>
                            <img alt="" src="images/profile.png" class="img-circle">
                            <div class="vcentered">
                                <p class="profile-name">Admin's</p>
                                <p class="profile-position">Control Panel</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Header -->