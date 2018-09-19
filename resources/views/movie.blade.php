@extends('layouts.app', ['title' => $name])

@section('content')
    <div class="w-100">
        <div class="d-flex justify-content-center">
            <video-component :video-src="{{json_encode($movie)}}" :sub-src="{{json_encode($subs)}}" name="{{$name}}"></video-component>
        </div>
    </div>
@endsection