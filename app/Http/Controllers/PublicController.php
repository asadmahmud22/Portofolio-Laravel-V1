<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Achievement;

class PublicController extends Controller
{
    /**
     * Data yang digunakan bersama di semua halaman
     */
    private function sharedData(): array
    {
        return [
            'profile'  => Profile::first(),
            'projects' => Project::latest()->get(),
        ];
    }

    /**
     * Halaman Home / Landing Page
     */
    public function index()
    {
        return view('public.index', $this->sharedData());
    }

    /**
     * Halaman About
     */
    public function about()
    {
        return view('public.about', $this->sharedData());
    }

    /**
     * Halaman Skills
     */
    public function skills()
    {
        return view('public.skills', $this->sharedData());
    }

    /**
     * Halaman Achievements (Sertifikat & Penghargaan)
     */
    public function achievements()
    {
        // Ambil data achievements dari database
        $achievements = Achievement::latest()
            ->orderBy('issued_date', 'desc')
            ->get();
        
        // Gabungkan dengan shared data
        $data = array_merge($this->sharedData(), compact('achievements'));
        
        return view('public.achievements', $data);
    }

    /**
     * Halaman Projects (Portofolio)
     */
    public function projects()
    {
        // Ambil data projects dari database (override yang dari sharedData)
        $projects = Project::latest()->get();
        
        // Gabungkan dengan shared data
        $data = array_merge($this->sharedData(), compact('projects'));
        
        return view('public.projects', $data);
    }

    /**
     * Halaman Contact
     */
    public function contact()
    {
        return view('public.contact', $this->sharedData());
    }

    /**
     * Proses pengiriman pesan kontak
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        // TODO: Kirim email atau simpan ke database
        // Contoh: Mail::to('admin@example.com')->send(new ContactMail($validated));
        
        // Atau simpan ke database jika ada model Contact
        // Contact::create($validated);

        // Redirect back dengan pesan sukses
        return back()->with('success', 'Pesan berhasil dikirim! Saya akan segera menghubungi kamu.');
    }
}