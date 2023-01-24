@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center py-5 " >Home Page di {{Auth::user()->name}}</h1>
    <h3 class="text-center">Sono presenti {{$projects_counter}} progetti</h3>
</div>
@endsection
