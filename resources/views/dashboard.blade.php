<x-layout>

    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Inventori</h1>
            <p class="text-gray-600">Overview statistik dan performa inventori</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Barang -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Barang</p>
                        <p class="text-2xl font-bold text-gray-900" id="totalBarang">0</p>
                    </div>
                    <div class="p-3 bg-blue-500 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-500 text-sm font-medium">↑ 12%</span>
                    <span class="text-gray-600 text-sm">dari bulan lalu</span>
                </div>
            </div>

            <!-- Barang Masuk -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Barang Masuk</p>
                        <p class="text-2xl font-bold text-gray-900" id="barangMasuk">0</p>
                    </div>
                    <div class="p-3 bg-green-500 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-500 text-sm font-medium">↑ 8%</span>
                    <span class="text-gray-600 text-sm">dari bulan lalu</span>
                </div>
            </div>

            <!-- Barang Keluar -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Barang Keluar</p>
                        <p class="text-2xl font-bold text-gray-900" id="barangKeluar">0</p>
                    </div>
                    <div class="p-3 bg-red-500 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-red-500 text-sm font-medium">↓ 5%</span>
                    <span class="text-gray-600 text-sm">dari bulan lalu</span>
                </div>
            </div>

            <!-- Total Nilai Inventori -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Nilai Inventori</p>
                        <p class="text-2xl font-bold text-gray-900" id="totalNilai">Rp 0</p>
                    </div>
                    <div class="p-3 bg-purple-500 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-500 text-sm font-medium">↑ 15%</span>
                    <span class="text-gray-600 text-sm">dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Line Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tren Inventori</h2>
                <canvas id="trenChart"></canvas>
            </div>

            <!-- Bar Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Perbandingan Barang Masuk & Keluar</h2>
                <canvas id="comparisonChart"></canvas>
            </div>
        </div>
    </div>

</x-layout>
