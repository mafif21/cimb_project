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
        <div class="grid h-[100vh] md:grid-cols-[2fr_1fr] overflow-hidden">
            <div class="relative">
                <div class="absolute top-5 right-10 z-10 hidden md:block">
                    <img src="{{ asset('images/cimb.png') }}" class="w-[200px] ml-7">
                </div>
                <div class="absolute inset-0 top-32 z-10 w-full px-[8rem] pointer-events-none">
                    <div>

                        <form class="w-full mx-auto pointer-events-auto" id="form-search">
                            <div class="flex">
                                <select name="category_id" id="category_id" class="w-[150px] rounded-l-md" required>
                                    <option value="Pilih Kategori" disabled>Pilih
                                        @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == 4 ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="relative w-full">
                                    <input type="search" id="input-search"
                                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                        placeholder="Search Mockups, Logos, Design Templates..." required />
                                    <button type="submit"
                                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="w-1/2 mt-4 pointer-events-auto h-screen">
                            <div class="rounded-lg border-md overflow-y-auto h-[70vh] w-full scroll-smooth simple-scroll pb-4" id="branches-list">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="map" class="h-[100vh] relative z-0"></div>
            </div>

            <div style="box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.05);"
                class="flex flex-col p-5 justify-between">

                <div class="py-4 px-2">
                    <div class="flex flex-col space-y-1.5 pb-6">
                        <h2 class="font-semibold text-lg tracking-tight">ChatCimb</h2>
                        <p class="text-sm text-[#6b7280] leading-3">Halo CimbNiaganian, ada yang bisa mimbot bantu👋</p>
                    </div>
                    <!-- Chat Container -->
                    <div class="pr-4 h-[474px]" style="min-width: 100%; display: table;">
                        <!-- Chat Message AI -->
                        <div class="flex gap-3 my-4 text-gray-600 text-sm flex-1"><span
                                class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                                <div class="rounded-full bg-gray-100 border p-1"><svg stroke="none" fill="black"
                                        stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20"
                                        width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z">
                                        </path>
                                    </svg></div>
                            </span>
                            <p class="leading-relaxed"><span class="block font-bold text-gray-700">AI </span>Hi, how
                                can
                                I
                                help you today?
                            </p>
                        </div>

                        <!--  User Chat Message -->
                        <div class="flex gap-3 my-4 text-gray-600 text-sm flex-1"><span
                                class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                                <div class="rounded-full bg-gray-100 border p-1"><svg stroke="none" fill="black"
                                        stroke-width="0" viewBox="0 0 16 16" height="20" width="20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z">
                                        </path>
                                    </svg></div>
                            </span>
                            <p class="leading-relaxed"><span class="block font-bold text-gray-700">You </span>fewafef
                            </p>
                        </div>
                        <!-- Ai Chat Message  -->
                        <div class="flex gap-3 my-4 text-gray-600 text-sm flex-1"><span
                                class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                                <div class="rounded-full bg-gray-100 border p-1"><svg stroke="none" fill="black"
                                        stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20"
                                        width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z">
                                        </path>
                                    </svg></div>
                            </span>
                            <p class="leading-relaxed"><span class="block font-bold text-gray-700">AI </span>Sorry, I
                                couldn't find any
                                information in the documentation about that. Expect answer to be less accurateI could
                                not
                                find the answer to
                                this in the verified sources.</p>
                        </div>
                    </div>
                </div>
                <!-- Heading -->

                <!-- Input box  -->
                <div class="flex items-center mb-2">
                    <form class="flex items-center justify-center w-full space-x-2" id="form-ai">
                        <input
                            id="input-ai"
                            class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-[#9ca3af] disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
                            placeholder="Type your message" value="">
                        <button
                            id="btn-ai"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-black hover:bg-[#111827E6] h-10 px-4 py-2">
                            Send</button>
                    </form>
                </div>
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
            var map = L.map('map').setView([-6.200000, 106.816666], 12);
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
            }).addTo(map);

            var redIcon = L.icon({
                iconUrl: '{{ asset('images/663342.png') }}',
                iconSize: [41, 41],
                shadowSize: [41, 41]
            });

            const blueIcon = L.icon({
                iconUrl: '{{ asset('images/3754313.png') }}',
                iconSize: [41, 41],
                shadowSize: [41, 41]
            });

            const markersLayer = new L.LayerGroup();
            let markers = {};
            let html = '';
            let user_marker = null;

            function addMarkersToMap(branches) {
                const locationCoords = [];
                for (const i in branches) {
                    const branch = branches[i];
                    const destLat = branch.latitude;
                    const destLong = branch.longitude;
                    locationCoords.push([destLat, destLong]);
                    markers[branch.id] = L.marker([destLat, destLong], {
                        icon: redIcon
                    });

                    let paramOrigin = '';
                    if (originLat !== 0 && originLong !== 0) {
                        paramOrigin = `&origin=${originLat},${originLong}`;
                    }
                    let url_direction =
                        `https://www.google.com/maps/dir/?api=1${paramOrigin}&destination=${destLat},${destLong}`;

                    markers[branch.id].bindPopup(
                        `<b>${branch.name}</b><br><br>${branch.address} <br><br>Hari: ${branch.days_open}<br>Jam Buka: ${branch.hours_open} <br><br> <a href="${url_direction}" target="_blank">Direction</a>`
                    );

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
                axios.get('{{ route('api.branches') }}', {
                    params: {
                        category_id: category_id,
                        search: search,
                        user_lat: user_lat,
                        user_long: user_long
                    }
                }).then((resp) => {
                    if (resp.data.data.length > 0) {
                        addMarkersToMap(resp.data.data)
                    } else if (!init) {
                        document.getElementById('branches-list').innerHTML =
                            '<p class="text-red-600">Tempat tidak ditemukan</p>';
                    }
                }).catch((e) => {
                    displayLoading(false);
                    alert(e.response)
                    console.error(e)
                }).finally(() => {
                    displayLoading(false);
                });

            }

            function generateList(branch) {
                const html = `<div
                    class="block mb-2 max-w-sm p-6 border border-gray-200 rounded-lg shadow bg-white-400 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-10 border border-gray-100">

                    <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">
                        ${branch.name}</h5>

                    <p class="font-normal text-gray-700 text-xs mb-1">${branch.address}
                    </p>
                    <p class="font-normal text-gray-700 text-xs mb-1">Hari: ${branch.days_open}</p>
                    <p class="font-normal text-gray-700 text-xs mb-1">Jam Buka: ${branch.days_open}</p>
                    <br>
                    <a href="#" onclick="focusOn(${branch.id})" class="inline-flex items-center px-2 py-1 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                        Lihat Lokasi
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>`;
                return html;
            }

            function displayLoading(show) {
                if (show) {
                    document.getElementById('loading').style.display = 'flex';
                } else {
                    document.getElementById('loading').style.display = 'none';
                }
            }

            document.getElementById('input-search').addEventListener('keyup', (e) => {
                // searchLocation();
            });
            document.getElementById('form-search').addEventListener('submit', (e) => {
                e.preventDefault();
                searchLocation();
            })

            // document.getElementById('btn-search-location').addEventListener('click', () => {
            //     getLocationUser();
            // });

            document.getElementById('form-ai').addEventListener('submit', (e) => {
                e.preventDefault();
                const input = document.getElementById('input-ai').value;
                if (input == '') return;


                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        console.log(input, latitude, longitude)
                    }, showError);
                } else {
                    console.error("Geolocation is not supported by this browser.");
                }

                return;

                axios.get('{{ route('api.branches') }}', {
                    params: {
                        
                        user_lat: user_lat,
                        user_long: user_long
                    }
                }).then((resp) => {
                    if (resp.data.data.length > 0) {
                        addMarkersToMap(resp.data.data)
                    } else if (!init) {
                        document.getElementById('branches-list').innerHTML =
                            '<p class="text-red-600">Tempat tidak ditemukan</p>';
                    }
                }).catch((e) => {
                    displayLoading(false);
                    alert(e.response)
                    console.error(e)
                }).finally((e) => {
                    displayLoading(false);
                });
            });

            function focusOn(id) {
                var latLng = markers[id].getLatLng();
                map.setView([latLng.lat, latLng.lng - 0.001], 18);
                markers[id].openPopup();
            }

            function resetMap() {
                markers = {};
                html = '';
                document.getElementById('branches-list').innerHTML = '';
                markersLayer.clearLayers();
            }

            function getLocationUser() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    console.error("Geolocation is not supported by this browser.");
                }
            }

            function showPosition(position) {
                document.getElementById('input-search').value = '';
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                user_marker = L.marker([latitude, longitude], {
                    icon: blueIcon
                }).addTo(map);
                searchLocation(false, {
                    user_lat: latitude,
                    user_long: longitude
                });

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

            searchLocation(true);
        </script>
    </x-slot>
</x-app-layout>