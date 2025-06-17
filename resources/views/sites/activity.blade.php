@extends('layouts.base')

@section('content')

<head>
    <title>График активности </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }
    </style>
</head>
    <div class="chart-container" id = "siteId" data-site-id="{{ $site->id }}">
        <h2>Активность пользователей по часам</h2>
        <canvas id="activityChart"></canvas>
    </div>

<script src="{{ asset('js/activity-chart.js') }}"></script>

</body>
@endsection

