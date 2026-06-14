<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideU - Order {{ $motor->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

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

    <main class="max-w-7xl mx-auto px-6 md:px-12 mt-8 pb-20">
        <form action="/payment/{{ $motor->id }}" method="GET" class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3 space-y-8">
                
                <section class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-1">Billing Info</h2>
                            <p class="text-xs text-gray-400">Please enter your billing info</p>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold">Step 1 of 3</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Name</label>
                            <input type="text" name="customer_name" placeholder="Your name" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Phone Number</label>
                            <input type="text" name="phone_number" placeholder="Phone number" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Address</label>
                            <input type="text" name="address" placeholder="Address" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Town / City</label>
                            <input type="text" name="city" placeholder="Town or city" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-1">Verifikasi Identitas</h2>
                            <p class="text-xs text-gray-400">Unggah foto KTP + Selfie</p>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold">Step 2 of 3</span>
                    </div>

                    <div class="space-y-6">
                        <label for="ktp_upload" class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-10 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition relative block">
                            <input type="file" id="ktp_upload" name="ktp_file" class="hidden" accept="image/*" onchange="document.getElementById('ktp_name').textContent = this.files[0].name">
                            <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 mb-3 text-gray-600">
                                <i class="fa-regular fa-id-card text-2xl"></i>
                            </div>
                            <span id="ktp_name" class="text-sm font-bold text-gray-700 text-center break-all">Upload KTP</span>
                        </label>

                        <label for="selfie_upload" class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-10 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition relative block">
                            <input type="file" id="selfie_upload" name="selfie_file" class="hidden" accept="image/*" onchange="document.getElementById('selfie_name').textContent = this.files[0].name">
                            <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 mb-3 text-gray-600">
                                <i class="fa-solid fa-camera-retro text-2xl"></i>
                            </div>
                            <span id="selfie_name" class="text-sm font-bold text-gray-700 text-center break-all">Upload Selfie</span>
                        </label>
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-1">Rental Info</h2>
                            <p class="text-xs text-gray-400">Please select your rental date</p>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold">Step 3 of 3</span>
                    </div>

                    <div class="mb-8">
                        <label class="flex items-center space-x-2 font-bold text-gray-800 mb-4">
                            <input type="radio" name="rental_type" value="pickup" checked class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span>Pick - Up</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">Locations</label>
                                <select name="pickup_location" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition text-gray-600 cursor-pointer" required>
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                    <option value="Andir">Andir</option>
                                    <option value="Antapani">Antapani</option>
                                    <option value="Arcamanik">Arcamanik</option>
                                    <option value="Astanaanyar">Astanaanyar</option>
                                    <option value="Babakan Ciparay">Babakan Ciparay</option>
                                    <option value="Bandung Kidul">Bandung Kidul</option>
                                    <option value="Bandung Kulon">Bandung Kulon</option>
                                    <option value="Bandung Wetan">Bandung Wetan</option>
                                    <option value="Batununggal">Batununggal</option>
                                    <option value="Bojongloa Kaler">Bojongloa Kaler</option>
                                    <option value="Bojongloa Kidul">Bojongloa Kidul</option>
                                    <option value="Buahbatu">Buahbatu</option>
                                    <option value="Cibeunying Kaler">Cibeunying Kaler</option>
                                    <option value="Cibeunying Kidul">Cibeunying Kidul</option>
                                    <option value="Cibiru">Cibiru</option>
                                    <option value="Cicendo">Cicendo</option>
                                    <option value="Cidadap">Cidadap</option>
                                    <option value="Cinambo">Cinambo</option>
                                    <option value="Coblong">Coblong</option>
                                    <option value="Gedebage">Gedebage</option>
                                    <option value="Kiaracondong">Kiaracondong</option>
                                    <option value="Lengkong">Lengkong</option>
                                    <option value="Mandalajati">Mandalajati</option>
                                    <option value="Panyileukan">Panyileukan</option>
                                    <option value="Rancasari">Rancasari</option>
                                    <option value="Regol">Regol</option>
                                    <option value="Sukajadi">Sukajadi</option>
                                    <option value="Sukasari">Sukasari</option>
                                    <option value="Sumur Bandung">Sumur Bandung</option>
                                    <option value="Ujungberung">Ujungberung</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">Date</label>
                                <input type="date" name="pickup_date" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition text-gray-600 cursor-pointer" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">Time</label>
                                <select name="pickup_time" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition text-gray-600 cursor-pointer" required>
                                    <option value="" disabled selected>Pilih Waktu</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">Duration (Days)</label>
                                <input type="number" name="duration" min="1" value="1" placeholder="Berapa hari?" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 transition text-gray-600" required>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Rental Summary</h2>
                    <p class="text-xs text-gray-400 mb-6 leading-relaxed">Prices may change depending on the length of the rental and the price of your rental car.</p>

                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-24 h-20 bg-blue-600 rounded-lg flex items-center justify-center p-2 relative overflow-hidden">
                            <div class="absolute inset-0 opacity-20" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(255,255,255,0.5) 5px, rgba(255,255,255,0.5) 10px);"></div>
                            <img src="{{ asset('images/' . $motor->image) }}" alt="{{ $motor->name }}" class="relative z-10 w-full h-full object-contain">
                        </div>
                        <div>
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ $motor->name }}</h3>
                            <div class="flex items-center space-x-1 text-yellow-400 text-xs mt-1">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star-half-stroke"></i>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    <div class="flex justify-between items-center text-sm mb-6">
                        <span class="text-gray-400">Base Price / Day</span>
                        <span class="font-bold text-gray-900">Rp. {{ number_format($motor->price, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-lg shadow-md hover:bg-blue-700 transition mt-6 text-sm">
                        Checkout Sekarang
                    </button>
                </div>
            </div>
        </form>
    </main>
</body>
</html>