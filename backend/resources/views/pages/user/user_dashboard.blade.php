@extends('layouts.app')

@section('content')
<li>
    <a href="{{ route('user.dashboard') }}">
        <i data-feather="user"></i>
        <span>User Dashboard</span>
    </a>
</li>
@endsection
