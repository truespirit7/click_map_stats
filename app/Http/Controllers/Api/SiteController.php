<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ClickService;

class SiteController extends Controller
{

    protected $clickService;

    // Вариант 1: Через конструктор (рекомендуется)
    public function __construct(ClickService $clickService)
    {
        $this->clickService = $clickService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Site::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'url' => 'required|url|max:255|unique:sites,url',
        ]);

        $site = Site::create([
            'url' => $request->url,
        ]);

        return response()->json($site, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $clicks = $site->clicks()->get();

        return response()->json($clicks);
    }

    // for activity chart
    public function activity(Site $site)
    {
        $clicks = $this->clickService->getClicksBySiteIdAndHour($site->tracking_id, now()->format('Y-m-d'));
        return response()->json($clicks);
    }

    // for click map
    public function clickMap(Site $site)
    {
        $clickMapData = $this->clickService->getClickMapData($site->tracking_id);
        return response()->json($clickMapData);
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
