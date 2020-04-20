function debounced(delay, fn) {
  let timerId;
  return function (...args) {
    if (timerId) {
      clearTimeout(timerId);
    }
    timerId = setTimeout(() => {
      fn(...args);
      timerId = null;
    }, delay);
  };
}

function getParameterByName(name) {
  return (
    decodeURIComponent(
      (new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [
        ,
        '',
      ])[1].replace(/\+/g, '%20')
    ) || null
  );
}

($ => {
  const $window = $(window);
  const $page = $('#page');

  const openLinksInNewTab = () => {
    $('a')
      .filter('[href^="http"], [href^="//"]')
      .not('[href*="' + window.location.host + '"]')
      .attr('rel', 'noopener noreferrer')
      .attr('target', '_blank');
  };

  const initSlider = () => {
    if ($('.slick').length) {
      $('.slick').slick({
        dots: false,
        arrows: true,
        infinite: false,
        slidesToShow: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }
  };

  const ourFirm = () => {
    const $edgeCircles = $('.edge__circle');

    $edgeCircles.each(function (index) {
      const $number = $(this).find('.edge__circle-number');
      const countToNumber = $number.html();

      $number.countTo({
        from: 0,
        to: countToNumber,
        speed: 500,
        refreshInterval: 50,
        // formatter: function(value, options) {
        //   value = value.toFixed(options.decimals);
        //   value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        //   return value;
        // },
        onUpdate: function (value) {
          console.debug(this);
        },
        onComplete: function (value) {
          console.debug(this);
        },
      });
    });
  };

  const initTabs = () => {
    // get url parameter to select active tab
    const activeTab = getParameterByName('tab');
    const $tabs = $('.tabs');

    if ($tabs.length) {
      $('[data-tab]').on('click', function (e) {
        $(this).addClass('active').siblings('[data-tab]').removeClass('active');
        $('.tab-container')
          .find('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');

        e.preventDefault();
      });
    }

    if ($('.tabs--firm').length) {
      $('[data-tab]').on('click', function (e) {
        if ($(this).data('tab') === 1) {
          $(this).parent().removeClass('tabs-nav--alt');
        } else if ($(this).data('tab') === 2) {
          $(this).parent().addClass('tabs-nav--alt');

          ourFirm();
        } else {
          $(this).parent().addClass('tabs-nav--alt');
        }
      });
    }

    $('[data-tab-name=' + activeTab + ']').trigger('click');

    // $('[data-tab=2]').trigger('click');
  };

  const partnersToggle = () => {
    $('.partners__toggle').change(function (e) {
      e.preventDefault();

      $('.tabs').removeClass('active');
      $('.tab-container').removeClass('active');

      if ($(this).val() === 'US') {
        $('.tabs--us').addClass('active');
        $('.tab-container--us').addClass('active');
      }
      if ($(this).val() === 'Asia') {
        $('.tabs--asia').addClass('active');
        $('.tab-container--asia').addClass('active');
      }
    });
  };

  /**
   * Login Modal
   */
  const loginModal = () => {
    $('a.login-link').on('click', function (e) {
      const target = $('div.login-modal').data('modal');

      if (target && target.length > 0) {
        e.preventDefault();

        // $('body').css('overflow', 'hidden');

        target.reveal({
          modalbgclass: 'lwa-modal-bg',
          dismissmodalclass: 'lwa-modal-close',
        });

        // $('a.lwa-modal-close', '.lwa-modal-bg').on('click', function(e) {
        //   $('body').css('overflow', 'auto');
        // });
      }
    });
  };

  /**
   * Google map jQuery selectors and coordinates
   */
  const center = {
    usa: [38.901187, -110.914306],
    asia: [28.441223, -238.391588],
    global: [40.141496, -168.588005],
  };
  const regions = {
    Northern_California: {
      coords: [37.481569, -122.19576],
      zoom: 8,
    },
    Southern_California: {
      coords: [33.155, -118.033081],
      zoom: 8,
    },
    Hawaii: {
      coords: [31.906707, -132.501246],
      zoom: 6,
      coordsAlt: [21.289373, -157.91748],
    },
    South: {
      coords: [30.705239, -98.67815],
      zoom: 7,
    },
    Mountain: {
      coords: [39.05847, -105.706326],
      zoom: 7,
    },
    Midwest: {
      coords: [41.65778, -90.853814],
      zoom: 8,
    },
    Southeast: {
      coords: [28.082342, -82.767718],
      zoom: 7,
    },
    Northeast: {
      coords: [40.56669, -76.621757],
      zoom: 7,
    },
  };
  const countryNames = {
    usa: 'United States',
    global: 'Global',
    asia: 'Asia',
  };

  /*
   *  newMap
   *
   *  This function will render a Google Map onto the selected jQuery element
   *
   *  @return	n/a
   */

  function newMap(styles) {
    const $el = $('#map');
    const $markers = $('.marker');
    const $currentMarkers = $(`.marker[data-current=1]`);
    const $historicalMarkers = $(`.marker[data-current=0]`);

    const args =
      $(window).width() <= 768
        ? {
            minZoom: 2,
            maxZoom: 9,
            zoom: 2,
            center: new google.maps.LatLng(center['usa'][0], center['usa'][1]),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            streetViewControl: false,
            // disableDefaultUI: true,
            styles,
          }
        : {
            minZoom: 3,
            maxZoom: 9,
            zoom: 3,
            center: new google.maps.LatLng(center['global'][0], center['global'][1]),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            streetViewControl: false,
            // disableDefaultUI: true,
            styles,
          };

    // Create map
    const map = new google.maps.Map($el[0], args);

    // Add a markers reference
    map.markers = [];

    // Initial marker load
    addMarkers($currentMarkers, map);

    initLocationTabs(map);

    const legendStats = [0, 0, 0, 0];

    // Switch between current/historical
    const $options = $('.map__switch-item');
    $options.each(function () {
      const $this = $(this);
      const showCurrent = $this.data('current');

      $this.on('click', function () {
        $options.removeClass('mod--active');
        $this.addClass('mod--active');

        for (let i = 0; i < map.markers.length; i++) {
          map.markers[i].setMap(null);
        }

        map.markers = [];

        showCurrent ? addMarkers($currentMarkers, map) : addMarkers($historicalMarkers, map);
        calculateLegend(map, legendStats);
      });
    });

    /* zoom event */
    // google.maps.event.addListener(map, 'zoom_changed', function() {
    //   let zoomLevel = map.getZoom();

    //   console.log(zoomLevel);

    //   // Remove markers
    //   for (let i = 0; i < map.markers.length; i++) {
    //     // google.maps.event.clearListeners(map.markers);
    //     map.markers[i].setMap(null);
    //   }
    //   map.markers = [];

    //   if (zoomLevel === 5) {
    //     for (let region in regions) {
    //       const coordinates = regions[region]['coords'];
    //       const zoom = regions[region]['zoom'];

    //       const marker = new google.maps.Marker({
    //         position: new google.maps.LatLng(coordinates[0], coordinates[1]),
    //         map: map,
    //         icon: `${document.location.origin}/wp-content/themes/chenco/assets/${region}_I.png`
    //       });

    //       // add to array
    //       map.markers.push(marker);

    //       google.maps.event.addListener(marker, 'mouseover', function() {
    //         marker.setIcon(
    //           `${document.location.origin}/wp-content/themes/chenco/assets/${region}_A.png`
    //         );
    //       });

    //       google.maps.event.addListener(marker, 'mouseout', function() {
    //         marker.setIcon(
    //           `${document.location.origin}/wp-content/themes/chenco/assets/${region}_I.png`
    //         );
    //       });

    //       google.maps.event.addListener(marker, 'click', function() {
    //         !regions[region]['coordsAlt']
    //           ? map.setCenter(new google.maps.LatLng(coordinates[0], coordinates[1]))
    //           : map.setCenter(
    //               new google.maps.LatLng(
    //                 regions[region]['coordsAlt'][0],
    //                 regions[region]['coordsAlt'][1]
    //               )
    //             );
    //         map.setZoom(zoom);
    //       });
    //     }
    //   } else {
    //     addMarkers($currentMarkers, map);
    //   }
    // });

    map.addListener(
      'bounds_changed',
      debounced(200, () => {
        // if (map.getZoom() > 5) {
        return calculateLegend(map, legendStats);
        // }
      })
    );

    return map;
  }

  /*
   * Grab marker data using title field and calculate legend
   * [office sqft, units, acres, ind sqft]
   */
  function calculateLegend(map, legendStats) {
    legendStats = [0, 0, 0, 0];

    for (let i = 0; i < map.markers.length; i++) {
      if (map.getBounds().contains(map.markers[i].getPosition())) {
        for (let j = 0; j < legendStats.length; j++) {
          legendStats[j] += Number(map.markers[i].title.split(',')[j]);
        }
      }
    }

    // Update legend values
    const $legendRows = $('.map__legend-row span:first-child i');
    $legendRows.each(function (index) {
      const $this = $(this);
      const currentStat = parseFloat($this.text().replace(/,/g, ''));

      // animate count up when statistic changes based on map bounds
      if ($this.html() !== legendStats[index]) {
        $this.countTo({
          from: currentStat,
          to: legendStats[index],
          speed: 500,
          refreshInterval: 50,
          formatter: function (value, options) {
            value = value.toFixed(options.decimals);
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return value;
          },
          onUpdate: function (value) {
            console.debug(this);
          },
          onComplete: function (value) {
            console.debug(this);
          },
        });
      }

      // $(this).text(legendStats[index].toLocaleString('en'));
    });
  }

  // function removeMarkers(markers) {

  // }

  /*
   *  addMarkers
   *
   *  This function will add markers
   *
   *  @param	$marker (jQuery element)
   *  @param	map (Google Map object)
   *  @return	n/a
   */
  function addMarkers($markers, map) {
    const infowindow = new google.maps.InfoWindow({
      maxWidth: 400,
    });

    $markers.each(function () {
      const $this = $(this);
      addMarker($this, map, infowindow);
    });
  }

  /*
   *  addMarker
   *
   *  This function will add a marker to the selected Google Map
   *
   *  @param	$marker (jQuery element)
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function addMarker($marker, map, infowindow) {
    const latlng = new google.maps.LatLng($marker.data('lat'), $marker.data('lng'));
    const type = $marker.data('type').toLowerCase();

    // custom marker icon colors for each asset type
    const icons = {
      office: 'rgb(37, 79, 123)',
      multifamily: 'rgb(191, 144, 1)',
      land: 'rgb(87, 135, 171)',
      industrial: 'rgb(121, 175, 153)',
    };

    // marker svg allowing options
    const createMarker = (color, size) => {
      const svg = `data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}" viewBox="0 0 ${size} ${size}"><circle cx="${
        size / 2
      }" cy="${size / 2}" r="${size / 2}" fill="${color}"/></svg>`;

      return svg;
    };

    // create marker
    const marker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon:
        $(window).width() <= 768 ? createMarker(icons[type], 10) : createMarker(icons[type], 14),
      title: $marker.data('stats').toString(),
    });

    // add to array
    map.markers.push(marker);

    // if marker contains HTML, add it to an infoWindow
    if ($marker.html()) {
      // show info window when marker is clicked
      // google.maps.event.addListener(marker, 'click', function() {
      //   infowindow.setContent($marker.html());
      //   infowindow.open(map, marker);
      // });

      google.maps.event.addListener(map, 'click', function (event) {
        infowindow.close();
      });

      marker.addListener('click', function () {
        infowindow.setContent($marker.html());
        infowindow.open(map, marker);
      });
    }
  }

  /*
   *  centerMap
   *
   *  This function will center the map, showing all markers attached to this map
   *
   *  @param	map (Google Map object)
   *  @return	n/a
   */
  // function centerMap(map) {
  // const bounds = new google.maps.LatLngBounds();
  // loop through all markers and create bounds
  // $.each(map.markers, function(i, marker) {
  //   const latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
  //   bounds.extend(latlng);
  // });
  // const markerCluster = new MarkerClusterer(map, map.markers, {
  //   imagePath:
  //     'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
  // });
  // }

  /* Top location tabs to recenter map */
  function initLocationTabs(map) {
    const $tabs = $('.map__tab');
    const $region = $('.map__legend-region');

    $tabs.each(function () {
      $(this).on('click', () => {
        let country = $(this).data('center');

        country === 'asia' ? $('.map__legend').hide() : $('.map__legend').show();

        $tabs.removeClass('mod--active');
        $(this).addClass('mod--active');

        // $region.text(countryNames[country]);

        country === 'global' ? map.setZoom(3) : map.setZoom(5);
        map.setCenter(new google.maps.LatLng(center[country][0], center[country][1]));
      });
    });
  }

  // on document ready
  $(() => {
    // initialize functions
    loginModal();
    initTabs();
    initSlider();
    partnersToggle();

    $('select').select2({
      // width: 'resolve',
      minimumResultsForSearch: 'Infinity',
    });

    if ($('#map').length) {
      $.getJSON('/wp-content/themes/chenco/js/map-styles.json', json => {
        newMap(json);
      });
    }

    $('body, html').animate({ scrollTop: 0 }, 0);

    if ($('body').hasClass('touch')) {
      //
    } else {
      //
    }
  });
})(jQuery);
