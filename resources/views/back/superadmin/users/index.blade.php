@extends('back.components.layout')

@section('title', 'Super Admin - User Management')

@section('page-title', 'User Management')
@section('crumb')
@include('back.components.crumbs.default')
@endsection

@section('content')

<section class="section">
    <div class="row">
        @livewire('super-admin.users')
    </div>
</section>

@endsection
