<x-admin-layout>
    <x-slot name="title">Admin Branch</x-slot>

    <x-slot name="slot">
        <div class="flex justify-between mb-5 items-center">
            <div>
                <a href="{{ route('admin.branch.create') }}"
                    class="text-white bg-cimb-light font-medium rounded-lg text-sm px-5 py-2.5">Add Cimb Branch</a>
            </div>
        </div>

        <div class="container my-12">
            <h1 class="text-2xl font-semibold leading-tight my-6">List Cabang Bank</h1>
            <x-data-table :headers="[
                'Branch Name',
                'Address',
                'Phone',
                'Days Open',
                'Hours Open',
                'Latitude',
                'Longitude',
                'Category',
                'Action',
            ]">
                @foreach ($branches as $branch)
                    <tr>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->name }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <p class="truncate w-56">{{ $branch->address }}</p>
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->phone }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->days_open }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->hours_open }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->latitude }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->longitude }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $branch->category->name }}
                        </td>
                        <td scope="row"
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 sticky-column-right bg-gray-50">
                            <div class="flex gap-4 items-center">
                                <a href="{{ route('admin.branch.show', $branch->id) }}"
                                    class="font-medium text-blue-600">Detail</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
            {{-- <table class="w-full text-sm text-left text-gray-500 table-fixed">
                <caption class="p-5 text-lg font-semibold text-left text-gray-900 ">
                    Admin Branch Page
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Halo
                        {{ auth()->user()->name }} salam EPICC, silahkan tambah, edit, hapus cabang CIMB Niaga yang ada
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
                    @foreach ($branches as $branch)
                        <tr class="bg-white border-b hover:bg-gray-200">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $branch->name }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-wrap">
                                {{ $branch->address }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-wrap">
                                {{ $branch->phone }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $branch->days_open }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $branch->hours_open }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $branch->latitude }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $branch->longitude }}
                            </th>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $branch->category->name }}
                            </th>
                            <td class="py-4 px-6">
                                <div class="flex gap-4 items-center">
                                    <a href="{{ route('admin.branch.edit', 1) }}"
                                        class="font-medium text-blue-600">Edit</a>
                                    <form action="{{ route('admin.branch.destroy', 1) }}" method="post"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table> --}}
        </div>
    </x-slot>
</x-admin-layout>
