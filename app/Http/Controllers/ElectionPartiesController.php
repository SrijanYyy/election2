<?php

namespace App\Http\Controllers;

use App\Models\ElectionParties;
use App\Models\Party;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionPartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $election_parties = ElectionParties::all();
        $elections = Election::all();
        $partys = Party::all();
        return view('election_parties.index', compact('election_parties', 'elections', 'partys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partys = Party::all();
        $elections = Election::all();
        return view('election_parties.create', compact('partys', 'elections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'election_id' => 'required|exists:elections,id',
            'party_id' => 'required|array|min:2', // Require at least 2 parties
            'party_id.*' => 'exists:parties,id',
        ]);

        $validated['party_id'] = array_unique($validated['party_id']); // Remove duplicates

        // Attach each party to the election (avoiding duplicates in DB)
        foreach ($validated['party_id'] as $party_id) {
            ElectionParties::firstOrCreate([
                'election_id' => $validated['election_id'],
                'party_id' => $party_id,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('election_parties.index')->with('success', 'Election parties added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectionParties $election_party)
    {
        $partys = Party::all();
        $elections = Election::all();
        
        if ($election_party->parties === null) {
            $election_party->parties = collect();
        }
        return view('election_parties.edit', compact('election_party', 'partys', 'elections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Fetch the election-party relationship
        $election_party = ElectionParties::findOrFail($id);

        // Validate the input
        $validated = $request->validate([
            'election_id' => 'required|exists:elections,id',
            'party_id' => 'required|array|min:2', // Require at least 2 parties
            'party_id.*' => 'exists:parties,id',
        ]);

        // Remove duplicates in party IDs
        $validated['party_id'] = array_unique($validated['party_id']);

        // Update the election ID
        $election_party->update(['election_id' => $validated['election_id']]);

        // Update the associated parties
        $election_party->parties()->sync($validated['party_id']); // Sync will update, attach, or detach relationships

        return redirect()->route('election_parties.index')->with('success', 'Election parties updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the election_party record
    $election_party = ElectionParties::findOrFail($id);

    // Simply delete the record (no detach necessary for belongsTo)
    $election_party->delete();

    return redirect()->route('election_parties.index')->with('success', 'Election party deleted successfully.');
}

}
