<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GoldPrice;
use Carbon\Carbon;

class GoldPriceController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        // First try to get today's prices
        $goldPrices = GoldPrice::whereDate('created_at', $today)
            ->orderBy('type')
            ->orderBy('gold_type')
            ->get();

        // If no prices for today, get the latest prices
        if ($goldPrices->isEmpty()) {
            $lastUpdate = GoldPrice::latest('created_at')->first()?->created_at;
            if ($lastUpdate) {
                $goldPrices = GoldPrice::whereDate('created_at', $lastUpdate)
                    ->orderBy('type')
                    ->orderBy('gold_type')
                    ->get();
            }
        } else {
            $lastUpdate = $today;
        }

        return view('frontend.gold.index', compact('goldPrices', 'today', 'lastUpdate'));
    }

    public function history($type, $goldType)
    {
        $history = GoldPrice::where('type', $type)
            ->where('gold_type', $goldType)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $title = ucfirst($type) . ' ' . strtoupper($goldType) . ' Gold';

        return view('frontend.gold.history', [
            'history' => $history,
            'type' => $type,
            'goldType' => $goldType,
            'title' => $title
        ]);
    }
} 