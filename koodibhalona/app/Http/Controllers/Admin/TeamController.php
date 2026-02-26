<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->get();
        return view('admin.teams.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('teams', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', 0);

        TeamMember::create($data);

        return redirect()->route('admin.teams.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo_path) {
                Storage::disk('public')->delete($team->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('teams', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $team->update($data);

        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo_path) {
            Storage::disk('public')->delete($team->photo_path);
        }
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }
}
