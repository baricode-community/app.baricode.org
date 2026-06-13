<x-layouts.dashboard :title="__('Analytics Dashboard')">
    <!-- Main Content -->
    <section class="py-6 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Active Sessions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-semibold">Waktu Aktif Mingguan (Segera Hadir)</h3>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">456</p>
                    <p class="text-green-600 text-sm mt-2">↑ 8% dari kemarin</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-8">
                <!-- Activity Distribution -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Aktivitas (Segera Hadir)</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Meetings</span>
                                <span class="text-sm font-semibold text-gray-800">45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 45%;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Events</span>
                                <span class="text-sm font-semibold text-gray-800">30%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 30%;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Entertainment</span>
                                <span class="text-sm font-semibold text-gray-800">15%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-pink-500 h-2 rounded-full" style="width: 15%;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Lainnya</span>
                                <span class="text-sm font-semibold text-gray-800">10%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full" style="width: 10%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru (Segera Hadir)</h3>
                <div class="space-y-4">
                    <div class="flex items-start border-l-4 border-blue-500 pl-4 py-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">5 pengguna baru mendaftar</p>
                            <p class="text-xs text-gray-500">5 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start border-l-4 border-green-500 pl-4 py-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Meeting baru dijadwalkan</p>
                            <p class="text-xs text-gray-500">15 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start border-l-4 border-purple-500 pl-4 py-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Event berakhir berhasil</p>
                            <p class="text-xs text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start border-l-4 border-orange-500 pl-4 py-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Sistem update dilakukan</p>
                            <p class="text-xs text-gray-500">Kemarin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>
