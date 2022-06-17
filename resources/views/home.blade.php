@extends('layouts.app')
 
@section('content')
    @foreach($frames as $frame)
        <frame-component color="{{ $frame->color }}" title="{{ $frame->title }}" id="{{ $frame->id }}" :posts="{{ $frame->posts }}"></frame-component>
        <br>
    @endforeach
@endsection