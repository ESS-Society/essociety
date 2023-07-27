@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('leaguefy-admin.dashboard_url', 'home') )

@if (config('leaguefy-admin.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page align-items-end esports-background-image' }}@stop

@section('body')
    <div class="{{ $auth_type ?? 'login' }}-box h-100">

        {{-- Card Box --}}
        <div class="card {{ config('leaguefy-admin.classes_auth_card', '') }} h-100 d-flex justify-content-between rounded-0">
            <div class="h-100 d-flex flex-column justify-content-center">
                {{-- Card Header --}}
                @hasSection('auth_header')
                    <div class="card-header text-center mx-4 {{ config('leaguefy-admin.classes_auth_header', '') }}">
                        {{-- Logo --}}
                        <a href="{{ $dashboard_url }}" class="h1">
                            {{-- Logo Label --}}
                            {!! config('leaguefy-admin.logo', '<b>Admin</b>LTE') !!}
                        </a>
                    </div>
                @endif

                {{-- Card Body --}}
                <div class="w-100 p-5 text-muted {{ config('leaguefy-admin.classes_auth_body', '') }}">
                    <p class="login-box-msg">
                        @yield('auth_header')
                    </p>

                    @yield('auth_body')
                </div>
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('leaguefy-admin.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif

        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
