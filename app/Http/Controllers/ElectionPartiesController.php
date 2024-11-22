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
        $election_parties = ElectionParties::distinct('election_id')->get();
        return view('election_parties.index',compact('election_parties'));
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
            'party_id.*' => 'required|exists:parties,id',
        ]);

        $validated['party_id'] = array_unique($validated['party_id']);
        

        if(count($validated['party_id']) < 2){
            return redirect()->back()->with('error', 'Please select at least 2 parties for election.');
        }

        $electionParties = [];
        foreach($validated['party_id'] as $party_id){
            $electionParties[] = [
                'election_id' => $validated['election_id'],
                'party_id' => $party_id,
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
                ElectionParties::insert($electionParties);


        return redirect()->route('election_parties.index')->with('success', 'Election parties added successfully.');

    }
    

    /**
     * Display the specified resource.
     */
    public function show(ElectionParties $election_parties)
    {
        return view('election_parties.show', compact('election_parties'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $election_parties)
    {
        $election_parties = ElectionParties::find($election_parties);
        $elections = Election::all(); 
        $partys = Party::all();
        return view('election_parties.edit', compact('election_parties', 'elections', 'partys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ElectionParties $election_parties)
    {
        // Validate the input
    $validated = $request->validate([
        'election_id' => 'required|exists:elections,id',
        // 'party_id' => 'required|array|min:2',
        'party_id.*' => 'exists:parties,id',
    ]);

    // Update the election ID for the current election party
    $election_party->election_id = $validated['election_id'];
    $election_party->save();

    // Update the associated parties
    $election_party->parties()->sync($validated['party_id']); // Sync handles updating relationships

    return redirect()->route('election_parties.index')->with('success', 'Election parties updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectionParties $election_parties)
    {
        //
    }

}
