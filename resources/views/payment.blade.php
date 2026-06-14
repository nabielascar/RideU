<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideU - Payment</title>
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

    <main class="max-w-7xl mx-auto px-6 md:px-12 mt-8 flex flex-col lg:flex-row gap-8 pb-20">
        
        <div class="w-full lg:w-2/3">
            <section class="bg-white rounded-xl shadow-sm p-6 md:p-8 border border-gray-100 mb-8">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-1">Payment Method</h2>
                        <p class="text-xs text-gray-400">Please enter your payment method</p>
                    </div>
                    <span class="text-xs text-gray-400 font-semibold">Step 4 of 5</span>
                </div>

                <div class="space-y-4">
                    <!-- QRIS -->
                    <label class="flex justify-between items-center bg-gray-50 rounded-xl p-6 border-2 border-blue-600 mb-4 cursor-pointer hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="payment_method" value="qris" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <div>
                                <span class="font-bold text-gray-800 text-sm">QRIS</span>
                                <p class="text-[10px] text-gray-400">Bayar instan menggunakan saldo e-wallet / mobile banking</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-qrcode text-blue-600 text-3xl"></i>
                    </label>

                    <!-- Bank BCA -->
                    <label class="flex justify-between items-center bg-gray-50 rounded-xl p-6 border border-gray-100 mb-4 cursor-pointer hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="payment_method" value="bca" class="w-5 h-5 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <div>
                                <span class="font-bold text-gray-800 text-sm">Transfer Bank BCA</span>
                                <p class="text-[10px] text-gray-400">No. Rekening: 7712048991 a/n RideU Motor</p>
                            </div>
                        </div>
                        <span class="text-xs font-black text-blue-700 bg-white border px-3 py-1.5 rounded-lg shadow-sm">BCA</span>
                    </label>

                    <!-- Bank Mandiri -->
                    <label class="flex justify-between items-center bg-gray-50 rounded-xl p-6 border border-gray-100 mb-4 cursor-pointer hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="payment_method" value="mandiri" class="w-5 h-5 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <div>
                                <span class="font-bold text-gray-800 text-sm">Transfer Bank Mandiri</span>
                                <p class="text-[10px] text-gray-400">No. Rekening: 1310029384992 a/n RideU Motor</p>
                            </div>
                        </div>
                        <span class="text-xs font-black text-blue-500 bg-white border px-2 py-1.5 rounded-lg shadow-sm">mandırı</span>
                    </label>

                    <!-- Bank BNI / BRI -->
                    <label class="flex justify-between items-center bg-gray-50 rounded-xl p-6 border border-gray-100 mb-4 cursor-pointer hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="payment_method" value="bni_bri" class="w-5 h-5 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <div>
                                <span class="font-bold text-gray-800 text-sm">Transfer Bank BNI / BRI</span>
                                <p class="text-[10px] text-gray-400">No. Rekening: 0392948399 a/n RideU Motor</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-orange-600 bg-white border px-3 py-1.5 rounded-lg shadow-sm">BNI/BRI</span>
                    </label>
                </div>
            </section>

            <section class="bg-white rounded-xl shadow-sm p-6 md:p-8 border border-gray-100">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-1">Confirmation</h2>
                        <p class="text-xs text-gray-400">We are getting to the end. Just few clicks and your rental is ready!</p>
                    </div>
                    <span class="text-xs text-gray-400 font-semibold">Step 5 of 5</span>
                </div>

                <form id="payment_form" action="{{ route('motors.rent', $motor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="customer_name" value="{{ $orderData['customer_name'] ?? '' }}">
                    <input type="hidden" name="phone_number" value="{{ $orderData['phone_number'] ?? '' }}">
                    <input type="hidden" name="address" value="{{ $orderData['address'] ?? '' }}">
                    <input type="hidden" name="city" value="{{ $orderData['city'] ?? '' }}">
                    <input type="hidden" name="pickup_location" value="{{ $orderData['pickup_location'] ?? '' }}">
                    <input type="hidden" name="pickup_date" value="{{ $orderData['pickup_date'] ?? '' }}">
                    <input type="hidden" name="pickup_time" value="{{ $orderData['pickup_time'] ?? '' }}">
                    <input type="hidden" name="duration" value="{{ $orderData['duration'] ?? 1 }}">
                    
                    <!-- Upload Bukti Pembayaran -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 mb-6">
                        <h3 class="text-xs font-bold text-gray-800 mb-2 uppercase tracking-wider">Upload Bukti Pembayaran</h3>
                        <p class="text-[11px] text-gray-400 mb-4">Silakan transfer sesuai metode pembayaran yang Anda pilih, lalu unggah bukti transfernya di bawah ini.</p>
                        <label for="payment_receipt" class="bg-white border border-dashed border-gray-200 rounded-xl p-6 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100/50 transition relative block">
                            <input type="file" id="payment_receipt" name="payment_receipt" class="hidden" accept="image/*" required>
                            <div class="bg-gray-50 p-3 rounded-xl shadow-sm border border-gray-100 mb-2 text-gray-500">
                                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                            </div>
                            <span id="receipt_filename" class="text-xs font-bold text-gray-600 text-center break-all">Klik untuk unggah Bukti Transfer</span>
                        </label>
                    </div>

                    <div class="space-y-4 mb-8">
                        <label class="flex items-center space-x-4 bg-gray-50 rounded-xl p-4 border border-gray-100 cursor-pointer">
                            <input type="checkbox" id="marketing_checkbox" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="text-sm text-gray-600 font-semibold">Saya setuju untuk menerima info promosi dan email newsletter RideU.</span>
                        </label>
                        <label class="flex items-center space-x-4 bg-gray-50 rounded-xl p-4 border border-gray-100 cursor-pointer">
                            <input type="checkbox" id="agree_terms" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="text-sm text-gray-600 font-semibold">Saya menyetujui seluruh syarat dan ketentuan serta kebijakan privasi RideU.</span>
                        </label>
                    </div>

                    <button type="submit" id="btn_pay" disabled class="w-full sm:w-auto bg-gray-400 text-white font-bold py-4 px-8 rounded-lg shadow-md transition text-sm mb-8 opacity-50 cursor-not-allowed">
                        Bayar Sekarang
                    </button>
                </form>
            </section>
        </div>

        <div class="w-full lg:w-1/3">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 sticky top-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Order Details</h2>

                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-24 h-20 bg-blue-600 rounded-lg flex items-center justify-center p-2 relative overflow-hidden">
                        <img src="{{ asset('images/' . $motor->image) }}" alt="{{ $motor->name }}" class="relative z-10 w-full h-full object-contain">
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-gray-900">{{ $motor->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">Rp. {{ number_format($motor->price, 0, ',', '.') }} / hari</p>
                    </div>
                </div>

                <hr class="border-gray-100 mb-6">

                <h3 class="text-sm font-bold text-gray-900 mb-3">Billing Info</h3>
                <div class="text-sm text-gray-600 mb-6 space-y-2">
                    <p class="flex justify-between"><span class="text-gray-400">Name:</span> <span class="font-semibold text-gray-800">{{ $orderData['customer_name'] ?? '-' }}</span></p>
                    <p class="flex justify-between"><span class="text-gray-400">Phone:</span> <span class="font-semibold text-gray-800">{{ $orderData['phone_number'] ?? '-' }}</span></p>
                    <p class="flex justify-between"><span class="text-gray-400">City:</span> <span class="font-semibold text-gray-800">{{ $orderData['city'] ?? '-' }}</span></p>
                </div>

                <h3 class="text-sm font-bold text-gray-900 mb-3">Rental Info</h3>
                <div class="text-sm text-gray-600 mb-6 space-y-2">
                    <p class="flex justify-between"><span class="text-gray-400">Location:</span> <span class="font-semibold text-gray-800">{{ $orderData['pickup_location'] ?? '-' }}</span></p>
                    <p class="flex justify-between"><span class="text-gray-400">Date:</span> <span class="font-semibold text-gray-800">{{ $orderData['pickup_date'] ?? '-' }}</span></p>
                    <p class="flex justify-between"><span class="text-gray-400">Time:</span> <span class="font-semibold text-gray-800">{{ $orderData['pickup_time'] ?? '-' }}</span></p>
                    <p class="flex justify-between"><span class="text-gray-400">Duration:</span> <span class="font-semibold text-gray-800">{{ $orderData['duration'] ?? '1' }} Days</span></p>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg mt-6">
                    <div class="flex justify-between items-end">
                        <h3 class="text-sm font-bold text-blue-900">Total Payment</h3>
                        <div class="text-xl font-extrabold text-blue-700">Rp. {{ $formattedTotal }}</div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- Success Modal Popup -->
    <div id="success_modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/70 backdrop-blur-md transition-opacity duration-300 opacity-0">
        <div id="success_card" class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl flex flex-col items-center justify-center text-center transform scale-90 transition-all duration-300 opacity-0">
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mb-6 animate-bounce">
                <i class="fa-solid fa-circle-check text-5xl text-emerald-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h2>
            <p class="text-sm text-gray-500 leading-relaxed">Terima kasih, pembayaran Anda telah dikonfirmasi dan motor berhasil disewa.</p>
            <div class="mt-6 flex items-center space-x-2 text-xs text-blue-600 font-bold">
                <i class="fa-solid fa-circle-notch animate-spin"></i>
                <span>Mengalihkan ke beranda...</span>
            </div>
        </div>
    </div>

    <!-- Script to handle validation locking and pop up animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agreeTerms = document.getElementById('agree_terms');
            const paymentReceipt = document.getElementById('payment_receipt');
            const receiptFilename = document.getElementById('receipt_filename');
            const btnPay = document.getElementById('btn_pay');
            const paymentForm = document.getElementById('payment_form');
            const successModal = document.getElementById('success_modal');
            const successCard = document.getElementById('success_card');

            function updateButtonState() {
                const isTermsChecked = agreeTerms.checked;
                const isFileUploaded = paymentReceipt.files.length > 0;

                if (isTermsChecked && isFileUploaded) {
                    btnPay.removeAttribute('disabled');
                    btnPay.classList.remove('bg-gray-400', 'opacity-50', 'cursor-not-allowed');
                    btnPay.classList.add('bg-blue-600', 'hover:bg-blue-700', 'opacity-100', 'cursor-pointer');
                } else {
                    btnPay.setAttribute('disabled', 'true');
                    btnPay.classList.add('bg-gray-400', 'opacity-50', 'cursor-not-allowed');
                    btnPay.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'opacity-100', 'cursor-pointer');
                }
            }

            // Handle checkbox change
            agreeTerms.addEventListener('change', updateButtonState);

            // Handle file input change and show filename
            paymentReceipt.addEventListener('change', function() {
                if (this.files.length > 0) {
                    receiptFilename.textContent = "Terpilih: " + this.files[0].name;
                    receiptFilename.classList.remove('text-gray-600');
                    receiptFilename.classList.add('text-emerald-600');
                } else {
                    receiptFilename.textContent = "Klik untuk unggah Bukti Transfer";
                    receiptFilename.classList.remove('text-emerald-600');
                    receiptFilename.classList.add('text-gray-600');
                }
                updateButtonState();
            });

            // Handle radio payment selection styles
            const radioButtons = document.querySelectorAll('input[name="payment_method"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    radioButtons.forEach(r => {
                        const parent = r.closest('label');
                        if (parent) {
                            parent.classList.remove('border-blue-600', 'border-2');
                            parent.classList.add('border-gray-100', 'border');
                        }
                    });
                    const parent = this.closest('label');
                    if (parent) {
                        parent.classList.remove('border-gray-100', 'border');
                        parent.classList.add('border-blue-600', 'border-2');
                    }
                });
            });

            // Handle submit form event, show popup animation, then submit
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Intercept standard post submit

                // Show modal with animation
                successModal.classList.remove('hidden');
                successModal.classList.add('flex');
                
                // Allow browser to render layout display, then animate
                setTimeout(() => {
                    successModal.classList.add('opacity-100');
                    successCard.classList.remove('scale-90', 'opacity-0');
                    successCard.classList.add('scale-100', 'opacity-100');
                }, 10);

                // Wait 2.5 seconds, then submit form to process DB update & redirection
                setTimeout(() => {
                    paymentForm.submit();
                }, 2500);
            });
        });
    </script>
</body>
</html>