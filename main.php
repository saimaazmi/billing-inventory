

    <!-- Main content-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="panel main-metric no-margin-top">
                                <div class="metric-left">
                                    <div class="metric-panel text-left">
                                        <div class="metric-text">
                                            <h4> Sales this month: </h4>
                                            <h2> Rs.<?php echo getCrrMnthSls(); ?> </h2>
                                        </div>

                                        <div class="progress progress-sm">
                                            <div style="width: 80%" class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <h6> <i class="fa fa-caret-up text-success"></i>  previous month Rs.<?php echo getPrvMnthSls(); ?></h6>
                                    </div>
                                </div>
                                
                                <div class="metric-right">
                                    <i class="fa fa-eye text-success"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="panel metric no-margin-top">
                                <div class="metric-panel no-padding-top" style="min-height: 94px;">
                                    <div class="metrics-text row">
                                        <h5 class="col-xs-12 no-margin-top">
                                            <b class="pull-left">Server 1:</b>
                                            <span class="label label-success pull-right"> 35% Full </span>
                                        </h5>
                                        <h5 class="col-xs-12"> 
                                            <b class="pull-left">Server 2:</b>
                                            <span class="label label-warning pull-right"> 40% Full </span>
                                        </h5>
                                        <h5 class="col-xs-12 no-margin-bottom"> 
                                            <b class="pull-left">Server 3:</b>
                                            <span class="label label-danger pull-right"> 25% Full </span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="metric-footer">
                                    <div class="progress progress-sm progress-striped no-margin active">
                                        <div style="width: 35%" class="progress-bar progress-bar-success">
                                        </div>
                                        <div style="width: 40%" class="progress-bar progress-bar-warning">
                                        </div>
                                        <div style="width: 25%" class="progress-bar progress-bar-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    Sales this month
                                </div>
                                <div class="panel-body">
                                    <div id="area-chart" style="height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-info-outline tabs-panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#dashboard-personal" aria-expanded="true"> Valued Customer </a></li>
                                <li class=""><a data-toggle="tab" href="#dashboard-feed" aria-expanded="false"> Best Sellers </a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <ul class="list-unstyled notifications notifications-panel no-border no-margin-bottom tab-pane active" id="dashboard-personal">
                                <?php
                                    if(count(getValCstm()) > 0)
                                    {
                                        for($i = 0; $i < count(getValCstm()); $i++)
                                        {
                                            echo '<li>';
                                                echo '<span class="fa-stack fa-lg text-danger">';
                                                    echo '<i class="fa fa-circle-thin fa-stack-1x"></i>';
                                                    echo '<i class="fa fa-stack-1x">'.($i+1).'</i>';
                                                echo '</span>';
                                                echo '<div class="notification-title vcentered info-combo"> ';
                                                    echo '<h4 class="no-margin-top"> '.getCstmDtl(getValCstm()[$i])['name'].' </h4>';
                                                    echo '<h6 class="no-margin text-muted"> '.getCstmDtl(getValCstm()[$i])['city'].' </h6>';
                                                echo '</div>';
                                            echo '</li>';
                                        }
                                    }
                                ?>
                            </ul>
                            <ul class="list-unstyled notifications notifications-panel no-border no-margin-bottom tab-pane" id="dashboard-feed">
                                <?php
                                    if(count(getValProd()) > 0)
                                    {
                                        for($i = 0; $i < count(getValProd()); $i++)
                                        {
                                            echo '<li>';
                                                echo '<span class="fa-stack fa-lg">';
                                                    echo '<i class="fa fa-circle-thin fa-stack-1x"></i>';
                                                    echo '<i class="fa fa-stack-1x">'.($i+1).'</i>';
                                                echo '</span>';
                                                echo '<div class="notification-title vcentered info-combo"> ';
                                                    echo '<h4 class="no-margin-top">  </h4>';
                                                    echo '<b class="text-success"> '.getProdDtl(getValProd()[$i]['id'])['name'].'-'.getProdDtl(getValProd()[$i]['id'])['pckg'].' </b> '.getValProd()[$i]['qty'].' sold for '.getValProd()[$i]['amt'].'.';
                                                echo '</div>';
                                            echo '</li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    <!-- End of Main content-->