@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-8">
    Business Evaluation Result
</h1>

<div class="bg-white shadow rounded-lg p-6 mb-8">
    <h2 class="text-lg font-semibold mb-4">
        Total Score: {{ $evaluation->total_score }}
    </h2>
    <h3 class="text-md mb-2">
        Business Health: <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-bold">{{ $evaluation->business_health }}</span>
    </h3>
</div>

<div class="bg-white shadow rounded-lg p-6 mb-8">
    <canvas id="businessChart"></canvas>
</div>

<div class="grid grid-cols-2 md:grid-cols-5 gap-6">
    <div class="bg-white p-4 rounded shadow text-center">
        <span class="text-gray-500 text-sm">Market</span>
        <h2 class="text-xl font-bold">{{ $scores['market'] }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
        <span class="text-gray-500 text-sm">Product</span>
        <h2 class="text-xl font-bold">{{ $scores['product'] }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
        <span class="text-gray-500 text-sm">Marketing</span>
        <h2 class="text-xl font-bold">{{ $scores['marketing'] }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
        <span class="text-gray-500 text-sm">Operation</span>
        <h2 class="text-xl font-bold">{{ $scores['operation'] }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
        <span class="text-gray-500 text-sm">Finance</span>
        <h2 class="text-xl font-bold">{{ $scores['finance'] }}</h2>
    </div>
</div>

<div class="bg-white shadow rounded-lg p-6 mt-8 border-l-4 border-blue-500">
    <h2 class="text-lg font-semibold mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Business Diagnosis
    </h2>

    <ul class="space-y-3">
        @foreach($diagnosis as $item)
            <li class="flex items-start">
                <span class="text-blue-500 mr-2">•</span>
                <span class="text-gray-700">{{ $item }}</span>
            </li>
        @endforeach
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('businessChart');

    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Market', 'Product', 'Marketing', 'Operation', 'Finance'],
            datasets: [{
                label: 'Business Score',
                data: [
                    {{ $scores['market'] }},
                    {{ $scores['product'] }},
                    {{ $scores['marketing'] }},
                    {{ $scores['operation'] }},
                    {{ $scores['finance'] }}
                ],
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                pointBackgroundColor: 'rgb(54, 162, 235)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(54, 162, 235)'
            }]
        },
        options: {
            scales: {
                r: {
                    angleLines: { display: true },
                    suggestedMin: 0,
                    suggestedMax: 50
                }
            }
        }
    });
</script>

@endsection