<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Party;
use Illuminate\Http\Request;

class ElectionPartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch elections with their associated parties
        $election_parties = Election::with('parties')->get();
        $parties=Party::all();
        $elections=Election::all();
        return view('election_parties.index', compact('election_parties','parties','elections'));
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
            'party_id' => 'required|array|min:2',
            'party_id.*' => 'exists:parties,id',
        ]);

        $election = Election::find($validated['election_id']);
        $election->parties()->sync($validated['party_id']); // Sync the parties for the election

        return redirect()->route('election_parties.index')->with('success', 'Election parties added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        

        return redirect()->route('election_parties.index')->with('success', 'Election and its parties deleted successfully.');
    }
}
