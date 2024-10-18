<x-admin-layout>

    <div class="container mx-auto px-4 sm:px-8 max-w-7xl">
        <h1 class="text-3xl font-semibold leading-tight my-6">Admin Dashboard</h1>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Total Users Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Branches</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalBranches'] }}</p>
            </div>

            <!-- Total Orders Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total ATM (Tarik Tunai)</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalATM'] }}</p>
            </div>

            <!-- Total Revenue Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total CDM (Setor Tunai)</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalCDM'] }}</p>
            </div>

            <!-- Products Sold Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total TST (Tarik Setor Tunai)</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalTST'] }}</p>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Kantor Cabang</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalKC'] }}</p>
            </div>

            <!-- Total Orders Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Digital Lounge</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalDigitalLounge'] }}</p>
            </div>

            <!-- Total Revenue Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total KCP</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalSubBranch'] }}</p>
            </div>

            <!-- Products Sold Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Kiosk</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalKiosk'] }}</p>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Kantor Cabang Syariah</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalKCS'] }}</p>
            </div>

            <!-- Total Orders Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Kantor Fungsional Syariah</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalKFS'] }}</p>
            </div>

            <!-- Total Revenue Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total KCP Syariah</h3>
                <p class="mt-3 text-xl font-semibold text-gray-900">{{ $data['totalKCPS'] }}</p>
            </div>

            <!-- Products Sold Card -->
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-sm font-medium text-gray-500">Total Weekend Banking</h3>
                <p class="mt-3x text-xl font-semibold text-gray-900">{{ $data['totalWeekendBanking'] }}</p>
            </div>

        </div>
    </div>

</x-admin-layout>
