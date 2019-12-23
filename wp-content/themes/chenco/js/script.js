function debounced(delay, fn) {
  let timerId;
  return function(...args) {
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
        ''
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
        dots: true,
        arrows: true,
        infinite: false,
        slidesToShow: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1
            }
          }
        ]
      });
    }
  };

  const initTabs = () => {
    // get url parameter to select active tab
    const activeTab = getParameterByName('tab');
    const $tabs = $('.tabs');

    if ($tabs.length) {
      $('[data-tab]').on('click', function(e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active');
        $('.tab-container')
          .find('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');

        e.preventDefault();
      });
    }

    if ($('.tabs--firm').length) {
      $('[data-tab]').on('click', function(e) {
        if ($(this).data('tab') === 1) {
          $(this)
            .parent()
            .removeClass('tabs-nav--alt');
        } else {
          $(this)
            .parent()
            .addClass('tabs-nav--alt');
        }
      });
    }

    $('[data-tab-name=' + activeTab + ']').trigger('click');

    // $('[data-tab=2]').trigger('click');
  };

  /**
   * Login Modal
   */
  const loginModal = () => {
    // const $link = $('#menu-secondary a[data-name=login]');

    // $link.on('click', function(e) {
    //   e.preventDefault();
    //   this.blur();

    //   const href = '/customer-area/login/index.php';

    //   $.get(href, function(html) {
    //     $(html)
    //       .find('.cuar-login-form')
    //       .appendTo('body')
    //       .modal();
    //   });

    // $.ajax({
    //   url: href,
    //   type: 'GET',
    //   success: function(data) {
    //     $('#content').html(
    //       $(data)
    //         .find('#content')
    //         .html()
    //     );
    //   }
    // });

    $('a.login-link').on('click', function(e) {
      const target = $('div.login-modal').data('modal');

      if (target && target.length > 0) {
        e.preventDefault();
        target.reveal({
          modalbgclass: 'lwa-modal-bg',
          dismissmodalclass: 'lwa-modal-close'
        });
      }
    });
  };

  /**
   * Google map jQuery selectors and coordinates
   */

  const center = {
    usa: [38.901187, -110.914306],
    asia: [28.441223, -238.391588],
    global: [40.141496, -168.588005]
  };
  const regionCenters = {
    norcal: [39.781569, -122.19576],
    socal: [32.155, -119.033081],
    hawaii: [31.906707, -132.501246],
    south: [30.705239, -98.67815],
    mountain: [39.05847, -105.706326],
    midwest: [41.65778, -90.853814],
    southeast: [31.082342, -82.767718],
    northeast: [38.56669, -76.621757]
  };
  const countryNames = {
    usa: 'United States',
    global: 'Global',
    asia: 'Asia'
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

    const args = {
      minZoom: 3,
      maxZoom: 9,
      zoom: 4,
      center: new google.maps.LatLng(center['usa'][0], center['usa'][1]),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      // disableDefaultUI: true,
      styles
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
    $options.each(function() {
      const $this = $(this);
      const showCurrent = $this.data('current');

      $this.on('click', function() {
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
    //   removeMarkers(map.markers);

    //   if (zoomLevel === 5) {
    //     for (let center in regionCenters) {
    //       const coordinates = regionCenters[center];

    //       const marker = new google.maps.Marker({
    //         position: new google.maps.LatLng(coordinates[0], coordinates[1]),
    //         map: map,
    //         icon: document.location.origin + `/wp-content/themes/chenco/assets/circle.svg`
    //       });

    //       // add to array
    //       map.markers.push(marker);
    //     }
    //   } else {
    //     addMarkers($currentMarkers, map);
    //   }
    // });

    map.addListener(
      'bounds_changed',
      debounced(200, () => calculateLegend(map, legendStats))
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
    $legendRows.each(function(index) {
      const $this = $(this);
      const currentStat = parseFloat($this.text().replace(/,/g, ''));

      // animate count up when statistic changes based on map bounds
      if ($this.html() !== legendStats[index]) {
        $this.countTo({
          from: currentStat,
          to: legendStats[index],
          speed: 500,
          refreshInterval: 50,
          formatter: function(value, options) {
            value = value.toFixed(options.decimals);
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return value;
          },
          onUpdate: function(value) {
            console.debug(this);
          },
          onComplete: function(value) {
            console.debug(this);
          }
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
    $markers.each(function() {
      const $this = $(this);
      addMarker($this, map);
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

  function addMarker($marker, map) {
    const latlng = new google.maps.LatLng($marker.data('lat'), $marker.data('lng'));
    const type = $marker.data('type').toLowerCase();

    // custom marker icon colors for each asset type
    const icons = {
      office: 'rgb(37, 79, 123)',
      multifamily: 'rgb(191, 144, 1)',
      land: 'rgb(87, 135, 171)',
      industrial: 'rgb(121, 175, 153)'
    };

    // marker svg allowing options
    const createMarker = color => {
      const svg = `data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10" fill="${color}"/></svg>`;

      return svg;
    };

    // create marker
    const marker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon: createMarker(icons[type]),
      title: $marker.data('stats').toString()
    });

    // add to array
    map.markers.push(marker);

    // if marker contains HTML, add it to an infoWindow
    if ($marker.html()) {
      // create info window
      let infowindow = new google.maps.InfoWindow({
        content: $marker.html(),
        maxWidth: 400
      });

      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });

      google.maps.event.addListener(map, 'click', function(event) {
        infowindow.close();
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

    $tabs.each(function() {
      $(this).on('click', () => {
        let country = $(this).data('center');

        $tabs.removeClass('mod--active');
        $(this).addClass('mod--active');

        $region.text(countryNames[country]);

        country === 'global' ? map.setZoom(4) : map.setZoom(5);
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

    $('select').select2({
      // width: 'resolve',
      minimumResultsForSearch: 'Infinity'
    });

    // if ($('body').hasClass('home')) {
    // initSlider();
    // }

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
