<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function home()
    {
        $today = today();
        // Minus 1 day
        $today = $today->subDay();
        $currencies = Currency::whereDate('created_at', $today)
            ->orderBy('currency_code')
            ->get();

        $lastUpdate = Currency::latest('created_at')->first()?->created_at;

        return view('home', compact('currencies', 'today', 'lastUpdate'));
    }

    public function history($currencyCode)
    {
        $history = Currency::where('currency_code', $currencyCode)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $currencyName = Currency::CURRENCY_CODE_SELECT[$currencyCode] ?? $currencyCode;

        return view('currency.history', [
            'history' => $history,
            'currencyCode' => $currencyCode,
            'currencyName' => $currencyName,
        ]);
    }

    public function terms()
    {
        return view('terms');
    }

    public function privacy()
    {
        return view('privacy');
    }
} 