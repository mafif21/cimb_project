<x-app-layout>
    <x-slot name="title">Home</x-slot>
    <x-slot name="additional">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
            <style>
                body, html {
                    height: 100%;
                }

                #map { height: 100%; }

                /* .leaflet-popup   {
                    bottom: 20px !important;
                    left: 20px !important;
                } */

                /* Default style for the marker icon */
                .leaflet-marker-icon {
                    transition: transform 0.3s ease; /* Animasi perubahan ukuran */
                }

                /* Membesar saat popup terbuka */
                .marker-enlarged {
                    box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
                    animation: pulse 2s infinite;
                    border-radius: 50px;
                }

                .leaflet-popup-content-wrapper {
                    border-radius: 5px;
                }

                @keyframes pulse {
                    0% {
                        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
                    }

                    70% {
                        box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
                    }

                    100% {
                        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
                    }
                }
            </style>
    </x-slot>

    <x-slot name="slot">
        <div class="flex flex-col md:flex-row h-full">
            <div class="md:w-[470px] bg-[#ffffff]">
                <p class="ml-7 mt-3 text-xl font-bold">Lokasi</p>
                <img src="{{ asset('images/cimb.png') }}" alt="" class="w-1/2 ml-7">
                
                <div class="m-7 mt-0">
                    <form id="form-search" class="mx-auto">
                        <div class="flex">
                            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">All categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg></button>
                            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                                <li>
                                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Mockups</button>
                                </li>
                                <li>
                                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Templates</button>
                                </li>
                                <li>
                                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Design</button>
                                </li>
                                <li>
                                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Logos</button>
                                </li>
                                </ul>
                            </div>
                            <div class="relative w-full">
                                <input type="search" id="input-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Cari Lokasi" required />
                                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-red-700 rounded-e-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                            <button type="button" id="btn-search-location" class="px-[4px] ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <img src="{{ asset('images/location.svg') }}" alt="location" width="60">
                            </button>
                        </div>
                    </form>
                    <div class="mt-4 overflow-y-auto h-[250px] md:h-[75vh]">
                        <div class="mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <a href="#" onclick="focusOn(1)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                        <div class="mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <a href="#" onclick="focusOn(2)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                        <div class="mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <a href="#" onclick="focusOn(3)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex-1">
                <button onclick="removeAllMarkers()">Test Hapus Marker</button> || 
                <button onclick="addMarkersToMap(true)">Test Add marker</button>
                <div id="map"></div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-djRf8Q5f5s/TNz/tLD9gZp3p2hkHvf0Sb1CO8t3hKmY8/diIcdUnP3cwPEqU7APLiRYf2zp8HM7mNpUYYa0XrA=="
            crossorigin=""></script>
            <script>
                let originLat = 0;
                let originLong = 0;
                var map = L.map('map').setView([ -6.200000, 106.816666], 12);
                // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    
                    maxZoom: 19,
                    // attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                }).addTo(map);

                var redIcon = L.icon({
                    iconUrl: '{{ asset("images/663342.png") }}', // Use a red marker image
                    iconSize: [41, 41], // size of the icon
                    shadowSize: [41, 41] // size of the shadow
                });

                // TODO: 
                // const branches = [
                //     {id: 1, name: 'KCU Monas', lat: -6.186804352256971, long: 106.82341848860942},
                //     {id: 2, name: 'ATM Ragunan', lat: -6.30131770918271, long: 106.81945865323401},
                //     {id: 3, name: 'KP Puter I', lat: -6.270209835189249, long: 106.72973875224473},
                // ];

                const markersLayer = new L.LayerGroup();
                const markers = {};

                function addMarkersToMap(a = false) {
                    let branches = [
                        {id: 1, name: 'KCU Monas', lat: -6.186804352256971, long: 106.82341848860942},
                        {id: 2, name: 'ATM Ragunan', lat: -6.30131770918271, long: 106.81945865323401},
                        {id: 3, name: 'KP Puter I', lat: -6.270209835189249, long: 106.72973875224473},
                    ];

                    // test
                    if (a) {
                        branches = [
                            {id: 1, name: 'Gedung Sate', lat: -6.9018627528248375, long: 107.61815411957087}, 
                            {id: 2, name: 'Braga', lat: -6.915482673997068, long: 107.608973376}, 
                            {id: 3, name: 'Sport Jabar', lat: -6.91208615176044, long: 107.67255327349277}, 
                        ];
                    }

                    const locationCoords = [];
                    for(const i in branches) {
            
                        const branch = branches[i];
                        const destLat = branch.lat;
                        const destLong = branch.long;
                        locationCoords.push([destLat, destLong]);
                        // markers[branch.id] = L.marker([destLat, destLong], { icon: redIcon }).addTo(map);
                        markers[branch.id] = L.marker([destLat, destLong], { icon: redIcon });
                        
                        let paramOrigin = '';
                        if (originLat !== 0 && originLong !== 0) {
                            paramOrigin = `&origin=${originLat},${originLong}`;
                        }
                        let url_direction = `https://www.google.com/maps/dir/?api=1${paramOrigin}&destination=${destLat},${destLong}`;
                
                        markers[branch.id].bindPopup(`<b>KCU BCA</b><br>Jam Buka: 182312. <br><br> <a href="${url_direction}" target="_blank">Direction</a>`);
                    
                        markers[branch.id].on('popupopen', function() {
                            var markerIcon = markers[branch.id]._icon;
                            markerIcon.classList.add('marker-enlarged');
                        });
            
                        markers[branch.id].on('popupclose', function() {
                            var markerIcon = markers[branch.id]._icon;
                            markerIcon.classList.remove('marker-enlarged');
                        });
            
                        markersLayer.addLayer(markers[branch.id]); 
                    }
                    
                    var bounds = new L.latLngBounds(locationCoords);
                    map.fitBounds(bounds);
                    markers.length = 0;
                    markersLayer.addTo(map)

                }
                // TEST:
                addMarkersToMap();



                // marker.on('click',  (e) => {
                //     console.log(e)
                // })


                // TODO: manggil API
                function searchLocation() {
                    const input = document.getElementById('input-search').value;
                    if (input.length < 3) return;

                    console.log(input)
                }

                document.getElementById('input-search').addEventListener('keyup', (e) => {
                    
                    searchLocation();
                });
                document.getElementById('form-search').addEventListener('submit', (e) => {
                    e.preventDefault();
                    searchLocation();
                })

                document.getElementById('btn-search-location').addEventListener('click', () => {
                    getLocationUser();
                });

                // map.on('click', function(e) {
                //     console.log(e)
                //     // https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=47.217954&lon=-1.552918
                //     alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
                // });

            

                
                function focusOn(id) {
                    // markers[city].openPopup();
                    markers[id].openPopup();
                }

                function removeAllMarkers() {
                    
                    markersLayer.clearLayers();
                }

                // Request Permisison
                function getLocationUser() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition, showError);
                    } else {
                        console.error("Geolocation is not supported by this browser.");
                    }
                }

                function showPosition(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    originLat = latitude;
                    originLong = longitude;
                    alert("Latitude: " + latitude + ", Longitude: " + longitude);
                    // You can also display the coordinates or use them in your application
                }

                function showError(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            console.log("User denied the request for Geolocation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            console.log("Location information is unavailable.");
                            break;
                        case error.TIMEOUT:
                            console.log("The request to get user location timed out.");
                            break;
                        case error.UNKNOWN_ERROR:
                            console.log("An unknown error occurred.");
                            break;
                    }
                }

            </script>
    </x-slot>
</x-app-layout>
