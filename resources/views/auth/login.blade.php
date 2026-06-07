<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideU - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row border border-gray-100 min-h-[550px]">
        
        <!-- Left Side: Banner info -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 p-8 sm:p-12 text-white flex flex-col justify-between relative overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.5) 10px, rgba(255,255,255,0.5) 20px);"></div>
            <i class="fa-solid fa-motorcycle absolute -right-10 -bottom-10 text-9xl opacity-10 transform -rotate-12"></i>
            
            <div class="relative z-10">
                <a href="/" class="text-3xl font-extrabold tracking-tight">RideU</a>
            </div>
            
            <div class="my-auto py-8 relative z-10">
                <h2 class="text-3xl font-bold mb-4 leading-tight">Solusi Sewa Motor Terbaik Sekitar Kampus</h2>
                <p class="text-blue-100 text-sm leading-relaxed">Nikmati perjalanan Anda dengan unit motor terawat, proses sewa cepat secara online, dan harga mahasiswa yang ramah di kantong.</p>
            </div>
            
            <div class="flex items-center space-x-4 text-xs text-blue-200 relative z-10">
                <span><i class="fa-solid fa-shield-halved mr-1"></i> Aman & Terpercaya</span>
                <span>•</span>
                <span><i class="fa-solid fa-bolt mr-1"></i> Instan Sewa</span>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-between">
            <div>
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h1>
                    <p class="text-xs text-gray-400">Silakan masuk menggunakan akun RideU Anda.</p>
                </div>

                <!-- Session Status / Alerts -->
                @if(session('status'))
                    <div class="bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-xl p-4 text-xs font-semibold mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="bg-red-50 text-red-600 border border-red-200 rounded-xl p-4 text-xs font-semibold mb-6 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="username@email.com" class="w-full bg-gray-50 border border-gray-100 pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:bg-white transition" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-600">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input id="password" type="password" name="password" placeholder="Masukkan password" class="w-full bg-gray-50 border border-gray-100 pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:bg-white transition" required autocomplete="current-password">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <label class="flex items-center space-x-2 cursor-pointer pt-1">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500 cursor-pointer">
                        <span class="text-xs text-gray-500 font-semibold">Ingat saya di perangkat ini</span>
                    </label>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 rounded-xl transition shadow-md shadow-blue-500/10 mt-6 text-sm">
                        Masuk Sekarang
                    </button>
                </form>
            </div>

            <div class="text-center text-xs text-gray-400 mt-8">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</a>
            </div>
        </div>

    </div>

</body>
</html>
