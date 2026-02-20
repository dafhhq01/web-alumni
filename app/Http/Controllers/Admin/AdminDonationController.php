<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class AdminDonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('author')->orderBy('created_at', 'desc')->get();
        return view('admin.donations.index', compact('donations'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'bank_details' => 'required|string',
            'description' => 'required|string',
        ]);

        Donation::create([
            'title' => $request->title,
            'description' => $request->description,
            'target_amount' => $request->target_amount,
            'collected_amount' => 0,
            'bank_details' => $request->bank_details,
            'status' => 'active',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dibuat!');
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.edit', compact('donation'));
    }

    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'collected_amount' => 'required|numeric|min:0',
            'bank_details' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,closed',
        ]);

        $donation->update($request->all());

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        
        // Menggunakan forceDelete agar data benar-benar terhapus dari database
        $donation->forceDelete();

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dihapus permanen!');
    }
}