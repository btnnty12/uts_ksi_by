<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-y-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-5">Data Siswa</h2>
            
            @if($this->getStudentData())
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Siswa</h3>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $this->getStudentData()->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">NISN</h3>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $this->getStudentData()->nisn }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Kelas</h3>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $this->getStudentData()->class->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</h3>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $this->getStudentData()->birth_date->format('d F Y') }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $this->getStudentData()->address }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-gray-500 dark:text-gray-400">Data siswa tidak ditemukan. Silakan hubungi admin untuk mengaitkan akun Anda dengan data siswa.</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page> 