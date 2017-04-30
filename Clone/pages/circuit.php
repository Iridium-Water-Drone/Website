<?php 
include("navbar.php");
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit circuit</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Map</div>
                        <div class="panel-body">

                            <div id="map" class="map" style="height: 100%;"></div>
                  
                            <form class="form-inline" style="visibility: hidden; height: 0px;">
                                <label>Geometry type &nbsp;</label>
                                <select id="type">
                                    <option value="LineString">LineString</option>
                                </select>
                            </form>
                         
                            <p><div name="mouseXY"></div></p>

                            <div class="col-lg-2">
                              <label style="margin-top: 10px;">Select circuit:</label>
                              <br><br>
                              
                            </div>
                            <div class="col-lg-9">
                              <div class="row">
                                <div class="col-lg-11">
                                  <select class="form-control" id="select" style="width: 50%;">
                                    <option>Submarine 1</option>
                                    <option>Submarine 2</option>
                                    <option>Submarine 3</option>
                                    <option>Submarine 4</option>
                                    <option>Submarine 5</option>
                                  </select>   
                                </div>
                                <div class="col-lg-1">
                                  <a href="#" class="btn btn-primary">Submit</a>   
                                </div>
                              </div>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
            

<script>
      var raster = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

      var map = new ol.Map({
        layers: [raster],
        target: 'map',
        view: new ol.View({
          center: ol.proj.transform([10.34, 36.97], 'EPSG:4326', 'EPSG:3857'),
          zoom: 10
        })
      });

      var features = new ol.Collection();
      var featureOverlay = new ol.layer.Vector({
        source: new ol.source.Vector({features: features}),
        style: new ol.style.Style({
          stroke: new ol.style.Stroke({
            color: '#ffcc33',
            width: 4
          })
        })
      });
      featureOverlay.setMap(map);

      var modify = new ol.interaction.Modify({
        features: features,
        // the SHIFT key must be pressed to delete vertices, so
        // that new vertices can be drawn at the same position
        // of existing vertices
        deleteCondition: function(event) {
          return ol.events.condition.shiftKeyOnly(event) &&
              ol.events.condition.singleClick(event);
        }
      });
      map.addInteraction(modify);

      var draw; // global so we can remove it later
      var typeSelect = document.getElementById('type');

      function addInteraction() {
        draw = new ol.interaction.Draw({
          features: features,
          type: /** @type {ol.geom.GeometryType} */ (typeSelect.value)
        });
        map.addInteraction(draw);
      }


      /**
       * Handle change event.
       */
      typeSelect.onchange = function() {
        map.removeInteraction(draw);
        addInteraction();
      };

      addInteraction();

      var mousePosition = new ol.control.MousePosition({
        coordinateFormat: ol.coordinate.createStringXY(2),
        projection: 'EPSG:4326',
        target: document.getElementById('mouseXY'),
        undefinedHTML: '&nbsp;'
      });
      map.addControl(mousePosition);

      console.log(coordinateFormat);

 </script>

            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

</body>