<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideU - Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col justify-between">

    <!-- Navbar -->
    <nav class="bg-white py-4 px-6 md:px-12 flex justify-between items-center shadow-sm">
        <a href="/" class="text-blue-600 font-extrabold text-2xl tracking-tight">RideU</a>
        
        <div class="flex items-center space-x-6 text-gray-600">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa-solid fa-gauge mr-1"></i> Admin Panel
                    </a>
                @endif
                <a href="{{ route('motors.list') }}" class="text-xs font-bold bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-motorcycle mr-1"></i> Sewa Motor
                </a>
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <a href="{{ route('profile') }}" class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden border-2 border-blue-600 hover:border-blue-700 transition block">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" alt="Profile">
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold transition">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('motors.list') }}" class="text-xs font-bold bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-motorcycle mr-1"></i> Sewa Motor
                </a>
                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-bold bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 md:px-12 mt-8 flex-1 w-full pb-20">
        
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center space-x-2">
                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation text-rose-500"></i>
                <div>
                    <span class="font-bold">Gagal memperbarui profil:</span>
                    <ul class="list-disc list-inside mt-1 text-xs space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Side: Profile Summary Card -->
            <section class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                    <div class="w-24 h-24 rounded-full bg-gray-150 mx-auto overflow-hidden border-4 border-blue-100 mb-4 flex items-center justify-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff&size=128" alt="Profile" class="w-full h-full">
                    </div>
                    
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ auth()->user()->name }}</h2>
                    <p class="text-xs text-gray-400 capitalize mb-4 bg-gray-50 px-3 py-1 rounded-full w-fit mx-auto border border-gray-100 font-semibold">{{ auth()->user()->role }}</p>
                    
                    <hr class="border-gray-100 my-4">
                    
                    <div class="text-left space-y-3 text-xs">
                        <div>
                            <span class="text-gray-400 block uppercase tracking-wider font-semibold">Email</span>
                            <span class="font-bold text-gray-700">{{ auth()->user()->email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block uppercase tracking-wider font-semibold">Bergabung Sejak</span>
                            <span class="font-bold text-gray-700">{{ auth()->user()->created_at->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block uppercase tracking-wider font-semibold">Total Sewa</span>
                            <span class="font-bold text-blue-600">{{ $rentals->count() }} Transaksi</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right Side: Content -->
            <section class="w-full lg:w-3/4 space-y-6">
                <!-- Edit Profile Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fa-solid fa-user-pen mr-2 text-blue-600"></i> Edit Profil
                    </h2>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition" required>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Alamat Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Password Baru (Kosongkan jika tidak ingin diubah)</label>
                                <input type="password" id="password" name="password" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition" placeholder="Minimal 8 karakter">
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition" placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg transition text-sm flex items-center">
                                <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Rental History Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fa-solid fa-clock-rotate-left mr-2 text-blue-600"></i> Riwayat Sewa Motor Anda
                    </h2>

                    @forelse($rentals as $rental)
                        <div class="border border-gray-100 rounded-xl p-4 md:p-6 mb-6 hover:shadow-sm transition flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                            
                            <!-- Motor info & icon -->
                            <div class="flex items-center space-x-4">
                                <div class="w-20 h-16 bg-blue-50 rounded-lg p-1.5 flex items-center justify-center border border-blue-100/50 overflow-hidden shrink-0">
                                    <img src="{{ asset('images/' . $rental->motor->image) }}" alt="{{ $rental->motor->name }}" class="object-contain w-full h-full">
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-base leading-snug">{{ $rental->motor->name }}</h3>
                                    <p class="text-xs text-gray-400 capitalize">{{ $rental->motor->brand }} • {{ $rental->motor->type }}</p>
                                    <div class="flex items-center space-x-2 mt-1 text-[11px] text-gray-500">
                                        <span><i class="fa-regular fa-calendar-check mr-1 text-blue-500"></i>{{ \Carbon\Carbon::parse($rental->pickup_date)->format('d M Y') }}</span>
                                        <span>•</span>
                                        <span><i class="fa-regular fa-clock mr-1 text-blue-500"></i>{{ $rental->pickup_time }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="grid grid-cols-2 md:flex md:items-center gap-x-8 gap-y-2 text-xs md:text-right">
                                <div>
                                    <span class="text-gray-400 block font-semibold">Durasi</span>
                                    <span class="font-bold text-gray-700">{{ $rental->duration }} Hari</span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block font-semibold">Total Biaya</span>
                                    <span class="font-bold text-gray-900">Rp. {{ number_format($rental->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block font-semibold">Lokasi Pick-up</span>
                                    <span class="font-bold text-gray-700 capitalize">{{ $rental->pickup_location }}</span>
                                </div>
                            </div>

                            <!-- Status & receipt link -->
                            <div class="flex md:flex-col items-center md:items-end justify-between w-full md:w-auto pt-4 md:pt-0 border-t border-gray-50 md:border-0 gap-3">
                                <div>
                                    @if($rental->status === 'active')
                                        <span class="bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-bold px-3 py-1 rounded-full capitalize">
                                            Aktif / Disewa
                                        </span>
                                    @elseif($rental->status === 'completed')
                                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold px-3 py-1 rounded-full capitalize">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="bg-red-50 text-red-600 border border-red-100 text-[10px] font-bold px-3 py-1 rounded-full capitalize">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </div>
                                @if($rental->receipt_image)
                                    <a href="{{ asset('receipts/' . $rental->receipt_image) }}" target="_blank" class="text-[10px] text-blue-600 hover:underline flex items-center font-bold">
                                        <i class="fa-solid fa-file-invoice-dollar mr-1"></i> Bukti Transfer
                                    </a>
                                @endif
                            </div>

                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-300 text-3xl mb-4">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg mb-1">Belum Ada Riwayat Sewa</h3>
                            <p class="text-xs text-gray-400 max-w-xs mx-auto mb-6">Anda belum pernah melakukan sewa motor. Temukan motor terbaik Anda sekarang!</p>
                            <a href="{{ route('motors.list') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2.5 px-6 rounded-lg transition inline-block">
                                Jelajahi Motor
                            </a>
                        </div>
                    @endforelse

                </div>
            </section>

        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 pt-8 pb-4 px-6 md:px-12 mt-auto">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
            <p>&copy; 2026 RideU. All rights reserved</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-600">Privacy & Policy</a>
                <a href="#" class="hover:text-gray-600">Terms & Condition</a>
            </div>
        </div>
    </footer>

</body>
</html>
