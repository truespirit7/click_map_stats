<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'url' => 'required|url|max:255',
        //     'tracking_id' => 'required|string|max:255|unique:sites,tracking_id',
        // ]);

        // $site = Site::create($request->all());



        // $site = Site::create(
        //     [
        //         'name' => 'Тестовый сайт',
        //         'url' => 'test-site.com',
        //         'tracking_id' =>'SITE-zfg35325gfgf',
        //     ]
        // );

        // return response()->json($site, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
