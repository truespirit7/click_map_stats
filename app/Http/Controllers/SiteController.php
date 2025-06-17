<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\SiteController as ApiSiteController;

class SiteController extends Controller
{
    public function index()
    {

        return view('sites.index');
    }
    public function activity($id)
    {
        $site = Site::findOrFail($id);
        return view('sites.activity', compact('site'));
    }

    public function clickMap($id)
    {
        $site = Site::findOrFail($id);
        return view('sites.clickmap', compact('site'));
    }

}
