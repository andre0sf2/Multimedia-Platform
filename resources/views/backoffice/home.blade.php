@extends('backoffice.layouts.app')

@section('content')
    <navbar-vue :user="{{json_encode(Auth::user())}}" ></navbar-vue>
    <div class="row w-100">
        <side-bar></side-bar>
        <router-view></router-view>
    </div>
@endsection
