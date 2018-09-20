@extends('layouts.app', ['title' => 'Home'])

@section('content')
    <div class="container mx-auto">
        <div class="text-center">
            <h2>Last 4 movies added</h2>
            <div class="row">
                @foreach($movies as $movie)
                <div class="col-md-3">
                    <div class="d-flex justify-content-center">
                        <thumb-component :movie-name="{{json_encode($movie)}}"></thumb-component>
                    </div>
                </div>
                @endforeach
            </div>
        </div>       
    </div>
@endsection