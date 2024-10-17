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
        {{ $slot }}
    </tbody>
</table>

<x-slot name="scripts">
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                scrollY: "300px", // Vertical scroll (adjustable height)
                scrollX: true, // Horizontal scroll
                scrollCollapse: true,
                paging: true
            });
        });
    </script>
</x-slot>
