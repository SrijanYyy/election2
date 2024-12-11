<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Party;
use App\Models\Leader;


class VoteController extends Controller
{
    public function index()
    {
        $parties = Party::all();
        $leaders = Leader::all();
        // Get the authenticated user's ID
        $userId = auth()->id();

         // Check if the user has already voted
         $hasVoted = Vote::where('user_id', $userId)->exists();
        return view('vote.index', compact('parties', 'leaders', 'hasVoted'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request to ensure proper data
        $request->validate([
            'party_id' => 'required|exists:parties,id',
            'leader_id' => 'required|exists:leaders,id',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Get the party ID from the request
        $partyId = $request->party_id;

        // Check if the user has already voted for the same party
        $existingVote = Vote::where('user_id', $userId)
                            ->where('party_id', $partyId)
                            ->first();

        if ($existingVote) {
            // Redirect back with an error message if the user already voted
            return redirect()->route('voting.index')->with('error', 'You have already voted for this party.');
        }

        // Create the vote record
        Vote::create([
            'user_id' => $userId,
            'party_id' => $partyId,
            'leader_id' => $request->leader_id,
        ]);

        // Redirect back with a success message
        return redirect()->route('voting.index')->with('success', 'Vote cast successfully.');
    }

    //vote results
    public function results()
{
    $results = Vote::select('leaders.name as leader_name', 'parties.name as party_name', \DB::raw('COUNT(votes.id) as total_votes'))
        ->join('leaders', 'votes.leader_id', '=', 'leaders.id')
        ->join('parties', 'votes.party_id', '=', 'parties.id')
        ->groupBy('leaders.name', 'parties.name')
        ->orderBy('total_votes', 'DESC')
        ->get();

    return view('vote.results', compact('results'));
}

}
