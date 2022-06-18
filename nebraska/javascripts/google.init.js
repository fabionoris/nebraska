(function ($) {
    $(document).ready(function () {
        $(window).load(function () {
            $('.googlemap').each(function () {
                var $this = $(this);
                var m = $this.get(0);
                var loc;
                var myOptions = {
                    zoom: parseInt($this.attr('data-zoom')),
                    center: loc,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(m, myOptions);
                var marker = new google.maps.Marker({
                    position: loc,
                    map: map
                });
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': $this.attr('data-address')}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            });
        });
    });
})(jQuery);