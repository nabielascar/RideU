<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideU Admin - Dashboard Kelola Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Wrapper -->
    <div class="flex flex-col md:flex-row min-h-screen">
        
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 bg-slate-950 border-r border-slate-800 p-6 flex flex-col justify-between">
            <div>
                <!-- Brand logo -->
                <div class="flex items-center space-x-3 mb-8">
                    <span class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">RideU</span>
                    <span class="bg-indigo-500/10 text-indigo-400 text-[10px] font-bold px-2 py-0.5 rounded-full border border-indigo-500/20">Admin</span>
                </div>

                <!-- Nav links -->
                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 text-blue-400 rounded-xl border border-blue-500/20 font-semibold transition">
                        <i class="fa-solid fa-motorcycle text-lg"></i>
                        <span>Kelola Motor</span>
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 rounded-xl transition">
                        <i class="fa-solid fa-house text-lg"></i>
                        <span>Lihat Landing Page</span>
                    </a>
                </nav>
            </div>

            <!-- User footer info -->
            <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full bg-slate-800 overflow-hidden border-2 border-indigo-500">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366F1&color=fff" alt="Profile">
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-200">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-500">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-slate-500 hover:text-red-400 transition" title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-lg"></i>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 md:p-10 overflow-y-auto">
            
            <!-- Welcome Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight">Dashboard Admin</h1>
                    <p class="text-sm text-slate-400">Tambah motor sewaan baru, lihat status, dan perbarui ketersediaan unit.</p>
                </div>
                
                @if(session('success'))
                    <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl text-sm flex items-center space-x-2 animate-pulse">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left: Form Tambah Motor (1/3 width) -->
                <section class="bg-slate-950 border border-slate-800 rounded-2xl p-6 shadow-xl h-fit">
                    <h2 class="text-xl font-bold mb-6 flex items-center text-indigo-400">
                        <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Motor Sewaan
                    </h2>
                    
                    <form action="{{ route('admin.motors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Nama Motor</label>
                            <input type="text" name="name" placeholder="Contoh: Honda Vario 160cc" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Brand</label>
                                <select name="brand" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition cursor-pointer" required>
                                    <option value="Honda">Honda</option>
                                    <option value="Yamaha">Yamaha</option>
                                    <option value="Suzuki">Suzuki</option>
                                    <option value="Kawasaki">Kawasaki</option>
                                    <option value="Vespa">Vespa</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tipe</label>
                                <select name="type" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition cursor-pointer" required>
                                    <option value="Matic">Matic</option>
                                    <option value="Sport Bike">Sport Bike</option>
                                    <option value="Naked Bike">Naked Bike</option>
                                    <option value="Cruiser">Cruiser</option>
                                    <option value="Moped">Moped</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Kapasitas Tangki</label>
                                <input type="text" name="fuel" placeholder="e.g. 5.5L" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Transmisi</label>
                                <select name="transmission" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition cursor-pointer" required>
                                    <option value="Matic">Matic</option>
                                    <option value="Manual">Manual</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="price" placeholder="Contoh: 95000" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Foto Motor</label>
                            <input type="file" name="image" accept="image/*" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Deskripsi Spesifikasi</label>
                            <textarea name="desc" rows="3" placeholder="Tuliskan spesifikasi mendetail, kelebihan motor, dll." class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500 transition" required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 rounded-xl transition shadow-lg shadow-indigo-600/20">
                            <i class="fa-solid fa-save mr-1"></i> Simpan Motor
                        </button>

                    </form>
                </section>

                <!-- Right: List Motor & Update Status (2/3 width) -->
                <section class="bg-slate-950 border border-slate-800 rounded-2xl p-6 shadow-xl lg:col-span-2">
                    <h2 class="text-xl font-bold mb-6 flex items-center text-blue-400">
                        <i class="fa-solid fa-list mr-2"></i> Daftar Motor & Status
                    </h2>

                    <!-- Table view -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-800 text-slate-400 text-xs font-bold uppercase tracking-wider">
                                    <th class="py-4 px-2">Motor</th>
                                    <th class="py-4 px-2">Info Specs</th>
                                    <th class="py-4 px-2">Harga / Hari</th>
                                    <th class="py-4 px-2">Status</th>
                                    <th class="py-4 px-2 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/50">
                                @forelse($motors as $motor)
                                    <tr class="hover:bg-slate-900/50 transition">
                                        <td class="py-4 px-2">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-14 h-12 bg-slate-800 rounded-lg p-1 flex items-center justify-center overflow-hidden border border-slate-700">
                                                    <img src="{{ asset('images/' . $motor->image) }}" alt="{{ $motor->name }}" class="object-contain w-full h-full">
                                                </div>
                                                <div>
                                                    <p class="font-bold text-sm text-slate-200">{{ $motor->name }}</p>
                                                    <p class="text-[10px] text-slate-500">{{ $motor->brand }} - {{ $motor->type }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2 text-xs text-slate-400">
                                            <div class="space-y-0.5">
                                                <p><i class="fa-solid fa-gas-pump mr-1 text-slate-600"></i>{{ $motor->fuel }}</p>
                                                <p><i class="fa-solid fa-gear mr-1 text-slate-600"></i>{{ $motor->transmission }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2 font-semibold text-sm text-slate-200">
                                            Rp. {{ number_format($motor->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-2">
                                            @if($motor->status === 'available')
                                                <span class="inline-flex items-center bg-emerald-500/10 text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-emerald-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1.5 animate-pulse"></span>
                                                    Available
                                                </span>
                                            @else
                                                <span class="inline-flex items-center bg-rose-500/10 text-rose-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-rose-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-400 mr-1.5"></span>
                                                    Sedang Disewa
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-2 text-right">
                                            <form action="{{ route('admin.motors.toggle', $motor->id) }}" method="POST" class="inline">
                                                @csrf
                                                @if($motor->status === 'available')
                                                    <button type="submit" class="bg-rose-600/10 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition" title="Tandai Sedang Disewa">
                                                        <i class="fa-solid fa-lock mr-1"></i> Sewakan
                                                    </button>
                                                @else
                                                    <button type="submit" class="bg-emerald-600/10 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition" title="Tandai Tersedia Kembali">
                                                        <i class="fa-solid fa-unlock mr-1"></i> Kembalikan
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-500 text-sm">
                                            Belum ada motor sewaan terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
                
            </div>
            
        </main>
    </div>

</body>
</html>
