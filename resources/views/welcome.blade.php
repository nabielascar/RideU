<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideU - Sewa Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white py-4 px-6 md:px-12 flex justify-between items-center shadow-sm">
        <a href="/" class="text-blue-600 font-extrabold text-2xl tracking-tight">RideU</a>
        
        <form action="{{ route('motors.list') }}" method="GET" class="hidden md:flex items-center bg-gray-100 rounded-full px-4 py-2 w-1/3">
            <button type="submit" class="text-gray-400 hover:text-blue-600 transition flex items-center justify-center">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input type="text" name="search" placeholder="Cari Kendaraan Bermotor" class="bg-transparent border-none outline-none ml-3 w-full text-sm">
        </form>

        <div class="flex items-center space-x-6 text-gray-600">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa-solid fa-gauge mr-1"></i> Admin Panel
                    </a>
                @endif
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
                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-bold bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Register</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 md:px-12 mt-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-400 rounded-2xl p-8 text-white relative overflow-hidden flex flex-col justify-center h-64 shadow-md">
                <div class="relative z-10 w-2/3">
                    <h2 class="text-2xl font-bold mb-2">Platform Sewa Motor Terbaik Sekitar Kampus</h2>
                    <p class="text-sm mb-4 opacity-90">Kemudahan dalam menyewa motor secara aman dan online. Terkoneksi dengan harga yang terjangkau.</p>
                    <a href="{{ route('motors.list') }}" class="bg-blue-600 text-white text-sm font-semibold py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition inline-block text-center w-fit">Sewa Motor</a>
                </div>
                <i class="fa-solid fa-motorcycle absolute -right-4 -bottom-4 text-9xl opacity-20 transform -rotate-12"></i>
            </div>
            <div class="bg-blue-600 rounded-2xl p-8 text-white relative overflow-hidden flex flex-col justify-center h-64 shadow-md">
                <div class="relative z-10 w-2/3">
                    <h2 class="text-2xl font-bold mb-2">Cara mudah menyewa motor dengan harga murah.</h2>
                    <p class="text-sm mb-4 opacity-90">Menyediakan layanan sewa motor secara online/offline yang aman dan nyaman.</p>
                    <a href="{{ route('motors.list') }}" class="bg-blue-400 text-white text-sm font-semibold py-2 px-6 rounded-lg shadow hover:bg-blue-500 transition inline-block text-center w-fit">Sewa Motor</a>
                </div>
                <i class="fa-solid fa-moped absolute -right-4 -bottom-4 text-9xl opacity-20 transform -rotate-12"></i>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-2xl p-6 mb-12 flex flex-col md:flex-row items-center justify-between shadow-md">
            <h3 class="text-white font-bold text-xl mb-4 md:mb-0 w-full md:w-auto text-center">Facts In Numbers</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full md:w-3/4">
                <div class="bg-white rounded-xl py-2 px-4 flex items-center shadow-sm">
                    <div class="bg-orange-100 text-orange-500 p-2 rounded-lg mr-3"><i class="fa-solid fa-motorcycle"></i></div>
                    <div><div class="font-bold text-gray-800">540+</div><div class="text-xs text-gray-500">Bikes</div></div>
                </div>
                <div class="bg-white rounded-xl py-2 px-4 flex items-center shadow-sm">
                    <div class="bg-yellow-100 text-yellow-500 p-2 rounded-lg mr-3"><i class="fa-solid fa-users"></i></div>
                    <div><div class="font-bold text-gray-800">30K+</div><div class="text-xs text-gray-500">Customers</div></div>
                </div>
                <div class="bg-white rounded-xl py-2 px-4 flex items-center shadow-sm">
                    <div class="bg-orange-100 text-orange-500 p-2 rounded-lg mr-3"><i class="fa-regular fa-calendar"></i></div>
                    <div><div class="font-bold text-gray-800">20+</div><div class="text-xs text-gray-500">Years</div></div>
                </div>
                <div class="bg-white rounded-xl py-2 px-4 flex items-center shadow-sm">
                    <div class="bg-yellow-100 text-yellow-500 p-2 rounded-lg mr-3"><i class="fa-regular fa-eye"></i></div>
                    <div><div class="font-bold text-gray-800">20m+</div><div class="text-xs text-gray-500">Views</div></div>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-end mb-6">
            <h3 class="text-xl font-bold text-gray-800">Motor Popular</h3>
            <a href="/motors" class="text-blue-600 text-sm font-semibold hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach($motors as $motor)
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition relative group flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">{{ $motor->name }}</h4>
                                <p class="text-xs text-gray-400 mb-4">{{ $motor->brand }} - {{ $motor->type }}</p>
                            </div>
                            @if($motor->status === 'rented')
                                <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2 py-0.5 rounded">Rented</span>
                            @else
                                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded">Available</span>
                            @endif
                        </div>
                        
                        <div class="h-32 rounded-lg mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="{{ asset('images/' . $motor->image) }}" alt="{{ $motor->name }}" class="object-contain w-full h-full group-hover:scale-105 transition duration-300">
                        </div>
                        
                        <div class="flex items-center space-x-4 text-xs text-gray-500 mb-4">
                            <span class="flex items-center"><i class="fa-solid fa-gas-pump mr-1"></i> {{ $motor->fuel }}</span>
                            <span class="flex items-center"><i class="fa-solid fa-gear mr-1"></i> {{ $motor->transmission }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mt-2">
                        <div>
                            <span class="font-bold text-gray-800">Rp. {{ number_format($motor->price, 0, ',', '.') }}</span><span class="text-xs text-gray-500">/hari</span>
                        </div>
                        @if($motor->status === 'rented')
                            <span class="bg-gray-300 text-gray-600 text-xs font-semibold py-2 px-4 rounded-lg cursor-not-allowed">Disewa</span>
                        @else
                            <a href="{{ route('motors.details', $motor->id) }}" class="bg-blue-600 text-white text-xs font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition block text-center">Sewa</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </main>

    <footer class="bg-white border-t border-gray-200 mt-20 pt-12 pb-6 px-6 md:px-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start mb-8 gap-8">
            <div class="text-blue-600 font-extrabold text-3xl tracking-tight mb-4">RideU</div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-12 w-full md:w-auto text-sm">
                <div>
                    <h5 class="font-bold text-gray-800 mb-4">About</h5>
                    <ul class="space-y-2 text-gray-500">
                        <li><a href="#" class="hover:text-blue-600">How it works</a></li>
                        <li><a href="#" class="hover:text-blue-600">Featured</a></li>
                        <li><a href="#" class="hover:text-blue-600">Partnership</a></li>
                        <li><a href="#" class="hover:text-blue-600">Business Relation</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-gray-800 mb-4">Community</h5>
                    <ul class="space-y-2 text-gray-500">
                        <li><a href="#" class="hover:text-blue-600">Events</a></li>
                        <li><a href="#" class="hover:text-blue-600">Blog</a></li>
                        <li><a href="#" class="hover:text-blue-600">Podcast</a></li>
                        <li><a href="#" class="hover:text-blue-600">Invite a friend</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-gray-800 mb-4">Social</h5>
                    <ul class="space-y-2 text-gray-500">
                        <li><a href="#" class="hover:text-blue-600">Discord</a></li>
                        <li><a href="#" class="hover:text-blue-600">Instagram</a></li>
                        <li><a href="#" class="hover:text-blue-600">Twitter</a></li>
                        <li><a href="#" class="hover:text-blue-600">Facebook</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 border-t border-gray-100 pt-6">
            <p>&copy; 2026 RideU. All rights reserved</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-600">Privacy & Policy</a>
                <a href="#" class="hover:text-gray-600">Terms & Condition</a>
            </div>
        </div>
    </footer>

</body>
</html>