@extends('be.layouts.master')

@section('content')
    @include('be.layouts.content')
@endsection

@section('js')
    <script>
        $('#lineChart').sparkline([102,109,120,99,110,105,115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: 'rgba(255, 255, 255, .5)',
            fillColor: 'rgba(255, 255, 255, .15)'
        });

        $('#lineChart2').sparkline([99,125,122,105,110,124,115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: 'rgba(255, 255, 255, .5)',
            fillColor: 'rgba(255, 255, 255, .15)'
        });

        $('#lineChart3').sparkline([105,103,123,100,95,105,115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: 'rgba(255, 255, 255, .5)',
            fillColor: 'rgba(255, 255, 255, .15)'
        });
    </script>
@endpush

@push('js')
    <script src="{{ asset('js/sidebar.js') }}"></script>
@endpush