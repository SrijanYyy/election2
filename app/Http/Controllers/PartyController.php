<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        $partys = Party::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(5);
        return view('partys.index',compact('partys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partys.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $logoPath = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $logoPath;
    
        Party::create($validated);
        return redirect()->route('partys.index')->with('success', 'Party created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        return view('partys.edit', compact('party'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Party $party)
    {
         // Validate incoming request
         $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional logo, must be an image if provided
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

        // Update party with validated data (including new logo if uploaded)
        $party->update($validated);

        return redirect()->route('partys.index')->with('success', 'Party updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
{
    $party->delete();

    return redirect()->route('partys.index')->with('success', 'Party deleted successfully');
}
}

