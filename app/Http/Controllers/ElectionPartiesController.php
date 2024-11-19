<?php

namespace App\Http\Controllers;

use App\Models\election_parties;
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

        return view('election_parties.index');
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
                'party_id' => $party_id
        ];


        return redirect()->route('election_parties.index')->with('success', 'Election parties added successfully.');

    }
    }

    /**
     * Display the specified resource.
     */
    public function show(election_parties $election_parties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(election_parties $election_parties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, election_parties $election_parties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(election_parties $election_parties)
    {
        //
    }
}
