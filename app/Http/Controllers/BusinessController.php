<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use App\Models\Psychologist;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Business::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $user = User::find($request->user()->id);
        
        // Currently we hardcode the user id since we are not having the authentication
        $user = User::find(1);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $business = new Business;
        $business->name = $request->name;
        $business->owner_id = $user->id;
        $business->save();

        return $business;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Business::findOrFail($id);
    }

    /**
     * Add an employee to the business.
     */
    // TODO: Must be fixed the request input and id handling from route to here is wrong
    public function addEmployee(Request $request, string $id)
    {
        $business = Business::findOrFail($id);
        $user = User::findOrFail($request->user_id);

        $business->employees()->attach($user);

        return $business;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

