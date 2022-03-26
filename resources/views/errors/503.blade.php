@extends('errors::illustrated-layout')

@section('title', __('Maintenance Mode'))
@section('code', '503')
@section('message', (__("Short maintenance.\nWe'll be right back.")))
