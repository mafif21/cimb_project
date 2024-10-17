<x-admin-layout>
    <x-slot name="title">Admin Branch</x-slot>

    <x-slot name="slot">
        <div class="flex justify-between mb-5 items-center">
            <div>
                <a href="{{ route('admin.branch.create') }}"
                    class="text-white bg-cimb-light font-medium rounded-lg text-sm px-5 py-2.5">Add Cimb Branch</a>
            </div>
        </div>

        <div class="overflow-x-auto shadow-md relative sm:rounded-lg mx-auto">
            <table class="w-full text-sm text-left text-gray-500 table-fixed">
                <caption class="p-5 text-lg font-semibold text-left text-gray-900 ">
                    Admin Branch Page
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Halo
                        {{ auth()->user()->name }} salam EPICC, silahkan tambah, edit, hapus cabang CimbNiaga yang ada
                        di Indonesia</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Branch Name
                        </th>
                        <th scope="col" class="py-3 px-6 px-4">
                            Address
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Phone
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Days Open
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Hours Open
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Latitude
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Longtitude
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Branch Category
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-200">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            Bintaro
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-wrap">
                            Grand Niaga II, Jl. Wahid Hasyim No.3 Blok B4, Pd. Jaya, Kec. Pd. Aren, Kota Tangerang
                            Selatan, Banten 15224
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-wrap">
                            083749936
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            Monday - Friday
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            09.00 - 17.00
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            -6.273072
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            106.724285
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            Kantor Pusat
                        </th>
                        <td class="py-4 px-6">
                            <div class="flex gap-4 items-center">
                                <a href="{{ route('admin.branch.edit', 1) }}" class="font-medium text-blue-600">Edit</a>
                                <form action="{{ route('admin.branch.destroy', 1) }}" method="post"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-slot>
</x-admin-layout>
