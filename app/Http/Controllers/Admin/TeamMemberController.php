<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of team members.
     */
    public function index(): View
    {
        $teamMembers = TeamMember::ordered()->get();

        return view('admin.team-members.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create(): View
    {
        return view('admin.team-members.create');
    }

    /**
     * Store a newly created team member.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('team', 'uploads');
        }

        $validated['is_active'] = $request->has('is_active');

        TeamMember::create($validated);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    /**
     * Update the specified team member.
     */
    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('team', 'uploads');
        }

        $validated['is_active'] = $request->has('is_active');

        $teamMember->update($validated);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified team member.
     */
    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
