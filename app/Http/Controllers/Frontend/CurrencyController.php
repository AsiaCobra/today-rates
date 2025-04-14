<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\GoldPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $today = today();
        $currencies = Currency::whereDate('created_at', $today)
            ->orderBy('currency_code')
            ->get();

        $lastUpdate = Currency::latest('created_at')->first()?->created_at;

        // Get gold prices
        $goldPrices = GoldPrice::whereDate('created_at', $today)
            ->orderBy('type')
            ->orderBy('gold_type')
            ->get();

        // If no gold prices for today, get the latest prices
        if ($goldPrices->isEmpty()) {
            $goldLastUpdate = GoldPrice::latest('created_at')->first()?->created_at;
            if ($goldLastUpdate) {
                $goldPrices = GoldPrice::whereDate('created_at', $goldLastUpdate)
                    ->orderBy('type')
                    ->orderBy('gold_type')
                    ->get();
            }
        }

        return view('frontend.currency.index', compact('currencies', 'today', 'lastUpdate', 'goldPrices'));
    }

    public function history($currencyCode)
    {
        $currency = Currency::where('currency_code', $currencyCode)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $currencyName = Currency::CURRENCY_CODE_SELECT[$currencyCode] ?? $currencyCode;

        return view('frontend.currency.history', [
            'currency' => $currency,
            'currencyCode' => $currencyCode,
            'currencyName' => $currencyName,
        ]);
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function privacy()
    {
        return view('frontend.pages.privacy');
    }
} 