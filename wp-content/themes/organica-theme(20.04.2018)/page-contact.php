<?php
get_header();
?>

      <div class="shadow-wrap">
            <div class="inner-page-header">
                <div class="wrapper">
                    <ul class="breadcrumbs ">
                        <?php if(function_exists('bcn_display')){bcn_display();}?>
                    </ul>
                    <h1>Контакты</h1>
                </div>
            </div>

            <div class="contacts">
                <div class="address">
                    <?if(get_field('address-contact', 72)):?>
                        <p><strong>Адрес:</strong> <?=get_field('address-contact', 72)?></p>
                    <?endif;?>
                    
                    <ul>
                        <?php

                        global $wp_query;
                        $custom_query = new WP_Query( array( 'post_type' => 'contacts', 'paged' => $paged ) );
                        if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                            <li>
                                <b><? the_title(); ?></b>
                                <?if(get_field('contacts-phone')):?>
                                    <div>тел. <?=get_field('contacts-phone');?></div>
                                <?endif;?>
                                <?if(get_field('contacts-fax')):?>
                                    <div>факс. <?=get_field('contacts-fax');?></div>
                                <?endif;?>
                                 <?if(get_field('contacts-email')):?>
                                    <div><a  href="mailto:<?=get_field('contacts-email');?>"><?=get_field('contacts-email');?></a></div>
                                <?endif;?>
                            </li>
                        <?php endwhile; endif;?>
                       

                        <li style="height: 0;margin: 0;"></li>
                        <li style="height: 0;margin: 0;"></li>
                        <li style="height: 0;margin: 0;"></li>

                    </ul>
                </div>
            </div>

        </div>
        <div id="map"></div>

<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAd1xMYT1bt99qtFWQEzXiRBvORDWHgPtk"></script>
<script type="text/javascript">
    function CustomMarker(latlng, map, args) {
        this.latlng = latlng;
        this.args = args;
        this.setMap(map);
    }

    CustomMarker.prototype = new google.maps.OverlayView();

    CustomMarker.prototype.draw = function() {

        var self = this;

        var div = this.div;

        if (!div) {

            div = this.div = document.createElement('div');

            div.className = 'marker marker-main';

            // div.style.position = 'absolute';
            // div.style.cursor = 'pointer';
            // div.style.width = '30px';
            // div.style.height = '30px';
            // div.style.background = '#e92d44';

            if (typeof(self.args.marker_id) !== 'undefined') {
                div.dataset.marker_id = self.args.marker_id;
            }

//            google.maps.event.addDomListener(div, "click", function(event) {
//                alert('You clicked on a custom marker!');
//                google.maps.event.trigger(self, "click");
//            });

            var panes = this.getPanes();
            panes.overlayImage.appendChild(div);
        }

        var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

        if (point) {
            div.style.left = (point.x - 15) + 'px';
            div.style.top = (point.y - 15) + 'px';
        }
    };

    CustomMarker.prototype.remove = function() {
        if (this.div) {
            this.div.parentNode.removeChild(this.div);
            this.div = null;
        }
    };

    CustomMarker.prototype.getPosition = function() {
        return this.latlng;
    };






    var mapStyles = [
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "saturation": "-25"
            },
            {
                "lightness": "20"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "saturation": "29"
            },
            {
                "hue": "#ffe200"
            },
            {
                "lightness": "47"
            },
            {
                "gamma": "1"
            },
            {
                "weight": "0.35"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "labels",
        "stylers": [
            {
                "hue": "#ff0000"
            },
            {
                "visibility": "on"
            },
            {
                "saturation": "70"
            },
            {
                "lightness": "10"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": "-66"
            },
            {
                "saturation": "-41"
            },
            {
                "weight": "4.06"
            },
            {
                "hue": "#3900ff"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "weight": "6.16"
            },
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "hue": "#ffa400"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#d0e3b4"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.medical",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#fbd3da"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#bde6ab"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffe15f"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#efd151"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "black"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#cfb2db"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#a2daf2"
            }
        ]
    }
]





    function initialize() {
        var icon = document.getElementById('map').getAttribute('data-marker');
        var marker_crd = {lat: 53.788233, lng: 87.247792};
        var myLatlng = new google.maps.LatLng( 53.788233, 87.247792);
        var mapOptions = {
            clickableIcons: false,
            disableDefaultUI: false,
            disableDoubleClickZoom: true,
            draggable: true,
            scrollwheel: false,
            styles: mapStyles,
            zoom: 13,
            minZoom: 10,
            mapTypeControl: false,
            streetViewControl: false,
            center: myLatlng,
        }

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        // var marker = new google.maps.Marker({
        //     position: {lat: 53.761371, lng: 87.099428},
        //     map: map,
        //     icon: document.getElementById('map').getAttribute('data-marker')
        // });
        overlay = new CustomMarker(
            myLatlng,
            map,
            {
                marker_id: '123',
            }
        );


        //    google.maps.event.addListener(map, 'zoom_changed', function(){
        //       map.panTo(new google.maps.LatLng(marker_crd));
        // });

        $(window).on('load resize orienationchange', function() {
            var marker_crd = {lat: 53.788233, lng: 87.247792};
//            if(window.matchMedia('(max-width: 1200px)').matches){
//                var lat = 53.788233;
//                var lng = 87.247792;
//                var lng = lng+0.002;
//                var marker_crd = {lat: lat, lng: lng};
//            }
            map.panTo(new google.maps.LatLng(marker_crd));
        });


    }


    $(document).ready(function() {
        initialize();
    });



</script>
<?php
get_footer();
