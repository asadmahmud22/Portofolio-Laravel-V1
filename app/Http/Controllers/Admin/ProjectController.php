<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    // ================= CREATE =================
    public function create()
    {
        return view('admin.projects.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
            'url' => $request->url,
            'github_url' => $request->github_url,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $project->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
            'url' => $request->url,
            'github_url' => $request->github_url,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        Project::destroy($id);
        return back()->with('success', 'Project berhasil dihapus');
    }
}