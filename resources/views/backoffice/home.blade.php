@extends('backoffice.layouts.app')

@section('content')
<navbar-vue :user="{{json_encode(Auth::user())}}" ></navbar-vue>
<router-view></router-view>
@endsection
