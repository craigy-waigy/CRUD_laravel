@push('scripts')
    <script src="{{ asset('js/chart.js') }}" defer></script>
@endpush

@section('title', 'Статистика по заключенным контрактам')

@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="stat_header">Статистика по заключенным контрактам</h4>
        <div class="row justify-content-center">
            <div class="col-md-12">
                {!! $chart->render() !!}
            </div>
        </div>
    </div>

@endsection

