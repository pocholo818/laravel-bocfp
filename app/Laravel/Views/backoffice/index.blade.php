@extends('backoffice._layouts.main')

@section('breadcrumbs')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>Dashboard</h3>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="default-dashboard">
    @include('backoffice._components.notifications')

    <div class="row widget-grid">
        <h3>This is the Dashboard, Hello!</h3>
    </div>
</div>
@stop

@section('page-styles')
<style>
</style>
@stop

@section('page-scripts')
<script src="{{asset('assets/backoffice/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/backoffice/js/chart/apex-chart/stock-prices.js')}}"></script>
<script type="text/javascript">
    // functions
</script>
@stop