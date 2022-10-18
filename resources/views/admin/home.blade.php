@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to the back-office Homepage {{$user = Auth::user()->name}}</h1>
</div>

@endsection
