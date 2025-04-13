@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Today's Currency Rates</h1>
        @if($lastUpdate)
            <p class="text-sm text-gray-500">
                Last updated: {{ $lastUpdate->format('F j, Y g:i A') }}
            </p>
        @endif
    </div>
    
    @if($currencies->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg mb-2">No currency rates available for {{ $today->format('F j, Y') }}</p>
            @if($lastUpdate)
                <p class="text-sm text-gray-400">Check back later for updates</p>
            @endif
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Currency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buy Rate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sell Rate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trend</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($currencies as $currency)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <a href="{{ route('currency.history', $currency->currency_code) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $currency::CURRENCY_CODE_SELECT[$currency->currency_code] }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $currency->currency_code }}</td>
                        <td class="px-6 py-4">{{ number_format($currency->buy_rate, 2) }}</td>
                        <td class="px-6 py-4">{{ number_format($currency->sell_rate, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($currency->up_or_down === 'up')
                                <span class="text-green-600">↑</span>
                            @elseif($currency->up_or_down === 'down')
                                <span class="text-red-600">↓</span>
                            @else
                                <span class="text-gray-600">→</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection