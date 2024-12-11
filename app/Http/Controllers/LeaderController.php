<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use App\Models\Party;
use App\Models\Election;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parties = Party::all();
        $elections = Election::all();
        $leaders = Leader::all();
        return view('leaders.index',compact('leaders','parties','elections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = Party::all();
        $elections = Election::all();
        return view('leaders.create',compact('parties','elections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $validated = $request->validate([
            'name' => 'required|string|max:255',
            'party_id' => 'required||exists:parties,id',
            'election_id' => 'required|exists:elections,id',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        $logoPath = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $logoPath;
     
        Leader::create($validated);

        return redirect()->route('leaders.index')->with('success', 'Leader added successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Leader $leader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leader $leader)
    {
        $parties = Party::all();
        $elections = Election::all();
        return view('leaders.edit',compact('leader','parties','elections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leader $leader)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'party_id' => 'required||exists:parties,id',
            'election_id' => 'required|exists:elections,id',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if a new logo is uploaded
        if ($request->hasFile('logo')) {
            // Delete the old logo from storage if it exists
            if ($party->logo && file_exists(storage_path('app/public/' . $party->logo))) {
                unlink(storage_path('app/public/' . $party->logo));
            }

            // Store the new logo and get the file path
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }
    

        $leader->update($validated);

        return redirect()->route('leaders.index')->with('success', 'Leader updated successfully.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leader $leader)
    {
        $leader->delete();
        return redirect()->route('leaders.index')->with('success', 'Leader deleted successfully.');
    }
}
