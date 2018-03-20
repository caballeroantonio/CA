<?php
  if($this->params->get('street_view_show')){
    ?>
    <script type="text/javascript">  
      jQuery( initialize );
      var map;
      var myLatlng=new google.maps.LatLng(<?php
        if ($this->item->hlatitude && $this->item->hlatitude != '')
          echo $this->item->hlatitude;
        else
          echo 0;
        ?>,<?php
        if ($this->item->hlongitude && $this->item->hlongitude != '')
          echo $this->item->hlongitude;
        else
          echo 0;
        ?>);
      var sv = new google.maps.StreetViewService();

      var panorama;
      function initialize(){
        var myOptions = {
            zoom: <?php if ($this->item->map_zoom)
                            echo $this->item->map_zoom;
                        else
                            echo 1;
                        ?>,
            center: myLatlng,
            scrollwheel: false,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        if(document.getElementById("map_canvas") != undefined){
          map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        }
        var imgCatalogPath = "<?php echo $mosConfig_live_site;
         ?>/components/com_realestatemanager/";
  <?php
        $newArr = explode(",", JText::_('_REALESTATE_MANAGER_HOUSE_MARKER'));
        $numPick = '';
        if (isset($newArr[$this->item->property_type])) {
            $numPick = $newArr[$this->item->property_type];
        }
  ?>
        var srcForPic = "<?php echo $numPick; ?>";
        var image = '';
        if(srcForPic.length){
          var image = new google.maps.MarkerImage(imgCatalogPath + srcForPic,
          new google.maps.Size(32, 32),
          new google.maps.Point(0,0),
          new google.maps.Point(16, 32));
        }
        var marker = new google.maps.Marker({ icon: image,position: myLatlng });
        marker.setMap(map);
        var panoramaOptions = {
          position: myLatlng,
          pov: {
            heading: 34,
            pitch: 10
          }
        };
        var streetViewService = new google.maps.StreetViewService();
        var STREETVIEW_MAX_DISTANCE = 50;
        streetViewService.getPanoramaByLocation(myLatlng, STREETVIEW_MAX_DISTANCE, function (streetViewPanoramaData, status) {
          if (status === google.maps.StreetViewStatus.OK) {
            // ok
            var panorama = new google.maps.StreetViewPanorama(document.getElementById('map_pano'), panoramaOptions);
            map.setStreetView(panorama);
          } else {
            document.getElementById('map_pano').style.display = "none";
            // no street view available in this range, or some error occurred
          }
        });

      }
    </script>
    <?php

  }else{

    ?>
<!--    <script type="text/javascript">  

      jQuery( initialize );
      var map;
      var myLatlng=new google.maps.LatLng(<?php
        if ($this->item->hlatitude && $this->item->hlatitude != '')
          echo $this->item->hlatitude;
        else
          echo 0;
        ?>,<?php
        if ($this->item->hlongitude && $this->item->hlongitude != '')
          echo $this->item->hlongitude;
        else
          echo 0;
        ?>); 
      function initialize(){
        var myOptions = {
            zoom: <?php if ($this->item->map_zoom)
                            echo $this->item->map_zoom;
                        else
                            echo 1;
                        ?>,
            center: myLatlng,
            scrollwheel: false,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var imgCatalogPath = "<?php echo $mosConfig_live_site;
         ?>/components/com_realestatemanager/";
  <?php
        $newArr = explode(",", JText::_('_REALESTATE_MANAGER_HOUSE_MARKER'));
        $numPick = '';
        if (isset($newArr[$this->item->property_type])) {
            $numPick = $newArr[$this->item->property_type];
        }
  ?>
        var srcForPic = "<?php echo $numPick; ?>";
        var image = '';
        if(srcForPic.length){
          var image = new google.maps.MarkerImage(imgCatalogPath + srcForPic,
          new google.maps.Size(32, 32),
          new google.maps.Point(0,0),
          new google.maps.Point(16, 32));
        }
        var marker = new google.maps.Marker({ icon: image,position: myLatlng });
        marker.setMap(map);
      }
    </script>-->
    <?php }
