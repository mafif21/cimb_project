<x-admin-layout>
    
    <div class="container mx-auto px-4 sm:px-8 max-w-7xl">
        <h1 class="text-3xl font-semibold leading-tight my-6">Admin Dashboard</h1>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Users Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Total Branches</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $data['totalBranches'] }}</p>
        </div>

        <!-- Total Orders Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Total Orders</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $data['totalOrders'] }}</p>
        </div>

        <!-- Total Revenue Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Total Revenue</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">${{ number_format($data['revenue'], 2) }}</p>
        </div>

        <!-- Products Sold Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Products Sold</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $data['productsSold'] }}</p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $data['totalUsers'] }}</p>
        </div>

        <!-- Total Orders Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Total Orders</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $data['totalOrders'] }}</p>
        </div>

        <!-- Total Revenue Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Total Revenue</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">${{ number_format($data['revenue'], 2) }}</p>
        </div>

        <!-- Products Sold Card -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Products Sold</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $data['productsSold'] }}</p>
        </div>
        
    </div>
</div>

</x-admin-layout>
