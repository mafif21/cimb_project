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
            <table id="datatable" class="min-w-full divide-y divide-gray-200 table-auto" style="margin-top: 10px">
                <thead class="bg-gray-50">
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{ $loop->last ? 'sticky-column-right bg-gray-50' : '' }}">
                                {{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
        </div>
    </x-slot>

    <x-slot name="scripts">
        <!-- Pastikan jQuery dan DataTables sudah ter-include -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Tambahkan CSS dan JS DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.branch.index') }}",
                    columns: [
                        { data: 'name', name: 'name', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'address', name: 'address', className: 'px-6 py-4 text-sm text-gray-900', render: function(data, type, row) {
            return '<p class="truncate w-56">' + data + '</p>';
        } },
                        { data: 'phone', name: 'phone', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'days_open', name: 'days_open', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'hours_open', name: 'hours_open', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'latitude', name: 'latitude', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'longitude', name: 'longitude', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'category.name', name: 'category.name', className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900 sticky-column-right bg-gray-50' },
                    ],
                    scrollY: "600px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true
                });
            });
        </script>
    </x-slot>
</x-admin-layout>
