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
        //
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
