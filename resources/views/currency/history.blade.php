@extends('layouts.app')

@section('title', $currencyName . ' History')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $currencyName }} ({{ $currencyCode }}) History</h1>
        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-900">← Back to Home</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buy Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sell Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trend</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($history as $record)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $record->created_at->format('F j, Y') }}</td>
                    <td class="px-6 py-4">{{ number_format($record->buy_rate, 2) }}</td>
                    <td class="px-6 py-4">{{ number_format($record->sell_rate, 2) }}</td>
                    <td class="px-6 py-4">
                        @if($record->up_or_down === 'up')
                            <span class="text-green-600">↑</span>
                        @elseif($record->up_or_down === 'down')
                            <span class="text-red-600">↓</span>
                        @else
                            <span class="text-gray-600">→</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $history->links() }}
        </div>
    </div>
</div>
@endsection 