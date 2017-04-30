<?php 
include("navbar.php");
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data map</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Map</div>
                        <div class="panel-body">
                            <div id="map" class="map" style="height: 100%;"></div>    
                            <br>
                            <br>

                            <h3>Data description:</h3>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Clean water</label>
                                        </div>    
                                        <div class="col-lg-6" style="text-align: right;">    
                                            <label>Dirty water</label>
                                        </div>
                                    </div>
                                    <div style="height: 10px; width: 100%; background: linear-gradient(-90deg, red, green);"></div>                               
                                    <br>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <img src="img/Icon1.png" />
                                                <label>Checkpoints</label>
                                            </div>  
                                            <div class="col-lg-5">
                                                <img src="img/Icon3.png" />
                                                <label>Possible flood zones</label>
                                            </div>  
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <img src="img/Icon2.png" />
                                                <label>Flood zones</label>
                                            </div>  
                                        </div>
                                    </div>
                                </div>    
                            </div>    
                        </div>
                    </div>
                </div>
            </div>

<?php 
include("map_full.php")
?>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

</body>