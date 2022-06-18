@extends('layouts.app')
 
@section('content')
    @foreach($frames as $key => $frame)
        @if($key == 0 )
            <frame-component :descer="true" :subir="false" color="{{ $frame->color }}" title="{{ $frame->title }}" id="{{ $frame->id }}" :posts="{{ $frame->posts }}"></frame-component>
            <br>
        @elseif($key == 2)
            <frame-component :descer="false" :subir="true" color="{{ $frame->color }}" title="{{ $frame->title }}" id="{{ $frame->id }}" :posts="{{ $frame->posts }}"></frame-component>
            <br>
        @else
            <frame-component :descer="true" :subir="true" color="{{ $frame->color }}" title="{{ $frame->title }}" id="{{ $frame->id }}" :posts="{{ $frame->posts }}"></frame-component>
            <br>
        @endif
    @endforeach
@endsection