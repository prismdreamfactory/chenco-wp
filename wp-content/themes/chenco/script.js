"use strict";function debounced(n,o){var s=void 0;return function(){for(var e=arguments.length,t=Array(e),a=0;a<e;a++)t[a]=arguments[a];s&&clearTimeout(s),s=setTimeout(function(){o.apply(void 0,t),s=null},n)}}function getParameterByName(e){return decodeURIComponent((new RegExp("[?|&]"+e+"=([^&;]+?)(&|#|;|$)").exec(location.search)||[,""])[1].replace(/\+/g,"%20"))||null}!function(c){function e(){var e=getParameterByName("tab");c(".tabs").length&&c("[data-tab]").on("click",function(e){c(this).addClass("active").siblings("[data-tab]").removeClass("active"),c(".tab-container").find("[data-content="+c(this).data("tab")+"]").addClass("active").siblings("[data-content]").removeClass("active"),e.preventDefault()}),c(".tabs--firm").length&&c("[data-tab]").on("click",function(e){1===c(this).data("tab")?c(this).parent().removeClass("tabs-nav--alt"):2===c(this).data("tab")?(c(this).parent().addClass("tabs-nav--alt"),c(".edge__circle").each(function(e){var t=c(this).find(".edge__circle-number"),a=t.html();t.countTo({from:0,to:a,speed:500,refreshInterval:50,onUpdate:function(){console.debug(this)},onComplete:function(){console.debug(this)}})})):c(this).parent().addClass("tabs-nav--alt")}),c("[data-tab-name="+e+"]").trigger("click")}c(window),c("#page");var d={usa:[38.901187,-110.914306],asia:[28.441223,-238.391588],global:[40.141496,-168.588005]};function t(e){var t=c("#map"),n=(c(".marker"),c(".marker[data-current=1]")),o=c(".marker[data-current=0]"),a=[39.901187,-96.613168],s=c(window).width()<=768?{minZoom:2,maxZoom:9,zoom:3,center:new google.maps.LatLng(a[0],a[1]),mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:!1,streetViewControl:!1,zoomControl:!0,styles:e}:{minZoom:4,maxZoom:9,zoom:5,center:new google.maps.LatLng(a[0],a[1]),mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:!1,zoomControl:!0,streetViewControl:!1,styles:e},i=new google.maps.Map(t[0],s);i.markers=[],g(n,i),function(a){var n=c(".map__tab");c(".map__legend-region");n.each(function(){var t=this;c(this).on("click",function(){var e=c(t).data("center");"asia"===e?c(".map__legend").hide():c(".map__legend").show(),n.removeClass("mod--active"),c(t).addClass("mod--active"),"global"===e?a.setZoom(3):a.setZoom(5),a.setCenter(new google.maps.LatLng(d[e][0],d[e][1]))})})}(i);var r=[0,0,0,0],l=c(".map__switch-item");return l.each(function(){var t=c(this),a=t.data("current");t.on("click",function(){l.removeClass("mod--active"),t.addClass("mod--active");for(var e=0;e<i.markers.length;e++)i.markers[e].setMap(null);i.markers=[],g(a?n:o,i),m(i,r)})}),i.addListener("bounds_changed",debounced(200,function(){return m(i,r)})),i}function m(e,n){n=[0,0,0,0];for(var t=0;t<e.markers.length;t++)if(e.getBounds().contains(e.markers[t].getPosition()))for(var a=0;a<n.length;a++)n[a]+=Number(e.markers[t].title.split(",")[a]);c(".map__legend-row span:first-child i").each(function(e){var t=c(this),a=parseFloat(t.text().replace(/,/g,""));t.html()!==n[e]&&t.countTo({from:a,to:n[e],speed:500,refreshInterval:50,formatter:function(e,t){return e=(e=e.toFixed(t.decimals)).replace(/\B(?=(\d{3})+(?!\d))/g,",")},onUpdate:function(){console.debug(this)},onComplete:function(){console.debug(this)}})})}function g(e,t){var a=new google.maps.InfoWindow({maxWidth:400});e.each(function(){!function(e,t,a){function n(e,t){return'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="'+t+'" height="'+t+'" viewBox="0 0 '+t+" "+t+'"><circle cx="'+t/2+'" cy="'+t/2+'" r="'+t/2+'" fill="'+e+'"/></svg>'}var o=new google.maps.LatLng(e.data("lat"),e.data("lng")),s=e.data("type").toLowerCase(),i={office:"rgb(37, 79, 123)",multifamily:"rgb(191, 144, 1)",land:"rgb(87, 135, 171)",industrial:"rgb(121, 175, 153)"},r=new google.maps.Marker({position:o,map:t,icon:c(window).width()<=768?n(i[s],10):n(i[s],14),title:e.data("stats").toString()});t.markers.push(r),e.html()&&(google.maps.event.addListener(t,"click",function(e){a.close()}),r.addListener("click",function(){a.setContent(e.html()),a.open(t,r)}))}(c(this),t,a)})}c(function(){c("a.login-link").on("click",function(e){var t=c("div.login-modal").data("modal");t&&0<t.length&&(e.preventDefault(),t.reveal({modalbgclass:"lwa-modal-bg",dismissmodalclass:"lwa-modal-close"}))}),e(),c(".slick").length&&c(".slick").slick({autoplay:!0,autoplaySpeed:6e3,pauseOnHover:!1,dots:!0,arrows:!0,infinite:!0,slidesToShow:1,prevArrow:c(".slick--prev"),nextArrow:c(".slick--next")}),c(".partners__toggle").change(function(e){e.preventDefault(),c(".tabs").removeClass("active"),c(".tab-container").removeClass("active"),c(".tabs--"+c(this).val()).addClass("active"),c(".tab-container--"+c(this).val()).addClass("active")}),c("select").select2({minimumResultsForSearch:"Infinity"}),c("#map").length&&c.getJSON("/wp-content/themes/chenco/js/map-styles.json",function(e){t(e)}),c("body").hasClass("touch")})}(jQuery);