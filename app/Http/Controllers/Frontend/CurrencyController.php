<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
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

        return view('frontend.currency.index', compact('currencies', 'today', 'lastUpdate'));
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