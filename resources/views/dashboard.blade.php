@extends('layouts.user_template')

@section('content')

<div class="container p-5">
    <h3>Welcome, {{ session('user')->name }}</h3>
</div>

@endsection