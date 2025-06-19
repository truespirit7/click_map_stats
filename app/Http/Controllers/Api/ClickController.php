<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Click;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
             'x' => 'required|integer',
             'y' => 'required|integer',
         ]);

        $click = Click::create($request->all());

        return response()->json($click, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Click $click)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Click $click)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Click $click)
    {
        //
    }
}
