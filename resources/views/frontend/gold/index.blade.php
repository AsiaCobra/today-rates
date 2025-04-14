@extends('frontend.layouts.app')

@section('title', 'Gold Prices')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Gold Prices</h1>
            @if($lastUpdate && $lastUpdate->isToday())
                <p class="text-sm text-gray-500 mt-1">Today's Prices</p>
            @endif
        </div>
        @if($lastUpdate)
            <div class="text-right">
                <p class="text-sm text-gray-500">
                    Last updated: {{ $lastUpdate->format('F j, Y g:i A') }}
                </p>
                @if(!$lastUpdate->isToday())
                    <p class="text-xs text-orange-500 mt-1">
                        Showing latest available prices
                    </p>
                @endif
            </div>
        @endif
    </div>

    @if($goldPrices->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No Prices Available</h3>
            <p class="text-gray-500">No gold prices available at the moment</p>
            <p class="text-sm text-gray-400 mt-2">Please check back later for updates</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- World Gold Prices -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">World Gold Prices</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (USD/oz)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trend</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($goldPrices->where('type', 'world') as $price)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('frontend.gold.history', ['type' => 'world', 'goldType' => strtolower($price->gold_type)]) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        {{ $price->gold_type }} Gold
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($price->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($price->up_or_down === 'up')
                                        <span class="inline-flex items-center text-green-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                            </svg>
                                            Up
                                        </span>
                                    @elseif($price->up_or_down === 'down')
                                        <span class="inline-flex items-center text-red-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                            </svg>
                                            Down
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-gray-400">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                            </svg>
                                            Same
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Myanmar Gold Prices -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Myanmar Gold Prices</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (MMK)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trend</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($goldPrices->where('type', 'myanmar') as $price)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('frontend.gold.history', ['type' => 'myanmar', 'goldType' => strtolower($price->gold_type)]) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        {{ $price->gold_type }} Gold
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($price->price, 0) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($price->up_or_down === 'up')
                                        <span class="inline-flex items-center text-green-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                            </svg>
                                            Up
                                        </span>
                                    @elseif($price->up_or_down === 'down')
                                        <span class="inline-flex items-center text-red-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                            </svg>
                                            Down
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-gray-400">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                            </svg>
                                            Same
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection 