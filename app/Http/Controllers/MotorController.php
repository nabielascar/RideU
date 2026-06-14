<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

use App\Models\Rental;

class MotorController extends Controller
{
    public function index()
    {
        // Get popular/first 4 available motors
        $motors = Motor::where('status', 'available')->take(4)->get();
        
        // If we don't have enough, just take any 4
        if ($motors->count() < 4) {
            $motors = Motor::take(4)->get();
        }

        return view('welcome', compact('motors'));
    }

    public function list(Request $request)
    {
        $query = Motor::query();

        // Simple search filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // Type filter (if passed)
        if ($request->filled('type')) {
            $types = $request->type;
            if (is_array($types)) {
                $query->whereIn('type', $types);
            } else {
                $query->where('type', $types);
            }
        }

        // Price filter (if passed)
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort filter (if passed)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        } else {
            $query->orderBy('id', 'desc');
        }

        $motors = $query->get();

        // Get counts for each type to display in the sidebar
        $typeCounts = Motor::select('type', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        return view('list', compact('motors', 'typeCounts'));
    }

    public function show($id)
    {
        $motor = Motor::findOrFail($id);
        
        // Fetch similar motors of the same type/brand, excluding the current one
        $similar_motors = Motor::where('id', '!=', $id)
            ->where(function ($query) use ($motor) {
                $query->where('type', $motor->type)
                      ->orWhere('brand', $motor->brand);
            })
            ->take(3)
            ->get();

        if ($similar_motors->isEmpty()) {
            $similar_motors = Motor::where('id', '!=', $id)->take(3)->get();
        }

        return view('details', compact('motor', 'similar_motors'));
    }

    public function order($id)
    {
        $motor = Motor::findOrFail($id);
        
        if ($motor->status !== 'available') {
            return redirect()->back()->with('error', 'Motor ini sedang tidak tersedia untuk disewa.');
        }

        return view('order', compact('motor'));
    }

    public function payment(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);
        
        $orderData = $request->only([
            'customer_name', 'phone_number', 'address', 'city',
            'pickup_location', 'pickup_date', 'pickup_time', 'duration'
        ]);

        $duration = max(1, intval($request->input('duration', 1)));
        $totalPrice = $motor->price * $duration;
        $formattedTotal = 'Rp. ' . number_format($totalPrice, 0, ',', '.');

        return view('payment', compact('motor', 'orderData', 'formattedTotal'));
    }

    public function rent(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);
        
        // Handle payment receipt upload
        $receiptImageName = null;
        if ($request->hasFile('payment_receipt')) {
            $file = $request->file('payment_receipt');
            $receiptImageName = time() . '_receipt.' . $file->getClientOriginalExtension();
            
            // Create receipts directory if not exists
            if (!file_exists(public_path('receipts'))) {
                mkdir(public_path('receipts'), 0777, true);
            }
            $file->move(public_path('receipts'), $receiptImageName);
        }

        $duration = max(1, intval($request->input('duration', 1)));
        $totalPrice = $motor->price * $duration;

        // Create rental record
        Rental::create([
            'user_id' => auth()->id(),
            'motor_id' => $motor->id,
            'customer_name' => $request->input('customer_name') ?? auth()->user()->name,
            'phone_number' => $request->input('phone_number') ?? '-',
            'address' => $request->input('address'),
            'city' => $request->input('city') ?? '-',
            'pickup_location' => $request->input('pickup_location') ?? '-',
            'pickup_date' => $request->input('pickup_date') ?? now()->toDateString(),
            'pickup_time' => $request->input('pickup_time') ?? '08:00',
            'duration' => $duration,
            'total_price' => $totalPrice,
            'receipt_image' => $receiptImageName,
            'status' => 'active',
        ]);

        // Set motor status to rented
        $motor->status = 'rented';
        $motor->save();

        return redirect()->route('home')->with('success', 'Motor ' . $motor->name . ' berhasil disewa!');
    }

    public function profile()
    {
        $rentals = Rental::where('user_id', auth()->id())
            ->with('motor')
            ->latest()
            ->get();

        return view('profile', compact('rentals'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar oleh pengguna lain.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
