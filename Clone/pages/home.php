<?php 
include("navbar.php");
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Map preview</div>
                        <div class="panel-body">
                            <div id="map" class="map" style="height: 200px;"></div>
                        </div>
                    </div>
                </div>
            </div>

<?php 
include("map_full.php")
?>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Last checkpoints water status
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            //TODO: Clean up
                            include("./inc/chartsql.php") 
                        ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>                   
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?php 
                                    $result = mysqli_query($db,"SELECT * FROM notifications ORDER BY id");  
                                    $i = 1; 
                                    $max_i = 8;
                                    while($row = mysqli_fetch_array($result)) {
                                        $i++;
                                        echo "
                                            <a href='#' class='list-group-item'>
                                            <i class='fa ".getNotificationTypeIcon($row['id'], $db). " fa-fw'></i> ".$row['title'].
                                            "<span class='pull-right text-muted small'><em>".getNotificationDate($row['id'], $db)."</em>
                                            </span>
                                            </a>
                                        ";
                                        if($i > $max_i) return;
                                    }
                                ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

</body>