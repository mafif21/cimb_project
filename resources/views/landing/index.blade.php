<x-app-layout>
    <x-slot name="title">Lokasi CIMB Niaga</x-slot>
    <x-slot name="additional">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </x-slot>

    <x-slot name="slot">
        <div class="flex flex-col md:flex-row h-[100vh]">
            <div class="md:w-[470px] bg-[#ffffff]">
                <p class="ml-7 mt-3 text-xl font-bold">Lokasi</p>
                <img src="{{ asset('images/cimb.png') }}" alt="" class="w-1/2 ml-7">
                
                <div class="m-7 mt-0">
                    <form id="form-search" class="mx-auto">
                        <div class="flex">
                            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Lokasi</label>
                            <select name="category_id" id="category_id" class="w-[150px] rounded-l-md" required>
                                <option value="Pilih Kategori" disabled>Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == 4 ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="relative w-full">
                                <input type="search" name="search" id="input-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Cari Lokasi" required />
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
                    <div id="branches-list" class="mt-4 overflow-y-auto h-[250px] md:h-[73vh]">
                    </div>
                </div>

            </div>
            <div class="flex-1">
                <!-- <button onclick="removeAllMarkers()">Test Hapus Marker</button> || 
                <button onclick="addMarkersToMap(true)">Test Add marker</button> -->
                <div id="map" class="h-[50vh] md:h-full"></div>
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
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    maxZoom: 19,
                    // attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                }).addTo(map);

                var redIcon = L.icon({
                    iconUrl: '{{ asset("images/663342.png") }}', // Use a red marker image
                    iconSize: [41, 41], // size of the icon
                    shadowSize: [41, 41] // size of the shadow
                });

                const blueIcon = L.icon({
                    iconUrl: '{{ asset("images/3754313.png") }}', // Use a red marker image
                    iconSize: [41, 41], // size of the icon
                    shadowSize: [41, 41] // size of the shadow
                });

                const markersLayer = new L.LayerGroup();
                let markers = {};
                let html = '';
                let user_marker = null;
                function addMarkersToMap(branches) {
                    const locationCoords = [];
                    for(const i in branches) {
                        const branch = branches[i];
                        console.log(branch)
                        const destLat = branch.latitude;
                        const destLong = branch.longitude;
                        locationCoords.push([destLat, destLong]);
                        // markers[branch.id] = L.marker([destLat, destLong], { icon: redIcon }).addTo(map);
                        markers[branch.id] = L.marker([destLat, destLong], { icon: redIcon });
                        
                        let paramOrigin = '';
                        if (originLat !== 0 && originLong !== 0) {
                            paramOrigin = `&origin=${originLat},${originLong}`;
                        }
                        let url_direction = `https://www.google.com/maps/dir/?api=1${paramOrigin}&destination=${destLat},${destLong}`;
                
                        markers[branch.id].bindPopup(`<b>${branch.name}</b><br><br>${branch.address} <br><br>Hari: ${branch.days_open}<br>Jam Buka: ${branch.hours_open} <br><br> <a href="${url_direction}" target="_blank">Direction</a>`);
                    
                        markers[branch.id].on('popupopen', function() {
                            var markerIcon = markers[branch.id]._icon;
                            markerIcon.classList.add('marker-enlarged');
                        });
            
                        markers[branch.id].on('popupclose', function() {
                            var markerIcon = markers[branch.id]._icon;
                            markerIcon.classList.remove('marker-enlarged');
                        });
            
                        markersLayer.addLayer(markers[branch.id]); 
                        html += generateList(branch);
                    }
                    
                    var bounds = new L.latLngBounds(locationCoords);
                    map.fitBounds(bounds);
                    // markers.length = 0;
                    markersLayer.addTo(map);
                    document.getElementById('branches-list').innerHTML = html;
                    displayLoading(false);
                }

                function searchLocation(init = false, userCordinate = null) {
                    const search = init ? 'Tangerang' : document.getElementById('input-search').value;
                    const category_id = document.getElementById('category_id').value;
                    let user_lat = '';
                    let user_long = '';
                    if (userCordinate) {
                        user_lat = userCordinate.user_lat;
                        user_long = userCordinate.user_long;
                    } else {
                        if (search.length < 3) {
                            alert('Minimal 3 Karakter');
                            return;
                        }
                    }
                    if (category_id == '') {
                        alert('Kategori tidak boleh kosong')
                        return;
                    }
                    displayLoading(true);
                    resetMap();
                    axios.get('{{ route("api.branches") }}', { params: {category_id: category_id, search: search, user_lat: user_lat, user_long: user_long} }).then((resp) => {
                        if (resp.data.data.length > 0) {
                            addMarkersToMap(resp.data.data)
                        } else if(!init) {
                            document.getElementById('branches-list').innerHTML = '<p class="text-red-600">Tempat tidak ditemukan</p>';
                        }
                    }).catch((e) => {
                        displayLoading(false);
                        alert(e.response)
                        console.error(e)
                    });
                    
                }

                function generateList(branch) {
                    const html = `<div class="mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">${branch.name}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">
                                ${branch.address}
                            </p>
                            <p class="mb-3 font-normal text-gray-700">
                                Hari: ${branch.days_open}
                            </p>
                            <p class="mb-3 font-normal text-gray-700">
                                Jam Buka: ${branch.hours_open}
                            </p>
                            <a href="#" onclick="focusOn(${branch.id})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                Lihat Lokasi
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>`;
                    return html;
                }

                document.getElementById('input-search').addEventListener('keyup', (e) => {
                    // searchLocation();
                });
                document.getElementById('form-search').addEventListener('submit', (e) => {
                    e.preventDefault();
                    searchLocation();
                })

                document.getElementById('btn-search-location').addEventListener('click', () => {
                    getLocationUser();
                });

                function focusOn(id) {
                    var latLng = markers[id].getLatLng();
                    map.setView(latLng, 18);
                    markers[id].openPopup();
                }

                function resetMap() {
                    markers = {};
                    html = '';
                    document.getElementById('branches-list').innerHTML = '';
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
                    user_marker = L.marker([latitude, longitude], { icon: blueIcon }).addTo(map);
                    searchLocation(false, {user_lat: latitude, user_long: longitude});
                    
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

                function displayLoading(show) {
                    if (show) {
                        document.getElementById('loading').style.display = 'flex';
                    } else {
                        document.getElementById('loading').style.display = 'none';
                    }
                }

                searchLocation(true);

            </script>
    </x-slot>
</x-app-layout>
