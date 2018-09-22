@extends('layouts.app', ['title' => 'Movie List'])

@section('content')
    <div class="container py-2 mx-auto">
        <div class="row">
        @foreach($folders as $d)
            <div class="col-xl-3 mt-4">
                <div class="d-flex justify-content-center">
                    <thumb-component :movie-name="{{json_encode($d)}}"></thumb-component>
                </div>
            </div>
        @endforeach
        </div>        
    </div>
@endsection