@extends('layouts.app')
 
@section('content')
    <dashboard-component :frames="{{ $frames }}"></dashboard-component>
@endsection