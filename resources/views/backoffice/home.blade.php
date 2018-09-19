@extends('backoffice.layouts.app')

@section('content')
    <div class="col-sm-12">
        <a href="{{ \Auth::logout() }}">Lougout</a>
        <router-view></router-view>
    </div>
@endsection