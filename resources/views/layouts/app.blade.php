@extends('adminlte::page')

@php
    use Illuminate\Support\Facades\Auth;
@endphp

{{-- Title --}}
@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Content Header --}}
@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Main Content --}}
@section('content')
    @yield('content_body')
@stop

{{-- Footer --}}
@section('footer')
    <div class="float-end">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@stop

{{-- Global JS --}}
@push('js')
<script>
    $(document).ready(function() {
        // Tambahkan script JS umum di sini
    });
</script>
@endpush

{{-- Additional JS --}}
@stack('js')

{{-- Custom CSS --}}
@push('css')
<style type="text/css">
    /* Custom AdminLTE Styles */
    /*
    .card-header {
        border-bottom: none;
    }
    .card-title {
        font-weight: 600;
    }
    */
</style>
@endpush
