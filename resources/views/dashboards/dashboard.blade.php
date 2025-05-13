@extends('dashboards.layouts.app')

@section('content')
    <div class="col-span-12 space-y-6 xl:col-span-7">
        <!-- Metric Group One -->
        @include('dashboards.partials.metric-group-01')
        <!-- Metric Group One -->

        <!-- ====== Chart One Start -->
        @include('dashboards.partials.chart-01')
        <!-- ====== Chart One End -->
    </div>
    <div class="col-span-12 xl:col-span-5">
        <!-- ====== Chart Two Start -->
        @include('dashboards.partials.chart-02')
        <!-- ====== Chart Two End -->
    </div>

    <div class="col-span-12">
        <!-- ====== Chart Three Start -->
        @include('dashboards.partials.chart-03')

        <!-- ====== Chart Three End -->
    </div>

    <div class="col-span-12 xl:col-span-5">
        <!-- ====== Map One Start -->
        @include('dashboards.partials.map-01')

        <!-- ====== Map One End -->
    </div>

    <div class="col-span-12 xl:col-span-7">
        <!-- ====== Table One Start -->
        @include('dashboards.partials.table-01')

        <!-- ====== Table One End -->
    </div>
@endsection
