<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->paginate(10);
        return view('admin.Achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'issuer' => 'nullable|string|max:255',
            'issued_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url',
            'category' => 'nullable|string|max:100'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('achievements', 'public');
            $data['image'] = $path;
        }

        Achievement::create($data);

        return redirect()->route('admin.achievements.index')
                         ->with('success', 'Achievement berhasil ditambahkan!');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'issuer' => 'nullable|string|max:255',
            'issued_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url',
            'category' => 'nullable|string|max:100'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($achievement->image && Storage::disk('public')->exists($achievement->image)) {
                Storage::disk('public')->delete($achievement->image);
            }
            $path = $request->file('image')->store('achievements', 'public');
            $data['image'] = $path;
        }

        $achievement->update($data);

        return redirect()->route('admin.achievements.index')
                         ->with('success', 'Achievement berhasil diperbarui!');
    }

    public function destroy(Achievement $achievement)
    {
        // Hapus gambar jika ada
        if ($achievement->image && Storage::disk('public')->exists($achievement->image)) {
            Storage::disk('public')->delete($achievement->image);
        }

        $achievement->delete();

        return redirect()->route('admin.achievements.index')
                         ->with('success', 'Achievement berhasil dihapus!');
    }
}
