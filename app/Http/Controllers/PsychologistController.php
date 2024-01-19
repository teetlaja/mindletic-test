<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psychologist;

class PsychologistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:100',
    ]);

    $psychologist = Psychologist::create([
        'name' => $validatedData['name'],
    ]);

    return response()->json(['psychologist' => $psychologist], 201);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $psychologist = Psychologist::find($id);

        if (!$psychologist) {
            return response()->json(['message' => 'Psychologist not found'], 404);
        }

        return response()->json(['psychologist' => $psychologist], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
