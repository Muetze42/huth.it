@extends('nova::auth.layout')

@section('content')

@include('nova::auth.partials.header')

<div class="bg-white shadow rounded-lg p-8 max-w-login mx-auto">
    {{ csrf_field() }}

    @component('nova::auth.partials.heading')
        {{ 'Welcome Back!' }}
    @endcomponent

    <a class="w-full btn btn-default btn-primary hover:bg-primary-dark text-center" href="{{ route('auth', 'github') }}">
        {{ __('Login') }}
    </a>
</div>
@endsection
