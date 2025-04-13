@extends('frontend.layouts.app')

@section('title', 'Today\'s Currency Rates')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Today's Currency Rates</h1>
        @if($lastUpdate)
            <p class="text-sm text-gray-500">
                Last updated: {{ $lastUpdate->format('F j, Y g:i A') }}
            </p>
        @endif
    </div>

    @if($currencies->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No Rates Available</h3>
            <p class="text-gray-500">No currency rates available for {{ $today->format('F j, Y') }}</p>
            @if($lastUpdate)
                <p class="text-sm text-gray-400 mt-2">Please check back later for updates</p>
            @endif
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Currency</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buy Rate</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sell Rate</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trend</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($currencies as $currency)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('frontend.currency.history', $currency->currency_code) }}" 
                               class="text-blue-600 hover:text-blue-900 font-medium">
                                {{ $currency::CURRENCY_CODE_SELECT[$currency->currency_code] }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $currency->currency_code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($currency->buy_rate, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($currency->sell_rate, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($currency->up_or_down === 'up')
                                <span class="text-green-600">↑</span>
                            @elseif($currency->up_or_down === 'down')
                                <span class="text-red-600">↓</span>
                            @else
                                <span class="text-gray-400">→</span>
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