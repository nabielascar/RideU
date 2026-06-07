<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use Illuminate\Http\Request;

class AdminMotorController extends Controller
{
    public function index()
    {
        $motors = Motor::latest()->get();
        return view('admin.dashboard', compact('motors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'fuel' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc' => 'nullable|string',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            // Default to genio.jpg or another if not uploaded
            $imageName = 'genio.jpg';
        }

        Motor::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'price' => $request->price,
            'fuel' => $request->fuel ?? '4L',
            'transmission' => $request->transmission ?? 'Matic',
            'image' => $imageName,
            'status' => 'available',
            'desc' => $request->desc,
        ]);

        return redirect()->back()->with('success', 'Motor baru berhasil ditambahkan!');
    }

    public function toggleStatus($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->status = ($motor->status === 'available') ? 'rented' : 'available';
        $motor->save();

        return redirect()->back()->with('success', 'Status motor ' . $motor->name . ' berhasil diperbarui!');
    }
}
