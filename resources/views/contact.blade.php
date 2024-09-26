<!DOCTYPE html>
<html lang="en">

<?php
    $feed = \Dymantic\InstagramFeed\InstagramFeed::for('groenevingersgv');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neem contact met ons op - GroeneVingers</title>
    <link rel="shortcut icon" href="{{ url('assets/icons/favicon.svg') }}" type="image/x-icon">
    <script src="{{ url('javascript/script.js') }}"></script>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css"
    />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/services/services-web.min.js"></script>
    <link rel="stylesheet" href="{{ url('css/contact.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/reset.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/header.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/map.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>
    @include('includes.header')
    <div class="wrapper">
        <div class="hero-section">
             <!-- Map container -->
            <div id='map' class='map'></div>
        </div>

        <div class="information-section">
            <div class="contact-information">
                <div class="card-contact">
                    <h3>{{ GoogleTranslate::trans('Klantenservice', app()->getLocale()) }}</h3>
                    <p>Mail: info@groenevingersshop.com</p>
                    <p>Tel: 06-33024999</p>
                    </br>
                    <a href="mailto:info@groenevingersshop.com" class="contact-button">{{ GoogleTranslate::trans('Neem contact op', app()->getLocale()) }}</a>
                    
                </div>
            </div>
            <div class="picture">
                <img src="{{ url('assets/images/GroenePand.jpg') }}" alt="locatie" />
            </div>
        </div>
        
        <div class="instagram-feed-section">            
            @foreach($feed as $post)
                <div class="instagram-post" onclick="location.href='{{ $post->permalink }}'">
                    <div class="post-header">
                        <span class="account">{{ $feed->profile->username }}</span>
                    </div>

                    <img class="post-image" src="/storage/posts/{{ $post->id }}.jpg" alt="A post from our instagram">
                    <p class="caption">{{ $post->caption }}</p>
                    
                    <div class="post-footer">
                        <span>{{ date('d-m-Y', strtotime($post->timestamp)) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('includes.footer')
</body>

</html>

<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.1/maps/maps-web.min.js'></script>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.1/services/services-web.min.js'></script>
    <script type='text/javascript' src='{{ url('javascript/map/mobile-or-tablet.js') }}'></script>
    <script type='text/javascript' src='{{ url('javascript/map/info-hint.js') }}'></script>
    <script type='text/javascript' src='{{ url('javascript/map/search/searchbox-enter-submit.js') }}'></script>
    <script type='text/javascript' src='{{ url('javascript/map/foldable.js') }}'></script>
    <script>
        var map = tt.map({
            key: 'm4QRBkItT4yj4Zpg1fHv7yqdZBGq7gVT',
            container: 'map',
            dragPan: !window.isMobileOrTablet(),
            center: [5.543190926093243, 51.46210505968836],
            zoom: 13
        });

        function createMarker(icon, position, color, popupText) {
            var markerElement = document.createElement('div');
            markerElement.className = 'marker';

            var markerContentElement = document.createElement('div');
            markerContentElement.className = 'marker-content';
            markerContentElement.style.backgroundColor = color;
            markerElement.appendChild(markerContentElement);

            var iconElement = document.createElement('div');
            iconElement.className = 'marker-icon';
            iconElement.style.backgroundImage =
                'url(https://api.tomtom.com/maps-sdk-for-web/cdn/static/' + icon + ')';
            markerContentElement.appendChild(iconElement);

            var popup = new tt.Popup({offset: 30}).setText(popupText);
            // add marker to map
            new tt.Marker({element: markerElement, anchor: 'bottom'})
                .setLngLat(position)
                .setPopup(popup)
                .addTo(map);
        }

        createMarker('accident.colors-white.svg', [5.534008932407582, 51.469172997430434], '#45A0CB', 'Groenevingers');
        createMarker('accident.colors-white.svg', [5.552663391299532, 51.45318241457581], '#48A240', 'Groenevingers');

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        new Foldable('#foldable', 'top-right');

        var bounds = new tt.LngLatBounds();

        function RoutingAB() {
            this.state = {
                start: undefined,
                finish: undefined,
                marker: {
                    start: undefined,
                    finish: undefined
                }
            };

            this.startSearchbox = this.createSearchBox('start');
            this.createSearchBox('finish');

            this.closeButton = document.querySelector('.tt-search-box-close-icon');
            this.startSearchboxInput = this.startSearchbox.getSearchBoxHTML().querySelector('.tt-search-box-input');

            this.startSearchboxInput.addEventListener('input', this.handleSearchboxInputChange.bind(this));

            this.createMyLocationButton();
            this.switchToMyLocationButton();

            this.errorHint = new InfoHint('error', 'bottom-center', 5000)
                .addTo(document.getElementById('map'));
        }

        RoutingAB.prototype.createMyLocationButton = function() {
            this.upperSearchboxIcon = document.createElement('div');
            this.upperSearchboxIcon.setAttribute('class', 'my-location-button');

            this.upperSearchboxIcon.addEventListener('click', function() {
                navigator.geolocation.getCurrentPosition(
                    this.reverseGeocodeCurrentPosition.bind(this),
                    this.handleError.bind(this)
                );
            }.bind(this));
        };

        RoutingAB.prototype.handleSearchboxInputChange = function(event) {
            var inputContent = event.target.value;

            if (inputContent.length > 0) {
                this.setCloseButton();
            } else {
                var resultList = this.startSearchbox.getSearchBoxHTML().querySelector('.tt-search-box-result-list');

                if (resultList || inputContent.length === 0) {
                    return;
                }

                this.onResultCleared('start');
            }
        };

        RoutingAB.prototype.reverseGeocodeCurrentPosition = function(position) {
            this.state.start = [position.coords.longitude, position.coords.latitude];

            tt.services.reverseGeocode({
                key: 'm4QRBkItT4yj4Zpg1fHv7yqdZBGq7gVT',
                position: this.state.start
            })
                .then(this.handleRevGeoResponse.bind(this))
                .catch(this.handleError.bind(this));
        };

        RoutingAB.prototype.handleRevGeoResponse = function(response) {
            var place = response.addresses[0];
            this.state.start = [place.position.lng, place.position.lat];
            this.startSearchbox.setValue(place.address.freeformAddress);
            this.onResultSelected(place, 'start');
        };

        RoutingAB.prototype.calculateRoute = function() {
            if (map.getLayer('route')) {
                map.removeLayer('route');
                map.removeSource('route');
            }

            if (!this.state.start || !this.state.finish) {
                return;
            }
            this.errorHint.hide();
            var startPos = this.state.start.join(',');
            var finalPos = this.state.finish.join(',');

            tt.services.calculateRoute({
                key: 'm4QRBkItT4yj4Zpg1fHv7yqdZBGq7gVT',
                traffic: false,
                locations: startPos + ':' + finalPos
            })
                .then(function(response) {
                    var geojson = response.toGeoJson();
                    map.addLayer({
                        'id': 'route',
                        'type': 'line',
                        'source': {
                            'type': 'geojson',
                            'data': geojson
                        },
                        'paint': {
                            'line-color': '#2faaff',
                            'line-width': 8
                        }
                    }, this.findFirstBuildingLayerId());

                    var coordinates = geojson.features[0].geometry.coordinates;
                    this.updateRoutesBounds(coordinates);
                }.bind(this))
                .catch(this.handleError.bind(this));
        };

        RoutingAB.prototype.handleError = function(error) {
            this.errorHint.setErrorMessage(error);
        };

        RoutingAB.prototype.drawMarker = function(type, viewport) {
            if (this.state.marker[type]) {
                this.state.marker[type].remove();
            }

            var marker = document.createElement('div');
            var innerElement = document.createElement('div');

            marker.className = 'route-marker';
            innerElement.className = 'icon tt-icon -white -' + type;
            marker.appendChild(innerElement);

            this.state.marker[type] = new tt.Marker({ element: marker })
                .setLngLat(this.state[type])
                .addTo(map);

            this.updateBounds(viewport);
        };

        RoutingAB.prototype.updateBounds = function(viewport) {
            bounds = new tt.LngLatBounds();

            if (this.state.start) {
                bounds.extend(tt.LngLat.convert(this.state.start));
            }
            if (this.state.finish) {
                bounds.extend(tt.LngLat.convert(this.state.finish));
            }

            if (viewport) {
                bounds.extend(tt.LngLat.convert(viewport.topLeftPoint));
                bounds.extend(tt.LngLat.convert(viewport.btmRightPoint));
            }

            if (!bounds.isEmpty()) {
                map.fitBounds(bounds, { duration: 0, padding: 50 });
            }
        };

        RoutingAB.prototype.updateRoutesBounds = function(coordinates) {
            bounds = new tt.LngLatBounds();

            coordinates.forEach(function(point) {
                bounds.extend(tt.LngLat.convert(point));
            });

            if (!bounds.isEmpty()) {
                map.fitBounds(bounds, { duration: 0, padding: 50 });
            }
        };

        RoutingAB.prototype.createSearchBox = function(type) {
            var searchBox = new tt.plugins.SearchBox(tt.services, {
                showSearchButton: false,
                searchOptions: {
                    key: 'm4QRBkItT4yj4Zpg1fHv7yqdZBGq7gVT'
                },
                labels: {
                    placeholder: 'Query e.g. Washington'
                }
            });
            document.getElementById(type + 'SearchBox').appendChild(searchBox.getSearchBoxHTML());

            searchBox.on('tomtom.searchbox.resultsfound', function(event) {
                handleEnterSubmit(event, this.onResultSelected.bind(this), this.errorHint, type);
            }.bind(this));

            searchBox.on('tomtom.searchbox.resultselected', function(event) {
                if (event.data && event.data.result) {
                    this.onResultSelected(event.data.result, type);
                }
            }.bind(this));
            searchBox.on('tomtom.searchbox.resultscleared', this.onResultCleared.bind(this, type));

            return searchBox;
        };

        RoutingAB.prototype.onResultSelected = function(result, type) {
            var pos = result.position;
            this.state[type] = [pos.lng, pos.lat];

            if (type === 'start') {
                this.setCloseButton();
            }

            this.drawMarker(type, result.viewport);
            this.calculateRoute();
        };

        RoutingAB.prototype.onResultCleared = function(type) {
            this.state[type] = undefined;

            if (this.state.marker[type]) {
                this.state.marker[type].remove();
                this.updateBounds();
            }
            if (type === 'start') {
                this.switchToMyLocationButton();
            }

            this.calculateRoute();
        };

        RoutingAB.prototype.setCloseButton = function() {
            var inputContainer = document.querySelector('.tt-search-box-input-container');
            this.closeButton.classList.remove('-hidden');

            if (document.querySelector('.my-location-button')) {
                inputContainer.replaceChild(this.closeButton, this.upperSearchboxIcon);
            }
        };

        RoutingAB.prototype.switchToMyLocationButton = function() {
            var inputContainer = document.querySelector('.tt-search-box-input-container');
            inputContainer.replaceChild(this.upperSearchboxIcon, this.closeButton);
        };

        RoutingAB.prototype.findFirstBuildingLayerId = function() {
            var layers = map.getStyle().layers;
            for (var index in layers) {
                if (layers[index].type === 'fill-extrusion') {
                    return layers[index].id;
                }
            }

            throw new Error('Map style does not contain any layer with fill-extrusion type.');
        };

        new RoutingAB();
    </script>
</body>
</html>