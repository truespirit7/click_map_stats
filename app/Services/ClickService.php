<?php

namespace App\Services;

use App\Models\Click;
use Illuminate\Support\Facades\DB;

class ClickService
{
    public function getClicksBySiteIdAndHour($siteTrackingId)
    {
        $clicks = Click::where('site_tracking_id', $siteTrackingId)->get();
        
        $clicksByHours = $clicks->groupBy(function ($item) {
            return $item->created_at->format('H'); 
        })->map(function ($group) {
            return count($group);
        })->toArray();

        // Заполняем пустые часы нулями
        foreach (range(0, 23) as $hour) {
            if (!isset($clicksByHours[$hour])) {
                $clicksByHours[$hour] = 0;
            }
        }
        return $clicksByHours;

    }

    public function getClickMapData($siteId)
    {
        return Click::select(DB::raw('count(*) as click_count, x, y'))
            ->where('site_tracking_id', $siteId)
            ->groupBy('x', 'y')
            ->get();
    }
}
    