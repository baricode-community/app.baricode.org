<x-layouts.dashboard :title="__('Meetings Dashboard')">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Dashboard Meetings</h1>
                    <p class="text-lg opacity-90">Kelola semua pertemuan dan jadwal Anda.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Meeting Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Upcoming Meetings -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-semibold">Upcoming</h3>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i data-lucide="calendar" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">12</p>
                    <p class="text-green-600 text-sm mt-2">Minggu ini</p>
                </div>

                <!-- Total Participants -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-semibold">Total Peserta</h3>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">245</p>
                    <p class="text-blue-600 text-sm mt-2">Di seluruh meetings</p>
                </div>

                <!-- Completed Meetings -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-semibold">Selesai</h3>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i data-lucide="check-circle" class="w-6 h-6 text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">56</p>
                    <p class="text-purple-600 text-sm mt-2">Total sepanjang waktu</p>
                </div>

                <!-- Avg Duration -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-semibold">Durasi Rata-rata</h3>
                        <div class="bg-orange-100 p-3 rounded-lg">
                            <i data-lucide="clock" class="w-6 h-6 text-orange-600"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">1h 30m</p>
                    <p class="text-orange-600 text-sm mt-2">Per meeting</p>
                </div>
            </div>

            <!-- Upcoming Meetings List -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Pertemuan Mendatang</h3>
                <div class="space-y-4">
                    <!-- Meeting Item 1 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800">Team Standup</h4>
                                    <span class="ml-3 inline-block bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Terjadwal</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Diskusi progres mingguan dan planning task baru</p>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                        Besok, 10:00 AM
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                        30 menit
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                                        8 peserta
                                    </div>
                                </div>
                            </div>
                            <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                Join
                            </button>
                        </div>
                    </div>

                    <!-- Meeting Item 2 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800">Client Review</h4>
                                    <span class="ml-3 inline-block bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">Pending</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Review hasil deliverables Q4 dengan klien</p>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                        Besok, 2:00 PM
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                        1 jam
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                                        5 peserta
                                    </div>
                                </div>
                            </div>
                            <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                Join
                            </button>
                        </div>
                    </div>

                    <!-- Meeting Item 3 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800">Brainstorming Session</h4>
                                    <span class="ml-3 inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Confirmed</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Sesi brainstorming untuk project baru 2025</p>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                        Sabtu, 3:00 PM
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                        2 jam
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                                        12 peserta
                                    </div>
                                </div>
                            </div>
                            <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Create New Meeting -->
                <button class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow text-left hover:bg-gray-50">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 p-4 rounded-lg">
                            <i data-lucide="plus" class="w-8 h-8 text-green-600"></i>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800">Buat Meeting Baru</h4>
                    <p class="text-gray-600 text-sm mt-2">Jadwalkan pertemuan baru dengan tim Anda</p>
                </button>

                <!-- View Calendar -->
                <button class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow text-left hover:bg-gray-50">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i data-lucide="calendar" class="w-8 h-8 text-blue-600"></i>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800">Lihat Kalender</h4>
                    <p class="text-gray-600 text-sm mt-2">Tampilkan semua jadwal pertemuan Anda</p>
                </button>
            </div>
        </div>
    </section>
</x-layouts.dashboard>
