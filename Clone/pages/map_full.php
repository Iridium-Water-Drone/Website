<script>
      var raster = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

        var map = new ol.Map({
            layers: [raster],
            target: 'map',
            view: new ol.View({
            center: ol.proj.transform([10.34, 36.97], 'EPSG:4326', 'EPSG:3857'),
            zoom: 8
            })
        });

        var checkpointsSource = new ol.source.Vector({
            //create empty vector
        });

        var floodsSource = new ol.source.Vector({
            //create empty vector
        });

        var floodsWarningSource = new ol.source.Vector({
            //create empty vector
        });


        var markers = [];
        var markers2 = [];
        var markers3 = [];

        function AddMarkers2() {
            $x = 10.31;
            $z = 36.92;

            var iconFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform([$x,$z], 'EPSG:4326',   'EPSG:3857')),
                    name: 'FloodMarker 0'
                });
            markers2[0]= ol.proj.transform([$x,$z], 'EPSG:4326',   'EPSG:3857');
            floodsSource.addFeature(iconFeature);


            var FloodIcon = new ol.style.Style({
                image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 1],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'fraction',
                    opacity: 1,
                    src: 'img/Icon2.png'
                }))
            });

            var FloodLayer = new ol.layer.Vector({
                source: floodsSource,
                style: FloodIcon
            });
            return FloodLayer;
        }

        function AddMarkers3() {
            $x = 10.31;
            $z = 36.82;

            var iconFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform([$x,$z], 'EPSG:4326',   'EPSG:3857')),
                    name: 'FloodWarningMarker 0'
                });
            markers2[0]= ol.proj.transform([$x,$z], 'EPSG:4326',   'EPSG:3857');
            floodsWarningSource.addFeature(iconFeature);


            var FloodWarningIcon = new ol.style.Style({
                image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 1],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'fraction',
                    opacity: 1,
                    src: 'img/Icon3.png'
                }))
            });

            var FloodWarningLayer = new ol.layer.Vector({
                source: floodsWarningSource,
                style: FloodWarningIcon
            });
            return FloodWarningLayer;
        }
    
        function AddMarkers() {
            //create a bunch of icons and add to source vector
            
            <?php

            //TODO CLEAN UP
            $i = 0;

            $x_def = 0;
            $z_def = 0;

            $result = mysqli_query($db, "SELECT * FROM circuit");

            while($row = mysqli_fetch_array($result)) {
                $x = $row['x'];
                $z = $row['z'];
                $id = $row['id'];

                if($i == 0)
                {
                   $x_def = $x;
                   $z_def = $z;  
                }
                $i++;

                echo "
                    var iconFeature = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([$x,$z], 'EPSG:4326',   'EPSG:3857')),
                        name: 'Checkpoint $id'
                    });
                    markers[$id]= ol.proj.transform([$x,$z], 'EPSG:4326',   'EPSG:3857');
                    checkpointsSource.addFeature(iconFeature);
                ";
            }

            //Close the loop
            echo "
                    var iconFeature = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([$x_def,$z_def], 'EPSG:4326',   'EPSG:3857')),
                        name: 'Checkpoint $i'
                    });
                    markers[$i]= ol.proj.transform([$x_def,$z_def], 'EPSG:4326',   'EPSG:3857');
            ";

            ?>


            //create the style
            var CheckPointIcon = new ol.style.Style({
                image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 1],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'fraction',
                    opacity: 1,
                    src: 'img/Icon1.png'
                }))
            });


            var CheckpointsLayer = new ol.layer.Vector({
                source: checkpointsSource,
                style: CheckPointIcon
            });
            return CheckpointsLayer;
        }

        var layerCheckpoints = AddMarkers();
        var layerFloods = AddMarkers2();
        var layerWarningFloods = AddMarkers3();
        map.addLayer(layerFloods);
        map.addLayer(layerWarningFloods);

        var layerLines = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [new ol.Feature({
                    geometry: new ol.geom.LineString(markers, 'XY'),
                    name: 'Line'
                })]
            })
        });


        map.addLayer(layerCheckpoints);
        map.addLayer(layerLines);


        greenSource = new ol.source.Vector();
        redSource = new ol.source.Vector();
        yellowSource = new ol.source.Vector();

        precisionCircle = ol.geom.Polygon.circular(new ol.Sphere(6378137), [10.20, 38.2323780468158], 20000, 64).transform('EPSG:4326', 'EPSG:3857');
        precisionCircleFeature = new ol.Feature(precisionCircle)
        greenSource.addFeature(precisionCircleFeature);

        precisionCircle = ol.geom.Polygon.circular(new ol.Sphere(6378137), [10.25, 37.4323780468158], 18000, 64).transform('EPSG:4326', 'EPSG:3857');
        precisionCircleFeature = new ol.Feature(precisionCircle)
        yellowSource.addFeature(precisionCircleFeature);

        precisionCircle = ol.geom.Polygon.circular(new ol.Sphere(6378137), [10.8, 37.3523780468158], 15000, 64).transform('EPSG:4326', 'EPSG:3857');
        precisionCircleFeature = new ol.Feature(precisionCircle)
        redSource.addFeature(precisionCircleFeature);

        precisionCircle = ol.geom.Polygon.circular(new ol.Sphere(6378137), [10.55, 37.0523780468158], 10000, 64).transform('EPSG:4326', 'EPSG:3857');
        precisionCircleFeature = new ol.Feature(precisionCircle)
        greenSource.addFeature(precisionCircleFeature);


        layer = new ol.layer.Vector({
            source: redSource,
            style: [
                new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'red',
                        width: 3
                    }),
                    fill: new ol.style.Fill({
                        color: 'rgba(255, 0, 0, 0.1)'
                    })
                })]
        });
        map.addLayer(layer);

        layer02 = new ol.layer.Vector({
            source: yellowSource,
            style: [
                new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'yellow',
                        width: 3
                    }),
                    fill: new ol.style.Fill({
                        color: 'rgba(255, 255, 0, 0.1)'
                    })
                })]
        });
        map.addLayer(layer02);

        layer03 = new ol.layer.Vector({
            source: greenSource,
            style: [
                new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'green',
                        width: 3
                    }),
                    fill: new ol.style.Fill({
                        color: 'rgba(0, 255, 0, 0.1)'
                    })
                })]
        });
        map.addLayer(layer03);
 </script>
