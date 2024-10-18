<x-admin-layout>
    <x-slot name="title">Branch Detail</x-slot>
    <x-slot name="additional">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    </x-slot>

    <x-slot name="slot">
        <div class="grid justify-items-center">
            <div class="border border-gray-200 shadow-md w-9/12 p-10 rounded-lg">
                <a href="{{ route('admin.branch.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Back
                    To Menu</a>

                <div class="mb-6 mt-6">
                    <h1 class="font-semibold text-xl mb-1 text-slate-900">Branch Detail</h1>
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Halo
                        {{ auth()->user()->name }} silahkan melihat detail cabang dari CimbNiaga
                    </p>
                </div>

                <div id="map" class="h-[150px] mb-8"></div>


                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Branch
                            Name</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-maroon focus:border-cimb-maroon block w-full p-3 "
                            placeholder="category name" value="{{ $branch->name }}" disabled>
                    </div>
                    <div>
                        <label for="phone"
                            class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Phone</label>
                        <input type="text" id="phone" name="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-maroon focus:border-cimb-maroon block w-full p-3 "
                            placeholder="office phone" value="{{ $branch->phone }}" disabled>
                    </div>
                    <div>
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Category</label>
                        <select id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-light focus:border-cimb-light block w-full p-2.5"
                            name="category_id" disabled>
                            <option value={{ $branch->category_id }}>{{ $branch->category->name }}</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="address"
                        class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Address</label>
                    <textarea style="resize: none;" id="address" name="address" rows="4" placeholder="office address"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-cimb-maroon focus:border-cimb-maroon"
                        placeholder="Write your thoughts here..." disabled>{{ $branch->address }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="days_open" class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Days
                            Open</label>
                        <input type="text" id="days_open" name="days_open"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-maroon focus:border-cimb-maroon block w-full p-3 "
                            placeholder="office days open" value="{{ $branch->days_open }}" disabled>
                    </div>
                    <div>
                        <label for="hours_open" class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Hours
                            Open</label>
                        <input type="text" id="hours_open" name="hours_open"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-maroon focus:border-cimb-maroon block w-full p-3 "
                            placeholder="office hour open" value="{{ $branch->hours_open }}" disabled>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="latitude"
                            class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Latitude</label>
                        <input type="text" id="latitude" name="latitude"
                            class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-maroon focus:border-cimb-maroon block w-full p-3 "
                            placeholder="latitude" value="{{ $branch->latitude }}" disabled>
                    </div>
                    <div>
                        <label for="longitude"
                            class="block mb-2 text-sm font-medium text-gray-900 font-semibold">Longitude</label>
                        <input type="text" id="longitude" name="longitude"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cimb-maroon focus:border-cimb-maroon block w-full p-3 "
                            placeholder="office days open" value="{{ $branch->longitude }}" disabled>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.branch.edit', $branch->id) }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Edit
                        Branch
                    </a>
                    <div class="w-full">
                        <form action="{{ route('admin.branch.destroy', $branch->id) }}" method="post"
                            onsubmit="return confirm('Are you sure?')" class="inline w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white block w-full bg-cimb-light hover:bg-cimb-maroon focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-djRf8Q5f5s/TNz/tLD9gZp3p2hkHvf0Sb1CO8t3hKmY8/diIcdUnP3cwPEqU7APLiRYf2zp8HM7mNpUYYa0XrA=="
            crossorigin=""></script>
        <script>
            let lat = document.getElementsByName("latitude")[0].value
            let long = document.getElementsByName("longitude")[0].value

            var map = L.map('map').setView([lat, long], 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var redIcon = L.icon({
                iconUrl: '{{ asset('images/663342.png') }}',
                iconSize: [41, 41],
                shadowSize: [41, 41]
            });

            L.marker([lat, long], {
                icon: redIcon
            }).addTo(map);

            marker.on('click', function() {
                map.setView([lat, long], 18);
            });
        </script>
    </x-slot>
</x-admin-layout>
