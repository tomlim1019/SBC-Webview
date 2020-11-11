@extends('layouts.app')

@section('content')
    <App login="{{ Auth::check() }}"/>
@endsection
